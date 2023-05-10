// Copyright(C) 2020 - 2022 FoxxiBot
// This program is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
// You should have received a copy of the GNU General Public License
// along with this program.  If not, see <http://www.gnu.org/licenses/>.

using Discord;
using FoxxiBot.SQLite;
using System;
using System.Data.SQLite;
using System.Numerics;
using System.Threading;

namespace FoxxiBot.TwitchBot
{
    internal class Twitch_Betting
    {
        // Set Bet Timer
        private Timer betTimer = null;
        private Timer betReminder = null;
        private int betState = 0;

        string cs = @"URI=file:" + AppDomain.CurrentDomain.BaseDirectory + "/Data/bot.db";
        SQLite.betSQL betSQL = new SQLite.betSQL();

        private void betTimer_Handler(object state)
        {
            if (betState == 1)
            {
                // Console Message
                Console.WriteLine("The current bet has ended");

                // Betting has Ended!
                betSQL.updateOptions("bet_running", "off");

                // Send Bet Closing Message
                Twitch_Main.client.SendMessage(Config.TwitchClientChannel, "The betting period has ended!");

                // Set the Timer to Infinite
                betTimer.Change(Timeout.Infinite, Timeout.Infinite);
            }

            // Set to State 1 after 2 Mins
            betState = 1;
        }

        public string initBet()
        {
            // Set Bet State to Zero
            betState = 0;

            // Start Betting Timer (2 minutes)
            betTimer = new Timer(betTimer_Handler, null, 0, 120000);

            // Set Bet as Running
            betSQL.updateOptions("bet_running", "on");

            // Send Bet Information to Chat
            return betSQL.getOptions("bet_info");
        }

        public string commandBetPoints(TwitchLib.Client.Events.OnChatCommandReceivedArgs e)
        {

            if (betSQL.getOptions("bet_running") == "on")
            {

                if (betSQL.betExists(e.Command.ChatMessage.Username) == true)
                {
                    return e.Command.ChatMessage.DisplayName + ", you have already placed a bet!";
                }

                if (e.Command.ArgumentsAsList.Count == 0)
                {
                    return e.Command.ChatMessage.DisplayName + ", please specify an amount of points (as a number or percentage) you would like to bet";
                }

                if (e.Command.ArgumentsAsString.Contains("."))
                {
                    return e.Command.ChatMessage.DisplayName + ", please use a whole number or percentage, no decimals!";
                }

                if (e.Command.ArgumentsAsList.Count > 0)
                {

                    int n;
                    int points = Convert.ToInt32(Twitch_GetData.userPoints(e.Command.ChatMessage.Username));
                    string bet_option = e.Command.ArgumentsAsList[0];
                    string bet_points = e.Command.ArgumentsAsList[1];

                    if (bet_option == "all")
                    {
                        betSQL.addABet(e.Command.ChatMessage.Username, bet_option, bet_points);
                        return e.Command.ChatMessage.DisplayName + ", your bet on '" + bet_option + "' for " + points + " points has been registered!";
                    }

                    if (bet_points.Contains("%"))
                    {

                        decimal percentage = Convert.ToInt32(bet_points.Replace("%", ""));
                        var math = (percentage / 100) * points;

                        betSQL.addABet(e.Command.ChatMessage.Username, bet_option, Convert.ToString(Math.Round(math)));
                        betSQL.deductVotePoints(e.Command.ChatMessage.Username, bet_points);
                        return e.Command.ChatMessage.DisplayName + ", your bet on '" + bet_option + "' for " + Math.Round(math) + " points has been registered!";
                    }

                    // Add the Bet & Deduct the Points
                    betSQL.addABet(e.Command.ChatMessage.Username, bet_option, bet_points);
                    betSQL.deductVotePoints(e.Command.ChatMessage.Username, bet_points);

                    return e.Command.ChatMessage.DisplayName + ", your bet on '" + bet_option + "' for " + bet_points + " points has been registered!";
                }

            }
            else
            {
                return e.Command.ChatMessage.DisplayName + ", Sorry, there is no bet currently running!";
            }

            return null;

        }

        public string finishBet(TwitchLib.Client.Events.OnChatCommandReceivedArgs e)
        {
            // Set Bet Winner
            betSQL.updateOptions("bet_winner", e.Command.ArgumentsAsList[1]);

            // Set the Percentage
            double percentage = Convert.ToDouble(betSQL.getOptions("bet_win_percentage"));

            // Deal with Payouts
            using var con = new SQLiteConnection(cs);
            con.Open();
            var stm = $"SELECT * FROM gb_betting WHERE bet_option = '{e.Command.ArgumentsAsList[1]}'";

            using var cmd = new SQLiteCommand(stm, con);
            using SQLiteDataReader rdr = cmd.ExecuteReader();

            if (rdr.HasRows == true)
            {

                while (rdr.Read())
                {
                    // Calculate New Points Based on Percentage
                    int userBet = Convert.ToInt32((string)rdr["bet_points"]);

                    int percentComplete = (int)Math.Round((double)(percentage / userBet) * 100);
                    int finalScore = userBet + percentComplete;

                    // Save the New Points Value
                    using var updateCmd = new SQLiteCommand(con);

                    updateCmd.CommandText = "UPDATE gb_points SET value = value + @value WHERE username = @username";

                    updateCmd.Parameters.AddWithValue("@username", rdr["username"].ToString());
                    updateCmd.Parameters.AddWithValue("@value", finalScore);

                    updateCmd.Prepare();
                    updateCmd.ExecuteNonQuery();
                }

            }
            else
            {
                // Send Chat Message
                return "No one voted for '" + e.Command.ArgumentsAsList[1] + "', no one got any payouts!";
            }

            // Delete the Bet List for Next Vote
            betSQL.eraseBetList();

            // Send Final Message
            return "Payouts to the voters who selected '" + e.Command.ArgumentsAsList[1] + "' has been completed!";
        }

    }
}
