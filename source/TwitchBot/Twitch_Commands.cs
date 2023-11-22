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

using Newtonsoft.Json;
using Newtonsoft.Json.Linq;
using System;
using System.Data.SQLite;
using System.Net.Http;
using System.Net.Http.Headers;

namespace FoxxiBot.TwitchBot
{
    internal class Twitch_Commands
    {

        string cs = @"URI=file:" + AppDomain.CurrentDomain.BaseDirectory + "/Data/bot.db";
        SQLite.twitchSQL twitchSQL = new SQLite.twitchSQL();

        public string commandBotList()
        {

            // Get HTTP Data
            var url = $"https://api.twitchinsights.net/v1/bots/all";

            HttpClient client = new HttpClient();
            client.BaseAddress = new Uri(url);
            client.DefaultRequestHeaders.Accept.Add(new MediaTypeWithQualityHeaderValue("application/json"));
            HttpResponseMessage response = client.GetAsync(url).Result;

            if (response.IsSuccessStatusCode)
            {

                var result = response.Content.ReadAsStringAsync().Result;

                // If no results Found
                if (result.Length == 0)
                {
                    return "Sorry, the bot list could not be updated at this time...";
                }

                // Get number of items
                dynamic o = JsonConvert.DeserializeObject(result);

                // If command not development defined, check users custom in SQLite
                using var con = new SQLiteConnection(cs);
                con.Open();

                using (var transaction = con.BeginTransaction())
                {
                    var command = con.CreateCommand();
                    command.CommandText = "INSERT or IGNORE INTO gb_twitch_botlist (username) VALUES (@username)";

                    var parameter = command.CreateParameter();
                    parameter.ParameterName = "@username";
                    command.Parameters.Add(parameter);

                    // Insert a lot of data
                    foreach (var item in o.bots)
                    {
                        parameter.Value = item[0];
                        command.ExecuteNonQuery();
                    }

                    transaction.Commit();
                }

                con.Close();
                return "The Twitch bot list has been updated";
            }

            return "Sorry, the bot list could not be updated at this time...";
        }

        public string commandAccountAge(TwitchLib.Client.Events.OnChatCommandReceivedArgs e)
        {
            var data = Twitch_GetData.getAccountAge(e.Command.ChatMessage.UserId).GetAwaiter().GetResult();
            return e.Command.ChatMessage.DisplayName + ", your account was created " + data.ToString() + " ago";
        }

        public string commandPermitUser(TwitchLib.Client.Events.OnChatCommandReceivedArgs e)
        {
            var display_name = e.Command.ArgumentsAsString.ToString().Replace("@", "");

            twitchSQL.updateOptions("Permitted_User", display_name);
            return e.Command.ChatMessage.DisplayName + ", you have been permitted to post a link";
        }

        public string commandDeaths(TwitchLib.Client.Events.OnChatCommandReceivedArgs e)
        {
            if (e.Command.ArgumentsAsList.Count == 0)
            {
                int deaths = Convert.ToInt32(twitchSQL.getOptions("deathCounter"));
                return $"The streamer has died {deaths} time(s)";
            }

            if (e.Command.ChatMessage.IsBroadcaster || e.Command.ChatMessage.IsModerator)
            {

                if (e.Command.ArgumentsAsString.Contains("set"))
                {

                    try
                    {
                        int setDeaths = Convert.ToInt32(e.Command.ArgumentsAsList[1]);

                        twitchSQL.updateOptions("deathCounter", e.Command.ArgumentsAsList[1].ToString());
                        return $"The streamer has died {e.Command.ArgumentsAsList[1]} time(s)";
                    }
                    catch
                    {
                        return "The given value was not an integer";
                    }

                }
                    
                if (e.Command.ArgumentsAsString == "add")
                {
                    int deaths = Convert.ToInt32(twitchSQL.getOptions("deathCounter"));
                    var update = deaths + 1;

                    twitchSQL.updateOptions("deathCounter", update.ToString());
                    return $"The streamer has died {update} time(s)";
                }

                if (e.Command.ArgumentsAsString == "sub")
                {
                    int deaths = Convert.ToInt32(twitchSQL.getOptions("deathCounter"));
                    int update = deaths - 1;

                    twitchSQL.updateOptions("deathCounter", update.ToString());
                    return $"The streamer has died {update} time(s)";
                }

                if (e.Command.ArgumentsAsString == "reset")
                {
                    int update = 0;

                    twitchSQL.updateOptions("deathCounter", update.ToString());
                    return $"The death counter has been reset";
                }

            }

            return "an error occured, oopsie";
        }

        public string commandFollowAge(TwitchLib.Client.Events.OnChatCommandReceivedArgs e)
        {
            var data = Twitch_GetData.getFollowAge(e.Command.ChatMessage.UserId).GetAwaiter().GetResult();
            return e.Command.ChatMessage.DisplayName + ", your account followed " + data.ToString() + " ago";
        }

