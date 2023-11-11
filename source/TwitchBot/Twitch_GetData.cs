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

using Newtonsoft.Json.Linq;
using System;
using System.Collections.Generic;
using System.Data.SQLite;
using System.Threading.Tasks;
using TwitchLib.Api;

namespace FoxxiBot.TwitchBot
{
    public class Twitch_GetData
    {

        public static async Task<bool> streamStatus()
        {
            // create twitch api instance
            var api = new TwitchAPI();
            api.Settings.ClientId = Config.TwitchClientId;
            api.Settings.AccessToken = Config.TwitchClientOAuth;

            // Try Getting Live Stream Status
            try
            {
                var data = await api.Helix.Streams.GetStreamsAsync(userIds: new List<string> { Config.TwitchMC_Id });
                if (data.Streams.Length == 0)
                {
                    // Console.WriteLine(DateTime.Now + ": " + Config.TwitchBotName + " - " + "Stream is now Offline");

                    SQLite.twitchSQL discordSQL = new SQLite.twitchSQL();
                    discordSQL.updateOptions("stream_status", "0");

                    return false;
                }
                else
                {
                    // Console.WriteLine(DateTime.Now + ": " + Config.TwitchBotName + " - " + "Stream is now Live");

                    SQLite.twitchSQL discordSQL = new SQLite.twitchSQL();
                    discordSQL.updateOptions("stream_status", "1");

                    return true;
                }

            }
            catch // Depreciate if HTTP Connection is Denied
            {
                SQLite.twitchSQL discordSQL = new SQLite.twitchSQL();
                discordSQL.updateOptions("stream_status", "0");

                return false;
            }
        }

        public static async Task<string> displayNametoUserID(string input)
        {
            // create twitch api instance
            var api = new TwitchAPI();
            api.Settings.ClientId = Config.TwitchClientId;
            api.Settings.AccessToken = Config.TwitchClientOAuth;

            var data = await api.Helix.Search.SearchChannelsAsync(input);

            if (data.Channels.Length == 0)
            {
                return "n/a";
            }

            return data.Channels[0].Id;
        }

        public static async Task<string> displayNametoUserLogin(string input)
        {
            // create twitch api instance
            var api = new TwitchAPI();
            api.Settings.ClientId = Config.TwitchClientId;
            api.Settings.AccessToken = Config.TwitchClientOAuth;

            var data = await api.Helix.Search.SearchChannelsAsync(input);

            if (data.Channels.Length == 0)
            {
                return "n/a";
            }

            return data.Channels[0].BroadcasterLogin;
        }

        public static async Task<string> getAccountAge(string user_id)
        {
            // create twitch api instance
            var api = new TwitchAPI();
            api.Settings.ClientId = Config.TwitchClientId;
            api.Settings.AccessToken = Config.TwitchClientOAuth;

            var data = await api.Helix.Users.GetUsersAsync(ids: new List<string> { user_id });

            DateTime Now = DateTime.Now;
            int Years = new DateTime(DateTime.Now.Subtract(DateTime.Parse(data.Users[0].CreatedAt.ToString())).Ticks).Year - 1;
            DateTime dtPastYearDate = DateTime.Parse(data.Users[0].CreatedAt.ToString()).AddYears(Years);
            int Months = 0;
            for (int i = 1; i <= 12; i++)
            {
                if (dtPastYearDate.AddMonths(i) == Now)
                {
                    Months = i;
                    break;
                }
                else if (dtPastYearDate.AddMonths(i) >= Now)
                {
                    Months = i - 1;
                    break;
                }
            }
            int Days = Now.Subtract(dtPastYearDate.AddMonths(Months)).Days;
            int Hours = Now.Subtract(dtPastYearDate).Hours;
            int Minutes = Now.Subtract(dtPastYearDate).Minutes;
            int Seconds = Now.Subtract(dtPastYearDate).Seconds;

            return String.Format("{0} Year(s), {1} Month(s), {2} Day(s), {3} Hour(s), {4} Second(s)",
                                Years, Months, Days, Hours, Seconds);
        }

