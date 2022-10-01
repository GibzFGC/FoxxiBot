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
using System.Threading;
using TwitchLib.Client;
using TwitchLib.Client.Enums;
using TwitchLib.Client.Events;
using TwitchLib.Client.Extensions;
using TwitchLib.Client.Models;
using TwitchLib.Communication.Clients;
using TwitchLib.Communication.Events;
using TwitchLib.Communication.Models;
using TwitchLib.PubSub;

namespace FoxxiBot.TwitchBot
{

    public class Twitch_Main
    {
        public static TwitchClient client;
        public static TwitchPubSub pubsub;

        private Timer oauthTimer = null;
        private Timer liveTimer = null;
        private Timer pointsTimer = null;
        private string gameTitle = null;

        string cs = @"URI=file:" + AppDomain.CurrentDomain.BaseDirectory + "/Data/bot.db";

        bool streamStatus;
        int current_row = 1;

        // Get Twitch SQL Access
        SQLite.twitchSQL twitchSQL = new SQLite.twitchSQL();

        public Twitch_Main()
        {
            ConnectionCredentials credentials = new ConnectionCredentials(Config.TwitchClientUser, Config.TwitchClientOAuth);
            var clientOptions = new ClientOptions
            {
                MessagesAllowedInPeriod = 750,
                ThrottlingPeriod = TimeSpan.FromSeconds(30)
            };
            WebSocketClient customClient = new WebSocketClient(clientOptions);
            client = new TwitchClient(customClient);
            client.Initialize(credentials, Config.TwitchClientChannel);

            pubsub = new TwitchPubSub();

            client.OnLog += Client_OnLog;
            client.OnJoinedChannel += Client_OnJoinedChannel;
            client.OnLeftChannel += Client_OnLeftChannel;
            client.OnMessageReceived += Client_OnMessageReceived;
            client.OnNewSubscriber += Client_OnNewSubscriber;
            client.OnConnected += Client_OnConnected;
            client.OnDisconnected += Client_OnDisconnected;
            client.OnIncorrectLogin += Client_OnIncorrectLogin;
            client.OnRaidNotification += Client_OnRaidNotification;
            client.OnUserJoined += Client_UserJoined;
            client.OnUserLeft += Client_UserLeft;
            client.OnChatCommandReceived += Client_OnChatCommandReceived;

            pubsub.OnPubSubServiceConnected += Pubsub_OnPubSubServiceConnected;
            pubsub.OnListenResponse += Pubsub_OnListenResponse;
            pubsub.OnStreamUp += Pubsub_OnStreamUp;
            pubsub.OnStreamDown += Pubsub_OnStreamDown;
            pubsub.OnFollow += PubSub_OnFollow;
            pubsub.OnRaidUpdateV2 += PubSub_OnRaidUpdateV2;

            client.Connect();
            pubsub.Connect();

            // Check Twitch Plugins
            Twitch_Jint plugins = new Twitch_Jint();
            plugins.loadPlugins();

            // Start Bot Timer
            System.Timers.Timer timer = new System.Timers.Timer();
            timer.Interval = 900000;
            timer.Elapsed += timer_Elapsed;
            timer.Start();

            // Erase Watchlist
            SQLite.twitchSQL TwitchSQl = new SQLite.twitchSQL();
            TwitchSQl.eraseWatchlist();

            // Start Points Timer
            pointsTimer = new Timer(pointsUpdate, null, 0, 300000);

            // Start Live Check Timer
            liveTimer = new Timer(streamLiveCallBack, null, 0, 60000);

            // Start OAuth Timer -- every 3 hours, 30 mins
            oauthTimer = new Timer(OauthCallback, null, 0, 12600000);
            //oauthTimer = new Timer(OauthCallback, null, 0, 1800000);
        }

        private void PubSub_OnRaidUpdateV2(object sender, TwitchLib.PubSub.Events.OnRaidUpdateV2Args e)
        {
                // Convert used variables
                Twitch_Variables variables = new Twitch_Variables();
                var var_string = variables.convertVariables(null, twitchSQL.getOptions("On_Raid_Message"), e.TargetDisplayName, e.TargetLogin);

                // Send On Raid message
                SendChatMessage(var_string);
        }

        private void Client_OnLeftChannel(object sender, OnLeftChannelArgs e)
        {
            Class.Bot_Functions.WriteColour($"{DateTime.Now}: {Config.TwitchBotName} [| Twitch] - Dropped Channel Connection! Trying to Reconnect...", ConsoleColor.Blue);
            client.JoinChannel(Config.TwitchClientChannel);
        }