        public string commandGiveaway(TwitchLib.Client.Events.OnChatCommandReceivedArgs e)
        {

            if (e.Command.ArgumentsAsString == "winner")
            {
                var data = twitchSQL.giveawayWinner();

                twitchSQL.updateOptions("Giveaway_Winner", data);

                return "You have won the giveaway, " + data + "!";
            }

            // Is Giveaway Active?
            if (twitchSQL.getOptions("Giveaway_Status") == "on")
            {

                if (e.Command.ChatMessage.IsBroadcaster)
                {
                    return twitchSQL.getOptions("Giveaway_Details");
                }

                if (e.Command.ChatMessage.IsStaff)
                {
                    if (twitchSQL.getOptions("Giveaway_AllowTwitchStaff") == "on")
                    {
                        twitchSQL.giveawayContestant(e.Command.ChatMessage.UserId, e.Command.ChatMessage.Username, e.Command.ChatMessage.DisplayName);
                        return e.Command.ChatMessage.DisplayName + ", you have entered the giveaway!";
                    }
                    else
                    {
                        return "Sorry, Twitch Staff are excempt from this giveaway";
                    }
                }

                if (e.Command.ChatMessage.IsModerator)
                {
                    if (twitchSQL.getOptions("Giveaway_AllowMods") == "on")
                    {
                        twitchSQL.giveawayContestant(e.Command.ChatMessage.UserId, e.Command.ChatMessage.Username, e.Command.ChatMessage.DisplayName);
                        return e.Command.ChatMessage.DisplayName + ", you have entered the giveaway!";
                    }
                    else
                    {
                        return "Sorry, Channel Moderators are excempt from this giveaway";
                    }
                }

                twitchSQL.giveawayContestant(e.Command.ChatMessage.UserId, e.Command.ChatMessage.Username, e.Command.ChatMessage.DisplayName);
                return e.Command.ChatMessage.DisplayName + ", you have entered the giveaway!";

            }
            else
            {
                return "All recent giveaways have ended";
            }

        }

        public string commandShoutout(TwitchLib.Client.Events.OnChatCommandReceivedArgs e)
        {
            // split into args
            var normalize = e.Command.ArgumentsAsString.Replace("@", "");

            try
            {
                // Get Shoutout Data
                var data = Twitch_GetData.ShoutOut(normalize).GetAwaiter().GetResult();

                // If User Doesn't Exist
                if (data == "n/a")
                {
                    return "The requested user could not be found";
                }

                // Send Data to Twitch Chat
                return data;
            }
            catch
            {
                // Get Shoutout Data
                var data = Twitch_GetData.displayNametoUserLogin(normalize).GetAwaiter().GetResult();

                // If User Doesn't Exist
                if (data == "n/a")
                {
                    return "The requested user could not be found";
                }

                // Send Data to Twitch Chat
                var value = Twitch_GetData.ShoutOut(data).GetAwaiter().GetResult();
                return value;
            }
        }

        public string raidShoutout(TwitchLib.Client.Events.OnRaidNotificationArgs e)
        {
            // split into args
            var normalize = e.RaidNotification.Login.Replace("@", "");

            var data = Twitch_GetData.ShoutOut(normalize).GetAwaiter().GetResult();
            return data;
        }

        public string commandSound(TwitchLib.Client.Events.OnChatCommandReceivedArgs e)
        {

            using var con = new SQLiteConnection(cs);
            con.Open();

            string stm = "SELECT * FROM gb_sounds WHERE name = '" + e.Command.ArgumentsAsString + "' AND active = 1";

            using var cmd = new SQLiteCommand(stm, con);
            using SQLiteDataReader rdr = cmd.ExecuteReader();

            if (rdr.HasRows == true)
            {

                while (rdr.Read())
                {

                    // Has Points Definition?
                    if ((int)(long)rdr["points"] > 0)
                    {
                        int user_points = Convert.ToInt32(Twitch_GetData.userPoints(e.Command.ChatMessage.Username));

                        if (user_points < (int)(long)rdr["points"])
                        {
                            return e.Command.ChatMessage.DisplayName + ", sorry, you don't have enough points to use that command!";
                        }

                        // Math for Points
                        int final_points = user_points - (int)(long)rdr["points"];

                        // Insert Action Log
                        using var insertCmd = new SQLiteCommand(con);
                        insertCmd.CommandText = "INSERT INTO gb_points_actions (username, recipient, action, points, status) VALUES (@username, @recipient, @action, @points, @status)";

                        insertCmd.Parameters.AddWithValue("@username", e.Command.ChatMessage.Username);
                        insertCmd.Parameters.AddWithValue("@recipient", e.Command.ArgumentsAsString);
                        insertCmd.Parameters.AddWithValue("@action", e.Command.CommandText);
                        insertCmd.Parameters.AddWithValue("@points", (int)(long)rdr["points"]);
                        insertCmd.Parameters.AddWithValue("@status", 0);

                        insertCmd.Prepare();
                        insertCmd.ExecuteNonQuery();

                        // Take Points for Command
                        using var updateCmd = new SQLiteCommand(con);
                        updateCmd.CommandText = "UPDATE gb_points SET value = @value WHERE username = @username";

                        updateCmd.Parameters.AddWithValue("@username", e.Command.ChatMessage.Username);
                        updateCmd.Parameters.AddWithValue("@value", final_points);

                        updateCmd.Prepare();
                        updateCmd.ExecuteNonQuery();
                    }

                    // OBS Browser Source Implementation
                    using var insertSound = new SQLiteCommand(con);
                    insertSound.CommandText = "INSERT INTO gb_sounds_queue (file) VALUES (@file)";
                    insertSound.Parameters.AddWithValue("@file", rdr["file"]);

                    insertSound.Prepare();
                    insertSound.ExecuteNonQuery();

                    return "Playing the Sound File: " + rdr["name"];
                }

            }

            con.Close();
            return null;

        }