        public static async Task<string> getFollowAge(string user_id)
        {
            // create twitch api instance
            var api = new TwitchAPI();
            api.Settings.ClientId = Config.TwitchClientId;
            api.Settings.AccessToken = Config.TwitchClientOAuth;

            var data = await api.Helix.Channels.GetChannelFollowersAsync(broadcasterId: Config.TwitchMC_Id, userId: user_id);

            DateTime Now = DateTime.Now;
            int Years = new DateTime(DateTime.Now.Subtract(DateTime.Parse(data.Data[0].FollowedAt.ToString())).Ticks).Year - 1;
            DateTime dtPastYearDate = DateTime.Parse(data.Data[0].FollowedAt.ToString()).AddYears(Years);
            int Months = 0;
            for (int i = 1; i <= 12; i++)
            {
                if (dtPastYearDate.AddMonths(i) == Now)
                {
                    Months = i;
                    break;
                }
                else if (dtPastYearDate.AddMonths(i) >= Now)
                {
                    Months = i - 1;
                    break;
                }
            }
            int Days = Now.Subtract(dtPastYearDate.AddMonths(Months)).Days;
            int Hours = Now.Subtract(dtPastYearDate).Hours;
            int Minutes = Now.Subtract(dtPastYearDate).Minutes;
            int Seconds = Now.Subtract(dtPastYearDate).Seconds;

            return String.Format("{0} Year(s), {1} Month(s), {2} Day(s), {3} Hour(s), {4} Second(s)",
                                Years, Months, Days, Hours, Seconds);
        }

        public static async Task<string> getFollows()
        {
            try
            {
                // create twitch api instance
                var api = new TwitchLib.Api.TwitchAPI();
                api.Settings.ClientId = Config.TwitchClientId;
                api.Settings.AccessToken = Config.TwitchClientOAuth;

                var data = await api.Helix.Users.GetUsersFollowsAsync(toId: Config.TwitchMC_Id);
                return data.TotalFollows.ToString();
            }
            catch
            {
                return "Could not get the follow count";
            }
        }

        public static async Task<string> getViews()
        {
            try
            {
                // create twitch api instance
                var api = new TwitchLib.Api.TwitchAPI();
                api.Settings.ClientId = Config.TwitchClientId;
                api.Settings.AccessToken = Config.TwitchClientOAuth;

                var data = await api.Helix.Users.GetUsersAsync(ids: new List<string> { Config.TwitchMC_Id }, null, Config.TwitchClientOAuth);
                return data.Users[0].ViewCount.ToString();
            }
            catch
            {
                return "Could not get the view count";
            }
        }

        public static async Task<string> getGame()
        {
            try
            {
                // create twitch api instance
                var api = new TwitchAPI();
                api.Settings.ClientId = Config.TwitchClientId;

                var data = await api.Helix.Channels.GetChannelInformationAsync(Config.TwitchMC_Id, Config.TwitchClientOAuth);
                return data.Data[0].GameName;
            }
            catch
            {
                return "Could not get the Game Title";
            }
        }

        public static async Task<string> getTitle()
        {
            try
            {
                // create twitch api instance
                var api = new TwitchAPI();
                api.Settings.ClientId = Config.TwitchClientId;

                var data = await api.Helix.Channels.GetChannelInformationAsync(Config.TwitchMC_Id, Config.TwitchClientOAuth);
                return data.Data[0].Title;
            }
            catch
            {
                return "Could not get the Stream Title";
            }
        }

        // Tags unused, not documented well to implement
        public static async Task<string> getTags()
        {
            try
            {
                // create twitch api instance
                var api = new TwitchAPI();
                api.Settings.ClientId = Config.TwitchClientId;

                var data = await api.Helix.Streams.GetStreamTagsAsync(Config.TwitchMC_Id, Config.TwitchClientOAuth);
                return data.Data[0].TagId;
            }
            catch
            {
                return "Could not get the Stream Tags";
            }
        }

