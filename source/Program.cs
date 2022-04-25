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
using System.Collections.Generic;
using System.Threading;
using System.Threading.Tasks;
using System.IO;
using FoxxiBot.Settings;
using Newtonsoft.Json;
using Newtonsoft.Json.Linq;
using System.Data.SQLite;
using TwitchLib.Api.Auth;
using TwitchLib.Api.Core.Exceptions;
using TwitchLib.Api.Core.Enums;
using TwitchLib.Api.Core.Interfaces;
using System.Data.SqlClient;
using FoxxiBot.SQLite;
using FoxxiBot.TwitchBot;

namespace FoxxiBot
{
    class Program
    {

        // Set the Scopes for Twitch
        private static List<string> botScopes = new List<string> { "chat:read", "whispers:read", "whispers:edit", "chat:edit", "channel:moderate", "channel:manage:broadcast", "channel:read:redemptions", "channel:read:subscriptions" };
        private static List<string>broadcastScopes = new List<string> { "channel:manage:broadcast", "channel:edit:commercial", "channel:moderate", "channel:read:redemptions", "channel:read:subscriptions", "chat:read", "whispers:read" };

        static void Server()
        {
            string myFolder = @AppDomain.CurrentDomain.BaseDirectory + "Web";
            WebServer.WebServer myServer;

            //Creating server with specified port
            if (Config.WebserverPort.Length > 0 || Config.WebserverPort != null)
            {
                myServer = new WebServer.WebServer(myFolder, Int32.Parse(Config.WebserverPort));
            }
            else
            {
                myServer = new WebServer.WebServer(myFolder, 25000);
            }
        }