        private void Client_OnDisconnected(object sender, OnDisconnectedEventArgs e)
        {

            if (!client.IsConnected)
            {
                Class.Bot_Functions.WriteColour($"{DateTime.Now}: {Config.TwitchBotName} [| Twitch] - Connection Lost! Trying to Reconnect...", ConsoleColor.Blue);

                while (!client.IsConnected)
                {

                    ConnectionCredentials credentials = new ConnectionCredentials(Config.TwitchClientUser, Config.TwitchClientOAuth);
                    var clientOptions = new ClientOptions
                    {
                        MessagesAllowedInPeriod = 750,
                        ThrottlingPeriod = TimeSpan.FromSeconds(30)
                    };
                    WebSocketClient customClient = new WebSocketClient(clientOptions);
                    client = new TwitchClient(customClient);
                    client.Initialize(credentials, Config.TwitchClientChannel);

                    pubsub = new TwitchPubSub();

                    client.OnLog += Client_OnLog;
                    client.OnJoinedChannel += Client_OnJoinedChannel;
                    client.OnLeftChannel += Client_OnLeftChannel;
                    client.OnMessageReceived += Client_OnMessageReceived;
                    client.OnNewSubscriber += Client_OnNewSubscriber;
                    client.OnConnected += Client_OnConnected;
                    client.OnDisconnected += Client_OnDisconnected;
                    client.OnIncorrectLogin += Client_OnIncorrectLogin;
                    client.OnRaidNotification += Client_OnRaidNotification;
                    client.OnUserJoined += Client_UserJoined;
                    client.OnUserLeft += Client_UserLeft;

                    client.OnChatCommandReceived += Client_OnChatCommandReceived;

                    pubsub.OnPubSubServiceConnected += Pubsub_OnPubSubServiceConnected;
                    pubsub.OnListenResponse += Pubsub_OnListenResponse;
                    pubsub.OnStreamUp += Pubsub_OnStreamUp;
                    pubsub.OnStreamDown += Pubsub_OnStreamDown;
                    pubsub.OnFollow += PubSub_OnFollow;

                    client.Connect();
                    pubsub.Connect();

                }
            }

        }

        private void pointsUpdate(object state)
        {

            SQLite.botSQL botSQL = new SQLite.botSQL();

            // If Points System Active
            if (botSQL.pointOptions("points_active") == "on")
            {

                // Give Points if Live
                if (streamStatus == true)
                {

                    // Get Increment Value
                    var increment = botSQL.pointOptions("points_increment");

                    // Increase all Current Viewers Points Count
                    using var con = new SQLiteConnection(cs);
                    SQLiteTransaction this_transaction;
                    con.Open();

                    string stm = "UPDATE gb_points SET value = value + " + increment + " WHERE EXISTS (SELECT username FROM gb_twitch_watchlist WHERE username = gb_points.username)";

                    // Start a local transaction
                    this_transaction = con.BeginTransaction();

                    using var updateUser = new SQLiteCommand(stm, con);
                    updateUser.Prepare();
                    updateUser.ExecuteNonQuery();

                    // Commit all Data to SQL
                    this_transaction.Commit();

                    // Close all connections
                    con.Close();

                }
            }
        }

        private void streamLiveCallBack(object state)
        {
            // Check Bot Owners Twitch Channel
            streamStatus = Twitch_GetData.streamStatus().GetAwaiter().GetResult();

            // Set Game
            SQLite.botSQL gameSQL = new SQLite.botSQL();
            var data = Twitch_GetData.getGame().GetAwaiter().GetResult();

            if (gameTitle != data.ToString())
            {
                gameTitle = data.ToString();
                gameSQL.updateOptions("game_title", data.ToString());
            }
        }

        private void timer_Elapsed(object sender, System.Timers.ElapsedEventArgs e)
        {

            // if stream live, let timers play
            if (streamStatus == true)
            {
                using var con = new SQLiteConnection(cs);
                con.Open();

                string stm = $"SELECT * FROM gb_twitch_timers WHERE rowid = {current_row} AND active = 1";

                using var cmd = new SQLiteCommand(stm, con);
                using SQLiteDataReader rdr = cmd.ExecuteReader();

                if (rdr.HasRows == true)
                {
                    while (rdr.Read())
                    {
                        // Send Announcement to Twitch
                        client.Announce(Config.TwitchClientChannel, (string)rdr["response"]);

                        // Add 1 to current_row
                        current_row = current_row + 1;
                    }
                }
                else
                {
                    // Reset the current row count
                    current_row = 1;
                }

                con.Close();

                // If Discord is Active & Stream Live
                if (Config.DiscordToken != null)
                {

                }

            }
        }

