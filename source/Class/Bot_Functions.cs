﻿// Copyright(C) 2020 - 2022 FoxxiBot
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
using System;
using System.Data.SQLite;
using System.IO;
using System.Text.RegularExpressions;
using System.Threading.Tasks;

namespace FoxxiBot.Class
{
    public class Bot_Functions
    {

        string cs = @"URI=file:" + AppDomain.CurrentDomain.BaseDirectory + "/Data/bot.db";

        public Task CreateTables()
        {
            using var con = new SQLiteConnection(cs);
            SQLiteTransaction this_transaction;

            con.Open();

            using var cmd = new SQLiteCommand(con);

            // Start a local transaction
            this_transaction = con.BeginTransaction();

            cmd.CommandText = @"CREATE TABLE IF NOT EXISTS gb_commands (id INTEGER PRIMARY KEY, name TEXT, response TEXT, points INTEGER, permission INTEGER, active INTEGER)";
            cmd.ExecuteNonQuery();

            cmd.CommandText = @"CREATE TABLE IF NOT EXISTS gb_commands_blacklist (id INTEGER PRIMARY KEY, username TEXT)";
            cmd.ExecuteNonQuery();

            cmd.CommandText = @"CREATE TABLE IF NOT EXISTS gb_countdowns (id INTEGER PRIMARY KEY, title TEXT, datetime TEXT, timestamp TEXT)";
            cmd.ExecuteNonQuery();

            cmd.CommandText = @"CREATE TABLE IF NOT EXISTS gb_discord_channels (channel_id INTEGER PRIMARY KEY, channel_name TEXT, channel_type TEXT)";
            cmd.ExecuteNonQuery();

            cmd.CommandText = @"CREATE TABLE IF NOT EXISTS gb_discord_commands (id INTEGER PRIMARY KEY, name TEXT, response TEXT, points INTEGER, permission TEXT, active INTEGER)";
            cmd.ExecuteNonQuery();

            cmd.CommandText = @"CREATE TABLE IF NOT EXISTS gb_discord_options (parameter TEXT UNIQUE, value TEXT)";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_discord_options (parameter, value) VALUES('BotChannel_Status','off')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_discord_options (parameter, value) VALUES('GreetingChannel_Status','off')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_discord_options (parameter, value) VALUES('StreamChannel_Status','off')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_discord_options (parameter, value) VALUES('AutoRole_Status','off')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_discord_options (parameter, value) VALUES('AnnounceChannel','')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_discord_options (parameter, value) VALUES('AnnounceChannel_Status','off')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_discord_options (parameter, value) VALUES('AnnounceChannel_Text','Now live on Twitch @ {link}! Come join me~')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = @"CREATE TABLE IF NOT EXISTS gb_discord_plugins (name TEXT, author TEXT, date TEXT, command TEXT UNIQUE, file TEXT, active INTEGER)";
            cmd.ExecuteNonQuery();

            cmd.CommandText = @"CREATE TABLE IF NOT EXISTS gb_discord_roles (role_id TEXT PRIMARY KEY, role_name TEXT)";
            cmd.ExecuteNonQuery();

            cmd.CommandText = @"CREATE TABLE IF NOT EXISTS gb_discord_streamers (username TEXT UNIQUE, live TEXT DEFAULT 0)";
            cmd.ExecuteNonQuery();

            cmd.CommandText = @"CREATE TABLE IF NOT EXISTS gb_game_duel (sender TEXT UNIQUE, recipient TEXT)";
            cmd.ExecuteNonQuery();

            cmd.CommandText = @"CREATE TABLE IF NOT EXISTS gb_game_options (parameter TEXT UNIQUE, value TEXT)";
            cmd.ExecuteNonQuery();

            cmd.CommandText = @"CREATE TABLE IF NOT EXISTS gb_options (parameter TEXT UNIQUE, value TEXT)";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_options (parameter, value) VALUES('debug','off')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_options (parameter, value) VALUES('timer_mins',15)";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_options (parameter, value) VALUES('stream_status',0)";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_options (parameter, value) VALUES('game_title','')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_options (parameter, value) VALUES('discord_features','on')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_options (parameter, value) VALUES('twitch_features','on')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_options (parameter, value) VALUES('tournament_features','off')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = @"CREATE TABLE IF NOT EXISTS gb_points (username TEXT UNIQUE, value INTEGER)";
            cmd.ExecuteNonQuery();

            cmd.CommandText = @"CREATE TABLE IF NOT EXISTS gb_points_blacklist (id INTEGER PRIMARY KEY, username TEXT)";
            cmd.ExecuteNonQuery();

            cmd.CommandText = @"CREATE TABLE IF NOT EXISTS gb_points_actions (id INTEGER PRIMARY KEY AUTOINCREMENT, username TEXT, recipient TEXT, action TEXT, points INTEGER, status INTEGER)";
            cmd.ExecuteNonQuery();

            cmd.CommandText = @"CREATE TABLE IF NOT EXISTS gb_points_options (parameter TEXT UNIQUE, value TEXT)";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_points_options (parameter, value) VALUES('points_active', 'off')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_points_options (parameter, value) VALUES('points_name', 'Bot Points')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_points_options (parameter, value) VALUES('points_short', 'BP')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_points_options (parameter, value) VALUES('points_increment', '10')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = @"CREATE TABLE IF NOT EXISTS gb_polls (id INTEGER PRIMARY KEY AUTOINCREMENT, title TEXT, option1 TEXT, option2 TEXT, option3 TEXT, option4 TEXT, datetime TEXT, timestamp TEXT)";
            cmd.ExecuteNonQuery();

            cmd.CommandText = @"CREATE TABLE IF NOT EXISTS gb_polls_options (parameter TEXT UNIQUE, value TEXT)";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_polls_options (parameter, value) VALUES('active_poll','0')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_polls_options (parameter, value) VALUES('allow_voting','0')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = @"CREATE TABLE IF NOT EXISTS gb_polls_votes (poll_id INTEGER, user TEXT, value INTEGER)";
            cmd.ExecuteNonQuery();

            cmd.CommandText = @"CREATE TABLE IF NOT EXISTS gb_quotes (id INTEGER PRIMARY KEY AUTOINCREMENT, name TEXT, text TEXT, source TEXT)";
            cmd.ExecuteNonQuery();

            cmd.CommandText = @"CREATE TABLE IF NOT EXISTS gb_sounds (id INTEGER PRIMARY KEY AUTOINCREMENT, name TEXT, file TEXT, points INTEGER, active INTEGER)";
            cmd.ExecuteNonQuery();

            cmd.CommandText = @"CREATE TABLE IF NOT EXISTS gb_sounds_queue (id INTEGER PRIMARY KEY AUTOINCREMENT, file TEXT)";
            cmd.ExecuteNonQuery();

            cmd.CommandText = @"CREATE TABLE IF NOT EXISTS gb_ticker (id INTEGER PRIMARY KEY AUTOINCREMENT, name TEXT, response TEXT, active INTEGER)";
            cmd.ExecuteNonQuery();

            cmd.CommandText = @"CREATE TABLE IF NOT EXISTS gb_tournament_players (id INTEGER PRIMARY KEY AUTOINCREMENT, tag TEXT, name TEXT UNIQUE, country TEXT, country_code TEXT)";
            cmd.ExecuteNonQuery();

            cmd.CommandText = @"CREATE TABLE IF NOT EXISTS gb_tournament_scoreboard (parameter TEXT UNIQUE, value TEXT)";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_tournament_scoreboard (parameter, value) VALUES('p1Tag', '')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_tournament_scoreboard (parameter, value) VALUES('p1Name', '')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_tournament_scoreboard (parameter, value) VALUES('p1Country', '')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_tournament_scoreboard (parameter, value) VALUES('p1CountryCode', '')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_tournament_scoreboard (parameter, value) VALUES('p1Status', '')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_tournament_scoreboard (parameter, value) VALUES('p1Score', '')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_tournament_scoreboard (parameter, value) VALUES('p1TeamPosition', '0')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_tournament_scoreboard (parameter, value) VALUES('p2Tag', '')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_tournament_scoreboard (parameter, value) VALUES('p2Name', '')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_tournament_scoreboard (parameter, value) VALUES('p2Country', '')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_tournament_scoreboard (parameter, value) VALUES('p2CountryCode', '')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_tournament_scoreboard (parameter, value) VALUES('p2Status', '')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_tournament_scoreboard (parameter, value) VALUES('p2Score', '')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_tournament_scoreboard (parameter, value) VALUES('p2TeamPosition', '0')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_tournament_scoreboard (parameter, value) VALUES('tournamentRound', 'Pools')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_tournament_scoreboard (parameter, value) VALUES('tournamentRound', 'Round 1 - Best of 3')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = @"CREATE TABLE IF NOT EXISTS gb_tournament_top8 (parameter TEXT UNIQUE, value TEXT)";
            cmd.ExecuteNonQuery();

            cmd.CommandText = @"CREATE TABLE IF NOT EXISTS gb_twitch_botlist (id INTEGER PRIMARY KEY AUTOINCREMENT, username TEXT UNIQUE)";
            cmd.ExecuteNonQuery();

            cmd.CommandText = @"CREATE TABLE IF NOT EXISTS gb_twitch_events (id INTEGER PRIMARY KEY AUTOINCREMENT, type TEXT, user TEXT, viewers TEXT)";
            cmd.ExecuteNonQuery();

            cmd.CommandText = @"CREATE TABLE IF NOT EXISTS gb_twitch_giveaway (uid TEXT UNIQUE, username TEXT, display_name TEXT)";
            cmd.ExecuteNonQuery();

            cmd.CommandText = @"CREATE TABLE IF NOT EXISTS gb_twitch_notifications (id INTEGER PRIMARY KEY AUTOINCREMENT, type TEXT, user TEXT, viewers TEXT, date TEXT)";
            cmd.ExecuteNonQuery();

            cmd.CommandText = @"CREATE TABLE IF NOT EXISTS gb_twitch_modlist (id INTEGER PRIMARY KEY AUTOINCREMENT, item TEXT UNIQUE, allowed TEXT)";
            cmd.ExecuteNonQuery();

            cmd.CommandText = @"CREATE TABLE IF NOT EXISTS gb_twitch_options (parameter TEXT UNIQUE, value TEXT)";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_twitch_options (parameter, value) VALUES('Joined_Channel','{bot} has arrived, time for an awesome stream!!')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_twitch_options (parameter, value) VALUES('On_Raid_Message','We are raiding {user}, make sure to say hello!')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_twitch_options (parameter, value) VALUES('Partner_Status','off')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_twitch_options (parameter, value) VALUES('Bits_Message','Thank you for the {count} bits, {user}!')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_twitch_options (parameter, value) VALUES('Follow_Message','Thank you for the follow, {user}!')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_twitch_options (parameter, value) VALUES('Prime_Message','Thank you for the Prime Subscription, {user}!')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_twitch_options (parameter, value) VALUES('Raid_Message','Thank you for the raid of {count}, {user}!')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_twitch_options (parameter, value) VALUES('Subscriber_Message','Thank you for the Subscription, {user}!')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_twitch_options (parameter, value) VALUES('Partner_Status','off')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_twitch_options (parameter, value) VALUES('Blacklist_Status','off')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_twitch_options (parameter, value) VALUES('Whitelist_Status','off')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_twitch_options (parameter, value) VALUES('LinkFilter_Status','off')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_twitch_options (parameter, value) VALUES('CapsFilter_Status','off')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_twitch_options (parameter, value) VALUES('SymbolsFilter_Status','off')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_twitch_options (parameter, value) VALUES('SpamFilter_Status','off')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_twitch_options (parameter, value) VALUES('MeFilter_Status','off')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_twitch_options (parameter, value) VALUES('SystemFilter_Status','off')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_twitch_options (parameter, value) VALUES('deathCounter','0')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_twitch_options (parameter, value) VALUES('Giveaway_Name','')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_twitch_options (parameter, value) VALUES('Giveaway_Details','')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_twitch_options (parameter, value) VALUES('Giveaway_Status','off')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_twitch_options (parameter, value) VALUES('Giveaway_AllowTwitchStaff','off')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_twitch_options (parameter, value) VALUES('Giveaway_AllowMods','off')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_twitch_options (parameter, value) VALUES('Giveaway_Winner','')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_twitch_options (parameter, value) VALUES('Permitted_User','')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = @"CREATE TABLE IF NOT EXISTS gb_twitch_perms (name TEXT UNIQUE, value TEXT)";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_twitch_perms (name, value) VALUES('Viewer','0')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_twitch_perms (name, value) VALUES('Moderator','1')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_twitch_perms (name, value) VALUES('Global Moderator','2')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_twitch_perms (name, value) VALUES('Broadcaster','3')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_twitch_perms (name, value) VALUES('Twitch Admin','4')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = "INSERT OR IGNORE INTO gb_twitch_perms (name, value) VALUES('Twitch Staff','5')";
            cmd.ExecuteNonQuery();

            cmd.CommandText = @"CREATE TABLE IF NOT EXISTS gb_twitch_plugins (name TEXT, author TEXT, date TEXT, command TEXT UNIQUE, file TEXT, active INTEGER)";
            cmd.ExecuteNonQuery();

            cmd.CommandText = @"CREATE TABLE IF NOT EXISTS gb_twitch_timers (id INTEGER PRIMARY KEY, name TEXT, response TEXT, active INTEGER)";
            cmd.ExecuteNonQuery();

            cmd.CommandText = @"CREATE TABLE IF NOT EXISTS gb_twitch_watchlist (username TEXT UNIQUE)";
            cmd.ExecuteNonQuery();

            // Commit all Data to SQL
            this_transaction.Commit();

            con.Close();
            return Task.CompletedTask;
        }

