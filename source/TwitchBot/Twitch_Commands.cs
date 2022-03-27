using System;
using System.Data.SQLite;
using System.Runtime.InteropServices;
using System.Media;

namespace FoxxiBot.TwitchBot
{
    internal class Twitch_Commands
    {

        string cs = @"URI=file:" + AppDomain.CurrentDomain.BaseDirectory + "\\Data\\bot.db";
        SQLite.twitchSQL twitchSQL = new SQLite.twitchSQL();

        public string commandAccountAge(TwitchLib.Client.Events.OnChatCommandReceivedArgs e)
        {
            var data = Twitch_GetData.getAccountAge(e.Command.ChatMessage.UserId).GetAwaiter().GetResult();
            return e.Command.ChatMessage.DisplayName + " your account was created " + data.ToString() + " ago";
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

                    // Windows Implementation
                    if (RuntimeInformation.IsOSPlatform(OSPlatform.Windows))
                    {
                        using (var soundPlayer = new SoundPlayer(AppDomain.CurrentDomain.BaseDirectory + "\\Files\\Sounds\\" + rdr["file"]))
                        {
                            soundPlayer.Play();
                        }
                    }

                    return "Playing the Sound File: " + rdr["name"];
                }

            }

            con.Close();
            return null;

        }

    }
}