        private static void refreshBotOauth()
        {
            var api = new TwitchLib.Api.TwitchAPI();
            api.Settings.ClientId = Config.TwitchClientId;

            // Get New Auth Token
            var bot_authToken = api.Auth.RefreshAuthTokenAsync(Config.TwitchClientRefresh, Config.TwitchClientSecret).GetAwaiter().GetResult();
            Config.TwitchClientOAuth = bot_authToken.AccessToken;
            Config.TwitchClientRefresh = bot_authToken.RefreshToken;

            // Get New Auth Token
            var broadcast_authToken = api.Auth.RefreshAuthTokenAsync(Config.TwitchMC_ClientRefresh, Config.TwitchClientSecret).GetAwaiter().GetResult();
            Config.TwitchMC_ClientOAuth = broadcast_authToken.AccessToken;
            Config.TwitchMC_ClientRefresh = broadcast_authToken.RefreshToken;

            // Save the new JSON Data
            Class.Bot_Functions functions = new Class.Bot_Functions();
            functions.SaveConfig().GetAwaiter().GetResult();

            // OAuth Check Complete
            Class.Bot_Functions.WriteColour($"{DateTime.Now}: {Config.TwitchBotName} [| Twitch] - Re-Authentication Complete", ConsoleColor.Blue);
        }

        private static void OauthCallback(object state)
        {
            // Announce OAuth Check
            Class.Bot_Functions.WriteColour($"{DateTime.Now}: {Config.TwitchBotName} [| Twitch] - Renewing Bot / Broadcaster Authentication", ConsoleColor.Blue);

            // Check Twitch Tokens
            refreshBotOauth();
        }

        private void Pubsub_OnListenResponse(object sender, TwitchLib.PubSub.Events.OnListenResponseArgs e)
        {
            if (e.Successful)
            {
                Console.WriteLine(DateTime.Now + ": " + Config.TwitchBotName + $" - {e.Topic}");
            }
            else
            {
                Console.WriteLine(DateTime.Now + ": " + Config.TwitchBotName + $" - { e.Response.Error}");
            }
        }

        private void Pubsub_OnPubSubServiceConnected(object sender, EventArgs e)
        {
            pubsub.ListenToVideoPlayback(Config.TwitchMC_Id);
            pubsub.ListenToFollows(Config.TwitchMC_Id);
            pubsub.ListenToWhispers(Config.TwitchMC_Id);

            // If Twitch Affiliate / Partner, access Bits and Channel Point Directives
            if (twitchSQL.getOptions("Partner_Status") == "on")
            {
                pubsub.ListenToBitsEventsV2(Config.TwitchMC_Id);
                pubsub.ListenToChannelPoints(Config.TwitchMC_Id);
            }

            pubsub.SendTopics(Config.TwitchMC_ClientOAuth);
            Class.Bot_Functions.WriteColour($"{DateTime.Now}: {Config.TwitchBotName} [| Twitch] - Service Connected (PubSub)", ConsoleColor.Blue);
        }

        private void Client_OnRaidNotification(object sender, OnRaidNotificationArgs e)
        {
            // Save Data to Events & Notifications
            SQLite.twitchSQL TwitchSQL = new SQLite.twitchSQL();
            TwitchSQL.saveEvent("Raid", e.RaidNotification.DisplayName.ToString(), e.RaidNotification.MsgParamViewerCount.ToString());
            TwitchSQL.saveNotification("Raid", e.RaidNotification.DisplayName.ToString(), e.RaidNotification.MsgParamViewerCount.ToString(), DateTime.Now.ToString());

            // Get Raid Message
            var raid_message = twitchSQL.getOptions("Raid_Message");

            // Convert variables if used
            if (raid_message.Contains("{user}"))
            {
                raid_message = raid_message.Replace("{user}", e.RaidNotification.DisplayName.ToString());
            }

            if (raid_message.Contains("{count}"))
            {
                raid_message = raid_message.Replace("{count}", e.RaidNotification.MsgParamViewerCount.ToString());
            }

            // Mention it in Chat
            client.SendMessage(e.Channel, raid_message);
            Console.WriteLine(DateTime.Now + ": " + Config.TwitchBotName + " - " + raid_message);

            // Instant Shoutout
            Twitch_Commands commands = new Twitch_Commands();
            var result = commands.raidShoutout(e);
            SendChatMessage(result);
        }