        public string commandVoting(TwitchLib.Client.Events.OnChatCommandReceivedArgs e)
        {

            SQLite.pollSQL pollSQL = new SQLite.pollSQL();
            string current_poll = pollSQL.getOptions("active_poll");
            int voteCheck = pollSQL.voteCheck(e.Command.ChatMessage.Username, Convert.ToInt32(current_poll));

            if (voteCheck == -1)
            {
                return "The voting process can't continue, there is a bug going on!";
            }

            if (voteCheck == 0)
            {
                using var con = new SQLiteConnection(cs);
                con.Open();

                // Process Users Vote
                using var insertCmd = new SQLiteCommand(con);

                insertCmd.CommandText = "INSERT OR IGNORE INTO gb_polls_votes(poll_id, user, value) VALUES (@poll_id, @user, @value)";

                insertCmd.Parameters.AddWithValue("@poll_id", current_poll);
                insertCmd.Parameters.AddWithValue("@user", e.Command.ChatMessage.Username);
                insertCmd.Parameters.AddWithValue("@value", e.Command.ArgumentsAsString);

                insertCmd.Prepare();
                insertCmd.ExecuteNonQuery();

                con.Close();

                // Return Twitch Chat Message
                return e.Command.ChatMessage.DisplayName + ", your vote has been tallied!";
            }

            if (voteCheck == 1)
            {
                // Return Twitch Chat Message
                return e.Command.ChatMessage.DisplayName + ", you have already voted!";
            }

            return null;
        }

        public void commandBetting()
        {



        }

        public void win_loss(string type)
        {
            // Update SQL Database
            using var con = new SQLiteConnection(cs);
            con.Open();

            // Process New Win/Loss Data
            using var updateCmd = new SQLiteCommand(con);

            // Set Win Math
            if (type == "win")
            {
                string win_stm = "UPDATE gb_win_loss SET value = value + 1 WHERE parameter = 'wins'";

                using var updateWins = new SQLiteCommand(win_stm, con);
                updateWins.Prepare();
                updateWins.ExecuteNonQuery();
            }
            
            // Set Loss Math
            if (type == "loss")
            {
                string loss_stm = "UPDATE gb_win_loss SET value = value + 1 WHERE parameter = 'losses'";

                // Start a local transaction
                using var updateLosses = new SQLiteCommand(loss_stm, con);
                updateLosses.Prepare();
                updateLosses.ExecuteNonQuery();
            }

            // Reset the Counter
            if (type == "reset")
            {
                // Reset Wins Column
                string rwin_stm = "UPDATE gb_win_loss SET value = 0 WHERE parameter = 'wins'";

                using var resetWins = new SQLiteCommand(rwin_stm, con);
                resetWins.Prepare();
                resetWins.ExecuteNonQuery();

                // Reset Losses Column
                string rloss_stm = "UPDATE gb_win_loss SET value = 0 WHERE parameter = 'losses'";

                // Start a local transaction
                using var resetLosses = new SQLiteCommand(rloss_stm, con);
                resetLosses.Prepare();
                resetLosses.ExecuteNonQuery();

                // Reset Ratio Column
                string rratio_stm = "UPDATE gb_win_loss SET value = '-' WHERE parameter = 'ratio'";

                // Start a local transaction
                using var resetRatio = new SQLiteCommand(rratio_stm, con);
                resetRatio.Prepare();
                resetRatio.ExecuteNonQuery();
            }

            if (type != "reset") {

                // Update Ratio Win/Loss Values
                SQLite.winlossSQL winlossSQL = new SQLite.winlossSQL();
                int wins = Convert.ToInt32(winlossSQL.getOptions("wins"));
                int losses = Convert.ToInt32(winlossSQL.getOptions("losses"));

                // Update Ratio
                int math = wins * 100 / (wins + losses);
                //Console.WriteLine(math);

                string ratio_stm = "UPDATE gb_win_loss SET value = '" + math + '%' + "' WHERE parameter = 'ratio'";

                // Start a local transaction
                using var updateRatio = new SQLiteCommand(ratio_stm, con);
                updateRatio.Prepare();
                updateRatio.ExecuteNonQuery();

            }

            con.Close();
        }

    }
}