        static void Main(string[] args)
        {
            // Set Application Encoding
            Console.OutputEncoding = System.Text.Encoding.UTF8;

            // Check Folder / File integrity
            Class.Bot_Integrity Bot_Intrgrity = new Class.Bot_Integrity();

            // If Plugins SQLite doesn't exist
            if (!File.Exists(AppDomain.CurrentDomain.BaseDirectory + "Data/plugins.db"))
            {
                // Create the Database File
                var pnFile = File.Create(AppDomain.CurrentDomain.BaseDirectory + "Data/plugins.db");
                pnFile.Close();
            }

            // If Bot SQLite doesn't exist
            if (File.Exists(AppDomain.CurrentDomain.BaseDirectory + "Data/bot.db"))
            {
                Console.WriteLine(DateTime.Now + ": " + Config.TwitchBotName + " - Database file found. Checking for Updates...");
                
                // Update the Tables & Default Data
                Class.Bot_Functions functions = new Class.Bot_Functions();
                functions.CreateTables().GetAwaiter().GetResult();

                Console.WriteLine(DateTime.Now + ": " + Config.TwitchBotName + " - Bot Starting...");
                Console.WriteLine("");
            } else
            {
                Console.WriteLine(DateTime.Now + ": " + Config.TwitchBotName + " - No Database file found. Creating now~");

                // Create the Database File
                var dbFile = File.Create(AppDomain.CurrentDomain.BaseDirectory + "Data/bot.db");
                dbFile.Close();

                // Create the Tables & Default Data
                Class.Bot_Functions functions = new Class.Bot_Functions();
                functions.CreateTables().GetAwaiter().GetResult();

                Console.WriteLine("Database file created. Continuing Launch...");
                Console.WriteLine("");
            }

            // If config JSON exists
            if (File.Exists(AppDomain.CurrentDomain.BaseDirectory + "Data/config.json"))
            {
                // SQLite Backup
                DateTime localDate = DateTime.Now;
                File.Copy(@AppDomain.CurrentDomain.BaseDirectory + "Data/bot.db", @AppDomain.CurrentDomain.BaseDirectory + "Data/Backups/bot.backup." + localDate.ToString("ddMMyyyy.HHmmss") + ".db", true);

                // Initialize Twitch
                Console.WriteLine("Welcome to FoxxiBot. Loading your Settings...");
                Console.WriteLine("");

                // Load from JSON
                using (StreamReader reader = File.OpenText(@AppDomain.CurrentDomain.BaseDirectory + "Data/config.json"))
                {
                    JObject o = (JObject)JToken.ReadFrom(new JsonTextReader(reader));

                    // Set needed Values Internally
                    Config.Debug = (string)o["Debug"];
                    Config.WebserverIP = (string)o["WebserverIP"];
                    Config.WebserverPort = (string)o["WebserverPort"];
                    Config.TwitchBotName = (string)o["BotName"];
                    Config.TwitchClientId = (string)o["TwitchClientID"];
                    Config.TwitchClientSecret = (string)o["TwitchClientSecret"];
                    Config.TwitchRedirectUri = (string)o["TwitchClientRedirect"];
                    Config.TwitchClientChannel = (string)o["TwitchClientChannel"];
                    Config.TwitchClientUser = (string)o["TwitchClientUser"];
                    Config.TwitchClientOAuth = (string)o["TwitchClientOAuth"];
                    Config.TwitchClientRefresh = (string)o["TwitchClientRefresh"];

                    Config.TwitchMC_ClientOAuth = (string)o["TwitchBroadcasterOAuth"];
                    Config.TwitchMC_ClientRefresh = (string)o["TwitchBroadcasterRefresh"];
                    Config.TwitchMC_Id = (string)o["TwitchBroadcasterId"];

                    Config.DiscordServerId = (string)o["DiscordServerId"];
                    Config.DiscordToken = (string)o["DiscordToken"];
                    Config.DiscordPrefix = (string)o["DiscordPrefix"];

                    Config.BotLang = (string)o["BotLang"];

                    // Close the File
                    reader.Close();
                }

                // Start Web Server
                Server();
                Console.WriteLine("Server Layer: Server Started!");
                Console.WriteLine("");

                // Start Twitch Bot
                if (Config.TwitchClientId != null && Config.TwitchClientOAuth != null)
                {
                    // Check Twitch Tokens
                    refreshBotOauth();

                    // Start the Twitch Bot
                    Twitch_Main bot = new Twitch_Main();
                }
                else
                {
                    Console.Write(DateTime.Now + ": " + Config.TwitchBotName + " - Twitch Layer De-Activated");
                }

                // Create Discord Bot
                if (Config.DiscordToken != null)
                {
                    DiscordBot.Discord_Main Discord = new DiscordBot.Discord_Main();
                    Discord.MainAsync().GetAwaiter().GetResult();
                }
                else
                {
                    Console.Write(DateTime.Now + ": " + Config.TwitchBotName + " - Discord Layer De-Activated");
                }

                // Check & Set Debug Mode
                SQLite.botSQL botSQL = new SQLite.botSQL();
                botSQL.debugMode();

                // prevent console from closing
                Console.ReadLine();
            }
            else
            {
                Console.WriteLine("Welcome to FoxxiBot. Let's Get Started");
                Console.WriteLine("");
                Console.WriteLine("Let's set up the Bot's permissions to the Bot's Account on Twitch");
                Console.WriteLine("");

                Console.WriteLine("Please enter your Bot's Name");
                string BotName = Console.ReadLine();

                Console.WriteLine("");

                Console.WriteLine("Please enter your Twitch Client ID");
                string TwitchClientID = Console.ReadLine();

                Console.WriteLine("");

                Console.WriteLine("Please enter your Twitch Client Secret");
                string TwitchClientSecret = Console.ReadLine();

                Console.WriteLine("");

                Console.WriteLine("Please enter your Redirect URL");
                string TwitchClientRedirect = Console.ReadLine();

                Console.WriteLine("");

                Console.WriteLine("Which Twitch Channel would you like to auto join?");
                string TwitchClientChannel = Console.ReadLine();

                Console.WriteLine("");

                Console.WriteLine("Enter Your Discord Token for Discord");
                string DiscordToken = Console.ReadLine();

                Console.WriteLine("");

                Console.WriteLine("Enter Your Preferred Discord Command Prefix");
                string DiscordPrefix = Console.ReadLine();

                Console.WriteLine("");

                // Set needed Values Internally
                Config.TwitchBotName = BotName;
                Config.TwitchClientId = TwitchClientID;
                Config.TwitchClientSecret = TwitchClientSecret;
                Config.TwitchRedirectUri = TwitchClientRedirect;
                Config.TwitchClientChannel = TwitchClientChannel;
                Config.DiscordToken = DiscordToken;
                Config.DiscordPrefix = DiscordPrefix;
                Config.BotLang = "English";

                // Begin the Verification / OAuth Phase
                MainAsync().GetAwaiter().GetResult();
            }
        }