        public static async Task<string> searchGames(string input)
        {
            // create twitch api instance
            var api = new TwitchAPI();
            api.Settings.ClientId = Config.TwitchClientId;

            var data = await api.Helix.Search.SearchCategoriesAsync(input);

            // Set a JSON Array
            JArray array = new JArray();

            for (var i = 0; i < data.Games.Length; i++)
            {
                // Encode as JSON
                array.Add(new JObject()
                {
                    { "game_title", data.Games[i].Name.ToString() }
                });
            }

            // Encode as JSON
            JObject o = new JObject();
            o["data"] = array;

            return o.ToString();
        }

        public static async Task<string> getUpTime()
        {
            // create twitch api instance
            var api = new TwitchAPI();
            api.Settings.ClientId = Config.TwitchClientId;
            api.Settings.AccessToken = Config.TwitchClientOAuth;

            try
            {
                var data = await api.Helix.Streams.GetStreamsAsync(userIds: new List<string> { Config.TwitchMC_Id });

                DateTime current_time = DateTime.UtcNow;
                DateTime user_time = DateTime.Parse(data.Streams[0].StartedAt.ToString());

                TimeSpan timeDifference = current_time - user_time;
                return (Math.Floor(timeDifference.Days % 365.25) + " days " + timeDifference.Hours + " hours " + timeDifference.Minutes + " mins " + timeDifference.Seconds + " secs").ToString();
                // return (Math.Floor(timeDifference.Days / 365.25) + " years " + Math.Floor((timeDifference.Days / 30.4167) % 12) + " months " + Math.Floor(timeDifference.Days % 365.25) + " days " + timeDifference.Hours + " hours " + timeDifference.Minutes + " mins " + timeDifference.Seconds + " secs").ToString();                
            }
            catch
            {
                return "... Stream is offline";
            }
        }

        public static async Task<string> ShoutOut(string userId)
        {
            try
            {
                // create twitch api instance
                var api = new TwitchAPI();
                api.Settings.ClientId = Config.TwitchClientId;

                // search for user
                var user = await api.Helix.Users.GetUsersAsync(null, logins: new List<string> { userId }, Config.TwitchClientOAuth);

                // Get Channel Information
                var channel = await api.Helix.Channels.GetChannelInformationAsync(broadcasterId: user.Users[0].Id, Config.TwitchClientOAuth);

                // Shoutout from ID to API
                // await api.Helix.Chat.SendShoutoutAsync(fromBroadcasterId: Config.TwitchMC_Id, toBroadcasterId: channel.Data[0].BroadcasterId, moderatorId: Config.TwitchBotId, Config.TwitchClientOAuth);

                // Sent Shoutout in Chat
                return "Check out my friend, " + channel.Data[0].BroadcasterName + "! they've been playing: " + channel.Data[0].GameName + " @ http://twitch.tv/" + user.Users[0].Login;
            }
            catch
            {
                return "Failed to return the shoutout information";
            }
        }

        public static bool commandBlacklist(string username)
        {
            string cs = @"URI=file:" + AppDomain.CurrentDomain.BaseDirectory + "/Data/bot.db";
            using var con = new SQLiteConnection(cs);
            con.Open();

            string stm = "SELECT * FROM gb_commands_blacklist WHERE username = '" + username + "' LIMIT 1";

            using var cmd = new SQLiteCommand(stm, con);
            using SQLiteDataReader rdr = cmd.ExecuteReader();

            if (rdr.HasRows == true)
            {
                while (rdr.Read())
                {
                    return true;
                }
            }

            con.Close();
            return false;
        }

        public static string userPoints(string userId)
        {

            string cs = @"URI=file:" + AppDomain.CurrentDomain.BaseDirectory + "/Data/bot.db";
            using var con = new SQLiteConnection(cs);
            con.Open();

            string stm = "SELECT * FROM gb_points WHERE username = '" + userId + "' AND username NOT IN (SELECT username FROM gb_points_blacklist) AND username NOT IN (SELECT username FROM gb_twitch_botlist) LIMIT 1";

            using var cmd = new SQLiteCommand(stm, con);
            using SQLiteDataReader rdr = cmd.ExecuteReader();

            if (rdr.HasRows == true)
            {
                while (rdr.Read())
                {
                    return rdr["value"].ToString();
                }
            } else {
                return "N/A";
            }

            con.Close();
            return "0";
        }

    }
}