        public Task SaveConfig()
        {
            Settings.Settings objSettings = new Settings.Settings();
            objSettings.Debug = Config.Debug;
            objSettings.WebserverIP = Config.WebserverIP;
            objSettings.WebserverPort = Config.WebserverPort;
            objSettings.BotName = Config.TwitchBotName;
            objSettings.TwitchClientID = Config.TwitchClientId;
            objSettings.TwitchClientSecret = Config.TwitchClientSecret;
            objSettings.TwitchClientRedirect = Config.TwitchRedirectUri;
            objSettings.TwitchClientChannel = Config.TwitchClientChannel;
            objSettings.TwitchClientUser = Config.TwitchClientUser;
            objSettings.TwitchClientOAuth = Config.TwitchClientOAuth;
            objSettings.TwitchClientRefresh = Config.TwitchClientRefresh;

            objSettings.TwitchBroadcasterId = Config.TwitchMC_Id;
            objSettings.TwitchBroadcasterOAuth = Config.TwitchMC_ClientOAuth;
            objSettings.TwitchBroadcasterRefresh = Config.TwitchMC_ClientRefresh;

            objSettings.DiscordServerId = Config.DiscordServerId;
            objSettings.DiscordToken = Config.DiscordToken;
            objSettings.DiscordPrefix = Config.DiscordPrefix;

            objSettings.BotLang = Config.BotLang;

            string objjsonData = JsonConvert.SerializeObject(objSettings);
            File.WriteAllText(@AppDomain.CurrentDomain.BaseDirectory + "Data/config.json", objjsonData);

            return Task.CompletedTask;
        }

        // Change the Colour of ConsoleText
        public static void WriteColour(string message, ConsoleColor color)
        {
            var pieces = Regex.Split(message, @"(\[[^\]]*\])");

            for (int i = 0; i < pieces.Length; i++)
            {
                string piece = pieces[i];

                if (piece.StartsWith("[") && piece.EndsWith("]"))
                {
                    Console.ForegroundColor = color;
                    piece = piece.Substring(1, piece.Length - 2);
                }

                Console.Write(piece);
                Console.ResetColor();
            }

            Console.WriteLine();
        }

    }
}