        static async Task MainAsync()
        {
            Console.WriteLine("FoxxiBot Loading...");
            Console.WriteLine("");

            // ensure client id, secret, and redrect url are set
            validateCreds();

            // create twitch api instance
            var bot_api = new TwitchLib.Api.TwitchAPI();
            bot_api.Settings.ClientId = Config.TwitchClientId;

            // start local web server
            var server = new OAuth(Config.TwitchRedirectUri);

            // print out auth url
            Console.WriteLine("The following URL is for your Bot account so please make sure you're logged in on that!");
            Console.WriteLine("");
            Console.WriteLine($"{getAuthorizationCodeUrl(Config.TwitchClientId, Config.TwitchRedirectUri, botScopes)}");

            // listen for incoming requests
            var bot_auth = await server.Listen();

            // exchange auth code for oauth access/refresh
            var bot_resp = await bot_api.Auth.GetAccessTokenFromCodeAsync(bot_auth.Code, Config.TwitchClientSecret, Config.TwitchRedirectUri);

            // update TwitchLib's api with the recently acquired access token
            bot_api.Settings.AccessToken = bot_resp.AccessToken;

            // get the auth'd user
            var bot_user = (await bot_api.Helix.Users.GetUsersAsync()).Users[0];

            // refresh token
            var bot_refresh = await bot_api.Auth.RefreshAuthTokenAsync(bot_resp.RefreshToken, Config.TwitchClientSecret);
            bot_api.Settings.AccessToken = bot_refresh.AccessToken;

            // confirm new token works
            bot_user = (await bot_api.Helix.Users.GetUsersAsync()).Users[0];

            // Set Internal Values
            Config.TwitchClientUser = bot_user.Login;
            Config.TwitchClientOAuth = bot_refresh.AccessToken;

            Console.WriteLine("");
            //

            // create twitch api instance
            var broadcast_api = new TwitchLib.Api.TwitchAPI();
            broadcast_api.Settings.ClientId = Config.TwitchClientId;

            // print out auth url
            Console.WriteLine("The following URL is for your broadcast account so please make sure you're logged in on that!");
            Console.WriteLine("");
            Console.WriteLine($"{getAuthorizationCodeUrl(Config.TwitchClientId, Config.TwitchRedirectUri, broadcastScopes)}");

            // listen for incoming requests
            var broadcast_auth = await server.Listen();

            // exchange auth code for oauth access/refresh
            var broadcast_resp = await broadcast_api.Auth.GetAccessTokenFromCodeAsync(broadcast_auth.Code, Config.TwitchClientSecret, Config.TwitchRedirectUri);

            // update TwitchLib's api with the recently acquired access token
            broadcast_api.Settings.AccessToken = broadcast_resp.AccessToken;

            // get the auth'd user
            var broadcast_user = (await broadcast_api.Helix.Users.GetUsersAsync()).Users[0];

            // refresh token
            var broadcast_refresh = await broadcast_api.Auth.RefreshAuthTokenAsync(broadcast_resp.RefreshToken, Config.TwitchClientSecret);
            broadcast_api.Settings.AccessToken = broadcast_refresh.AccessToken;

            // confirm new token works
            broadcast_user = (await broadcast_api.Helix.Users.GetUsersAsync()).Users[0];

            // Set Internal Values
            Config.TwitchClientUser = bot_user.Login;
            Config.TwitchClientOAuth = bot_refresh.AccessToken;
            Config.TwitchClientRefresh = bot_refresh.RefreshToken;
            
            Config.TwitchMC_Id = broadcast_user.Id;
            Config.TwitchMC_ClientOAuth = broadcast_refresh.AccessToken;
            Config.TwitchMC_ClientRefresh = broadcast_refresh.RefreshToken;

            // Save the Settings
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

            // Start Web Server
            Server();
            Console.WriteLine("");
            Console.WriteLine("Server Layer: Server Started!");
            Console.WriteLine("");

            // Start Twitch Bot
            if (Config.TwitchClientId != null && Config.TwitchClientOAuth != null) {
                Twitch_Main bot = new Twitch_Main();
            }
            else
            {
                Console.Write(DateTime.Now + ": " + Config.TwitchBotName + " - Twitch Layer De-Activated");
            }

            // Create Discord Bot
            if (Config.DiscordToken != null)
            {
                DiscordBot.Discord_Main Discord = new DiscordBot.Discord_Main();
                Discord.MainAsync().GetAwaiter().GetResult();
            } else
            {
                Console.Write(DateTime.Now + ": " + Config.TwitchBotName + " - Discord Layer De-Activated");
            }

            // prevent console from closing
            Console.ReadLine();
        }

        private static string getAuthorizationCodeUrl(string clientId, string redirectUri, List<string> scopes)
        {
            var scopesStr = String.Join('+', scopes);

            return "https://id.twitch.tv/oauth2/authorize?" +
                   $"client_id={clientId}&" +
                   $"redirect_uri={System.Web.HttpUtility.UrlEncode(redirectUri)}&" +
                   "response_type=code&" +
                   $"scope={scopesStr}";
        }

        private static void validateCreds()
        {
            if (String.IsNullOrEmpty(Config.TwitchClientId))
                throw new Exception("client id cannot be null or empty");
            if (String.IsNullOrEmpty(Config.TwitchClientSecret))
                throw new Exception("client secret cannot be null or empty");
            if (String.IsNullOrEmpty(Config.TwitchRedirectUri))
                throw new Exception("redirect uri cannot be null or empty");
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
        }

    }
}