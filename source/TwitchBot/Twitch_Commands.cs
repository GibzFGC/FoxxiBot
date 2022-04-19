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

using System;
using System.Data.SQLite;
using System.Runtime.InteropServices;
using System.Media;

namespace FoxxiBot.TwitchBot
{
    internal class Twitch_Commands
    {

        string cs = @"URI=file:" + AppDomain.CurrentDomain.BaseDirectory + "/Data/bot.db";
        SQLite.twitchSQL twitchSQL = new SQLite.twitchSQL();

        public string commandAccountAge(TwitchLib.Client.Events.OnChatCommandReceivedArgs e)
        {
            var data = Twitch_GetData.getAccountAge(e.Command.ChatMessage.UserId).GetAwaiter().GetResult();
            return e.Command.ChatMessage.DisplayName + " your account was created " + data.ToString() + " ago";
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
                var data = Twitch_GetData.ShoutOut(normalize).GetAwaiter().GetResult();
                return data;
            }
            catch
            {
                var data = Twitch_GetData.displayNametoUserID(normalize).GetAwaiter().GetResult();

                var value = Twitch_GetData.ShoutOut(data).GetAwaiter().GetResult();
                return value;
            }
            finally
            {
                Console.WriteLine("!so user not found!");
            }
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

    }
}