        private void PubSub_OnFollow(object sender, TwitchLib.PubSub.Events.OnFollowArgs e)
        {
            // Save Data to Events & Notifications
            SQLite.twitchSQL TwitchSQL = new SQLite.twitchSQL();
            TwitchSQL.saveEvent("Follower", e.DisplayName.ToString(), "0");
            TwitchSQL.saveNotification("Follower", e.DisplayName.ToString(), "0", DateTime.Now.ToString());

            // Mention it in Chat
            var follow_message = twitchSQL.getOptions("Follow_Message");

            // Convert variables if used
            if (follow_message.Contains("{user}"))
            {
                follow_message = follow_message.Replace("{user}", e.DisplayName.ToString());
            }

            // Mention it in Chat
            client.SendMessage(Config.TwitchClientChannel, follow_message);
            Console.WriteLine(DateTime.Now + ": " + Config.TwitchBotName + " - " + follow_message);
        }

        private void Pubsub_OnStreamUp(object sender, TwitchLib.PubSub.Events.OnStreamUpArgs e)
        {
            // Tell the Streamer that the Steam is now Live
            Class.Bot_Functions.WriteColour($"{DateTime.Now}: {Config.TwitchBotName} [| Twitch] - Stream just went up! Play delay: {e.PlayDelay}, server time: {e.ServerTime}", ConsoleColor.Blue);

            // If Discord Auto Stream Message is Active, Send a Notification
            Discord_AutoLiveMessage();

            // If Twitter & LiveStatement is Active, Send a Tweet
            SQLite.botSQL botSQL = new SQLite.botSQL();

            if (botSQL.getOptions("twitter_features") == "on")
            {

                if (botSQL.getOptions("twitter_livestatement_status") == "on")
                {
                    // Check if Game has it's own Method
                    using var con = new SQLiteConnection(cs);
                    con.Open();

                    // Get the currently played game
                    var data = Twitch_GetData.getGame().GetAwaiter().GetResult();

                    // Start DB Search
                    string stm = "SELECT * FROM gb_twitter_status WHERE game = '" + data.ToString() + "' OR game = 'null' AND active = 1 LIMIT 1";

                    using var cmd = new SQLiteCommand(stm, con);
                    using SQLiteDataReader rdr = cmd.ExecuteReader();

                    if (rdr.HasRows == true)
                    {

                        while (rdr.Read())
                        {

                            Twitch_Variables variables = new Twitch_Variables();
                            var tweet_status = variables.convertVariables(null, rdr["tweet"].ToString(), null, null);

                            Services.Twitter.Twitter_Main twitterAPI = new Services.Twitter.Twitter_Main();
                            twitterAPI.sendTweet(tweet_status).GetAwaiter().GetResult();

                        }

                    }

                    con.Close();
                }

            }
        }

        private void Pubsub_OnStreamDown(object sender, TwitchLib.PubSub.Events.OnStreamDownArgs e)
        {
            Console.WriteLine(DateTime.Now + ": " + Config.TwitchBotName + " - " + $"Stream just went down! Server time: {e.ServerTime}");
        }

        private void Client_OnIncorrectLogin(object sender, OnIncorrectLoginArgs e)
        {
            Console.WriteLine(e.Exception);
        }

        private void Client_OnLog(object sender, OnLogArgs e)
        {
            Class.Bot_Functions.WriteColour($"{e.DateTime.ToString()}: {Config.TwitchBotName} [| Twitch] - {e.Data}", ConsoleColor.Blue);
        }

        private void Client_OnConnected(object sender, OnConnectedArgs e)
        {
            Console.WriteLine(DateTime.Now + ": " + Config.TwitchBotName + " - " + $"Connected to {Config.TwitchClientChannel}");
        }

        private void Client_OnJoinedChannel(object sender, OnJoinedChannelArgs e)
        {
            // Get Join Message
            var joined_message = twitchSQL.getOptions("Joined_Channel");

            if (joined_message.Contains("{bot}"))
            {
                joined_message = joined_message.Replace("{bot}", Config.TwitchBotName.ToString());
            }

            Console.WriteLine(DateTime.Now + ": " + Config.TwitchBotName + " - " + joined_message);
            client.SendMessage(e.Channel, joined_message);
        }

        private void Client_OnChatCommandReceived(object sender, OnChatCommandReceivedArgs e)
        {

            // Command Declarations
            Twitch_Commands commands = new Twitch_Commands();
            Twitch_Games games = new Twitch_Games();
            Twitch_Points points = new Twitch_Points();

            //// == Admin Commands == ////
            //

            if (e.Command.ChatMessage.IsBroadcaster || e.Command.ChatMessage.IsModerator)
            {
                // Add a Command (command name | command text | command points cost)
                if (e.Command.CommandText == "addcom")
                {
                    var split = e.Command.ArgumentsAsString.Split("|");
                    int pointsVal;

                    // Check if a Points value has been given
                    if (split.Length < 3)
                    {
                        pointsVal = 0;
                    }
                    else
                    {
                        pointsVal = Convert.ToInt32(split[2]);
                    }

                    // Save the new command to the DB
                    using var addcom = new SQLiteConnection(cs);
                    addcom.Open();

                    using var insertCmd = new SQLiteCommand(addcom);
                    insertCmd.CommandText = "INSERT INTO gb_commands (name, response, points, permission, active) VALUES (@name, @response, @points, @permission, @active)";

                    insertCmd.Parameters.AddWithValue("@name", "!" + split[0].Replace(" ", ""));
                    insertCmd.Parameters.AddWithValue("@response", split[1]);
                    insertCmd.Parameters.AddWithValue("@points", pointsVal);
                    insertCmd.Parameters.AddWithValue("@permission", 0);
                    insertCmd.Parameters.AddWithValue("@active", 1);

                    insertCmd.Prepare();
                    insertCmd.ExecuteNonQuery();

                    addcom.Close();

                    // Send message to Twitch Chat
                    SendChatMessage(e.Command.ChatMessage.DisplayName + ", the Command !" + split[0] + " has been added!");

                }

                // Edit a Command (command name | command text | command points cost)
                if (e.Command.CommandText == "editcom")
                {
                    var split = e.Command.ArgumentsAsString.Split("|");
                    int pointsVal;

                    // Check if a Points value has been given
                    if (split.Length < 3)
                    {
                        pointsVal = 0;
                    }
                    else
                    {
                        pointsVal = Convert.ToInt32(split[2]);
                    }

                    // Save the edited command to the DB
                    using var editcom = new SQLiteConnection(cs);
                    editcom.Open();

                    using var updateCmd = new SQLiteCommand(editcom);

                    updateCmd.CommandText = "UPDATE gb_commands SET response = @response, points = @points WHERE name = @name";

                    updateCmd.Parameters.AddWithValue("@name", "!" + split[0].Replace(" ", ""));
                    updateCmd.Parameters.AddWithValue("@response", split[1]);
                    updateCmd.Parameters.AddWithValue("@points", pointsVal);
                    updateCmd.Parameters.AddWithValue("@permission", 0);
                    updateCmd.Parameters.AddWithValue("@active", 1);

                    updateCmd.Prepare();
                    updateCmd.ExecuteNonQuery();

                    editcom.Close();

                    // Send message to Twitch Chat
                    SendChatMessage(e.Command.ChatMessage.DisplayName + ", the Command !" + split[0] + " has been updated!");

                }

                // Delete a Command (command name)
                if (e.Command.CommandText == "delcom")
                {
                    // Delete a Command from the DB
                    using var delcom = new SQLiteConnection(cs);
                    delcom.Open();

                    using var deleteCmd = new SQLiteCommand(delcom);
                    deleteCmd.CommandText = "DELETE FROM gb_commands WHERE name = @name";
                    deleteCmd.Parameters.AddWithValue("@name", e.Command.ArgumentsAsString);

                    deleteCmd.Prepare();
                    deleteCmd.ExecuteNonQuery();

                    delcom.Close();

                    // Send message to Twitch Chat
                    SendChatMessage(e.Command.ChatMessage.DisplayName + ", the Command " + e.Command.ArgumentsAsString + " has been deleted!");
                    
                }

                // Link Permission Handler           
                if (e.Command.CommandText == "permit")
                {
                    var result = commands.commandPermitUser(e);
                    SendChatMessage(result);
                }

                // Link Permission Handler
                if (e.Command.CommandText == "disconnect")
                {
                    SendChatMessage(Config.TwitchBotName + " will now close the Twitch Connection...");
                    client.Disconnect();
                }

            }

            //// == User Commands == ////
            ///
            // Account Age Handler
            if (e.Command.CommandText == "accountage")
            {
                var result = commands.commandAccountAge(e);
                SendChatMessage(result);
            }

            // Deaths Handler
            if (e.Command.CommandText == "deaths")
            {
                var result = commands.commandDeaths(e);
                SendChatMessage(result);
            }

            // Follow Age Handler
            if (e.Command.CommandText == "followage")
            {
                // Check if Broadcaster
                if (e.Command.ChatMessage.IsBroadcaster)
                {
                    SendChatMessage(e.Command.ChatMessage.DisplayName + ", You can't check yourself, silly goose!");
                }

                var result = commands.commandFollowAge(e);
                SendChatMessage(result);
            }

            // Giveaway Handler
            if (e.Command.CommandText == "gw" || e.Command.CommandText == "giveaway")
            {
                var result = commands.commandGiveaway(e);
                SendChatMessage(result);
            }

            // Shoutout Handler
            if (e.Command.CommandText == "so" || e.Command.CommandText == "shoutout")
            {
                var result = commands.commandShoutout(e);
                SendChatMessage(result);
            }

            // Sound Handler
            if (e.Command.CommandText == "sound" || e.Command.CommandText == "audio" || e.Command.CommandText == "play")
            {
                var result = commands.commandSound(e);
                SendChatMessage(result);
            }

            //// == Game Commands == ////
            ///
            if (e.Command.CommandText == "duel")
            {
                var result = games.commandDuel(e);
                SendChatMessage(result);
            }

            //// == Points Commands == ////
            ///
            // Gamble Handler
            if (e.Command.CommandText == "gamble")
            {
                var result = points.commandGamblePoints(e);
                SendChatMessage(result);
            }

            //// == Twitter Commands == ////
            ///
            // Poll
            if (e.Command.CommandText == "poll")
            {

                if (e.Command.ChatMessage.IsBroadcaster || e.Command.ChatMessage.IsModerator)
                {
                    SQLite.pollSQL pollSQL = new SQLite.pollSQL();

                    if (e.Command.ArgumentsAsString == "end")
                    {
                        pollSQL.updateOptions("active_poll", "0");
                        pollSQL.updateOptions("allow_voting", "0");

                        SendChatMessage("The poll has now closed, thank you for taking part!");
                        return;
                    }
                    else
                    {
                        var result = pollSQL.pollData(e.Command.ArgumentsAsString);
                        SendChatMessage(result);

                        pollSQL.updateOptions("active_poll", e.Command.ArgumentsAsString);
                        pollSQL.updateOptions("allow_voting", "1");
                    }
                }

            }

            // Voting
            if (e.Command.CommandText == "vote")
            {
                SQLite.pollSQL pollSQL = new SQLite.pollSQL();

                if (pollSQL.getOptions("allow_voting") == "0")
                {
                    SendChatMessage(e.Command.ChatMessage.DisplayName + ", Sorry voting is currently closed!");
                    return;
                }

                var result = commands.commandVoting(e);
                SendChatMessage(result);
            }


            //// == Twitter Commands == ////
            ///
            // Tweet Handler
            if (e.Command.CommandText == "tweet")
            {
                if (e.Command.ChatMessage.IsBroadcaster)
                {
                    // Check if Twitter Features are Active
                    SQLite.botSQL botSQL = new SQLite.botSQL();
                    if (botSQL.getOptions("twitter_features") == "off")
                    {
                        SendChatMessage("The bot's Twitter Functionality is currently turned off");
                        return;
                    }

                    // Twitter Confirmed Active, Let's Tweet!
                    Services.Twitter.Twitter_Main twitterAPI = new Services.Twitter.Twitter_Main();

                    Twitch_Variables variables = new Twitch_Variables();
                    var var_string = variables.convertVariables(null, e.Command.ArgumentsAsString, null, null);

                    twitterAPI.sendTweet(var_string).GetAwaiter().GetResult();
                    SendChatMessage("The tweet has been sent!");
                }
            }

            // If command not development defined, check users custom in SQLite
            using var con = new SQLiteConnection(cs);
            con.Open();

            string stm = "SELECT * FROM gb_commands WHERE name = '!" + e.Command.CommandText + "' AND active = 1";

            using var cmd = new SQLiteCommand(stm, con);
            using SQLiteDataReader rdr = cmd.ExecuteReader();

            if (rdr.HasRows == true)
            {
                while (rdr.Read())
                {
                    if (e.Command.ChatMessage.UserType >= (UserType)Enum.Parse(typeof(UserType), rdr["permission"].ToString()))
                    {
                        // Has Points Definition?
                        if ((int)(long)rdr["points"] > 0)
                        {
                            int user_points = Convert.ToInt32(Twitch_GetData.userPoints(e.Command.ChatMessage.Username));

                            if (user_points < (int)(long)rdr["points"])
                            {
                                SendChatMessage(e.Command.ChatMessage.DisplayName + ", sorry, you don't have enough points to use that command!");
                                return;
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

                        // Perform the Command
                        Twitch_Variables variables = new Twitch_Variables();
                        var var_string = variables.convertVariables(e.Command.ChatMessage.Message, (string)rdr["response"], e.Command.ChatMessage.DisplayName, e.Command.ChatMessage.Username);
                        SendChatMessage(var_string);
                    }
                }
            }
            else
            {
                // Check if Plugin
                Twitch_Jint plugin = new Twitch_Jint();
                plugin.ExecPlugin(e.Command.ChatMessage.Channel, e, client, e.Command.ChatMessage.Message);
            }

            con.Close();
        }

        private void Client_OnMessageReceived(object sender, OnMessageReceivedArgs e)
        {

            // Manage Moderation
            Twitch_Moderation moderation = new Twitch_Moderation();
            SQLite.twitchSQL twitchSQL = new SQLite.twitchSQL();

            // Will skip if the user is Twitch Staff, the Broadcaster, a Moderator or VIP
            if (e.ChatMessage.IsBroadcaster || e.ChatMessage.IsModerator || e.ChatMessage.IsVip || e.ChatMessage.IsStaff)
            {
                // Skip over, higher power people at work!
            }
            else
            {
                // Check Blacklist
                if (twitchSQL.getOptions("Blacklist_Status") == "on")
                {
                    if (moderation.checkBlacklist(e.ChatMessage.Message) == true)
                    {
                        client.SendMessage(e.ChatMessage.Channel, "/delete " + e.ChatMessage.Id);
                        client.SendMessage(e.ChatMessage.Channel, "This message contains a word that is blocked on this channel.");
                        return;
                    }
                }

                // Check Caps
                if (twitchSQL.getOptions("CapsFilter_Status") == "on")
                {
                    if (moderation.checkCaps(e.ChatMessage.Message) == true)
                    {
                        client.SendMessage(e.ChatMessage.Channel, e.ChatMessage.DisplayName + ", Please don't over-use CAPS in chat. Thank you!");
                        return;
                    }
                }

                // Check Symbols
                if (twitchSQL.getOptions("SymbolsFilter_Status") == "on")
                {
                    if (moderation.checkSymbols(e.ChatMessage.Message) == true)
                    {
                        client.SendMessage(e.ChatMessage.Channel, e.ChatMessage.DisplayName + ", Please don't over-use Symbols in chat. Thank you!");
                        return;
                    }
                }

                // Check URL
                if (twitchSQL.getOptions("LinkFilter_Status") == "on")
                {
                    if (moderation.checkURL(e.ChatMessage.Message) == true)
                    {
                        if (twitchSQL.getOptions("Whitelist_Status") == "on")
                        {
                            if (twitchSQL.getOptions("Permitted_User") == e.ChatMessage.DisplayName)
                            {
                                twitchSQL.updateOptions("Permitted_User", "");
                                return;
                            }

                            if (moderation.checkWhitelist(e.ChatMessage.Message) == true)
                            {
                                return;
                            }
                            else
                            {
                                client.SendMessage(e.ChatMessage.Channel, "/delete " + e.ChatMessage.Id);
                                client.SendMessage(e.ChatMessage.Channel, e.ChatMessage.DisplayName + ", We don't allow links in chat right now. Sorry!");
                                return;
                            }
                        }
                    }
                    else
                    {

                        if (moderation.checkURL(e.ChatMessage.Message) == true)
                        {
                            client.SendMessage(e.ChatMessage.Channel, "/delete " + e.ChatMessage.Id);
                            client.SendMessage(e.ChatMessage.Channel, e.ChatMessage.DisplayName + ", We don't allow links in chat right now. Sorry!");
                            return;
                        }
                    }
                }

                // Check Spam
                if (twitchSQL.getOptions("SpamFilter_Status") == "on")
                {
                    if (moderation.checkSpam(e.ChatMessage.Message) == true)
                    {
                        client.SendMessage(e.ChatMessage.Channel, "/delete " + e.ChatMessage.Id);
                        client.SendMessage(e.ChatMessage.Channel, e.ChatMessage.DisplayName + ", Please don't spam in the chat. Thank you!");
                        return;
                    }
                }

                // Check /Me
                if (twitchSQL.getOptions("MeFilter_Status") == "on")
                {
                    if (e.ChatMessage.IsMe)
                    {
                        client.SendMessage(e.ChatMessage.Channel, "/delete " + e.ChatMessage.Id);
                        client.SendMessage(e.ChatMessage.Channel, e.ChatMessage.DisplayName + ", We have /me commands turned off. Sorry!");
                        return;
                    }
                }

                // Check System Messages
                if (twitchSQL.getOptions("SystemFilter_Status") == "on")
                {
                    if (moderation.checkSystemMsg(e.ChatMessage.Message) == true)
                    {
                        client.SendMessage(e.ChatMessage.Channel, "/delete " + e.ChatMessage.Id);
                        client.SendMessage(e.ChatMessage.Channel, e.ChatMessage.DisplayName + ", Please don't fake moderation/system messages in the chat. Thank you!");
                        return;
                    }
                }
            }

        }

        private void Client_OnNewSubscriber(object sender, OnNewSubscriberArgs e)
        {
            if (e.Subscriber.SubscriptionPlan == SubscriptionPlan.Prime)
            {
                // Get Prime Message
                var prime_message = twitchSQL.getOptions("Prime_Message");

                // Convert variables if used
                if (prime_message.Contains("{user}"))
                {
                    prime_message = prime_message.Replace("{user}", e.Subscriber.DisplayName.ToString());
                }

                client.SendMessage(e.Channel, prime_message);
            }
            else
            {
                // Get Prime Message
                var subscriber_message = twitchSQL.getOptions("Subcriber_Message");

                // Convert variables if used
                if (subscriber_message.Contains("{user}"))
                {
                    subscriber_message = subscriber_message.Replace("{user}", e.Subscriber.DisplayName.ToString());
                }

                client.SendMessage(e.Channel, subscriber_message);
            }
        }

        public void SendChatMessage(string message)
        {
            client.SendMessage(Config.TwitchClientChannel, message);
        }

        private void Client_UserJoined(object sender, OnUserJoinedArgs e)
        {
            using var con = new SQLiteConnection(cs);

            con.Open();
            using var insertCmd = new SQLiteCommand(con);

            insertCmd.CommandText = "INSERT or IGNORE INTO gb_twitch_watchlist(username) VALUES (@username)";
            insertCmd.Parameters.AddWithValue("@username", e.Username);

            insertCmd.Prepare();
            insertCmd.ExecuteNonQuery();

            using var insertUser = new SQLiteCommand(con);

            insertUser.CommandText = "INSERT or IGNORE INTO gb_points(username, value) VALUES (@username, @value)";
            insertUser.Parameters.AddWithValue("@username", e.Username);
            insertUser.Parameters.AddWithValue("@value", "0");

            insertUser.Prepare();
            insertUser.ExecuteNonQuery();

            con.Close();

        }

        private void Client_UserLeft(object sender, OnUserLeftArgs e)
        {
            using var con = new SQLiteConnection(cs);

            con.Open();
            using var deleteCmd = new SQLiteCommand(con);

            deleteCmd.CommandText = "DELETE FROM gb_twitch_watchlist WHERE username=@username";
            deleteCmd.Parameters.AddWithValue("@username", e.Username);
            deleteCmd.ExecuteNonQuery();

            con.Close();
        }

        private void Discord_AutoLiveMessage()
        {

            SQLite.discordSQL discordSQL = new SQLite.discordSQL();
            var active = discordSQL.getOptions("AnnounceChannel_Status");

            if (active == "on")
            {
                DiscordBot.Discord_Main discord = new DiscordBot.Discord_Main();
                var channelId = Convert.ToUInt64(discordSQL.getOptions("AnnounceChannel"));

                // Get Auto Stream Discord Message
                var discord_message = discordSQL.getOptions("AnnounceChannel_Text");

                // Convert variables if used
                if (discord_message.Contains("{game}"))
                {
                    var data = Twitch_GetData.getGame().GetAwaiter().GetResult();
                    discord_message = discord_message.Replace("{game}", data.ToString());
                }

                if (discord_message.Contains("{link}"))
                {
                    discord_message = discord_message.Replace("{link}", "https://www.twitch.tv/" + Config.TwitchClientChannel);
                }

                if (discord_message.Contains("{title}"))
                {
                    var data = Twitch_GetData.getTitle().GetAwaiter().GetResult();
                    discord_message = discord_message.Replace("{game}", data.ToString());
                }

                // Send Discord Message
                DiscordBot.Discord_Main.SendDiscordMessage(channelId, discord_message);
            }

        }

    }
}