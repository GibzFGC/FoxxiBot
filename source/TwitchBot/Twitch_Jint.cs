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

using Jint;
using Jint.Runtime.Interop;
using Newtonsoft.Json.Linq;
using System;
using System.Data.SQLite;
using System.IO;
using System.Threading;
using System.Threading.Tasks;

namespace FoxxiBot.TwitchBot
{
    public class Twitch_Jint
    {
        string cs = @"URI=file:" + AppDomain.CurrentDomain.BaseDirectory + "/Data/bot.db";
        string plugin_directory = AppDomain.CurrentDomain.BaseDirectory + "/Scripts/Twitch/";

        public void loadPlugins()
        {
            // Plugin directory
            DirectoryInfo d = new DirectoryInfo(@plugin_directory);

            // Get all JS Files
            FileInfo[] Files = d.GetFiles("*.plugin.js");

            foreach (FileInfo file in Files)
            {
                // Start the JS Engine
                var js = new Engine();

                // Newtonsoft.JSON Declarations
                js.SetValue("jsonConvert", TypeReference.CreateTypeReference(js, typeof(Newtonsoft.Json.JsonConvert)));

                // Read the File
                string script = File.ReadAllText(file.ToString());
                try
                {

                    js.Evaluate(script);
                    string output = js.Evaluate("return plugin_register;").ToString();

                    JObject o = (JObject)JToken.Parse(output);
                    // Console.WriteLine(o);

                    // Save the Plugin to the Database
                    using var con = new SQLiteConnection(cs);
                    con.Open();

                    string json_command = (string)o["command"];

                    using var cmd = new SQLiteCommand(con);

                    cmd.CommandText = "INSERT or IGNORE INTO gb_twitch_plugins (name, author, date, command, file, active)" +
                        "VALUES(@name, @author, @date, @command, @file, @active)";

                    cmd.Parameters.AddWithValue("@name", (string)o["name"]);
                    cmd.Parameters.AddWithValue("@author", (string)o["author"]);
                    cmd.Parameters.AddWithValue("@date", (string)o["date"]);
                    cmd.Parameters.AddWithValue("@command", "!" + (string)o["command"]);
                    cmd.Parameters.AddWithValue("@file", (string)o["file"]);
                    cmd.Parameters.AddWithValue("@active", 0);

                    cmd.Prepare();
                    cmd.ExecuteNonQuery();

                    con.Close();
                }
                catch (Exception Ex)
                {
                    Console.WriteLine(Ex.Message);
                }
            }

        }

        public void ExecPlugin(string channel, TwitchLib.Client.Events.OnChatCommandReceivedArgs e, TwitchLib.Client.TwitchClient client, string twitch_msg)
        {
            // Plugin Name
            string script = "";

            // Check if Plugin
            using var con = new SQLiteConnection(cs);
            con.Open();

            var command = twitch_msg.Split(" ");
            string plugin_stm = "SELECT * FROM gb_twitch_plugins WHERE command = '" + command[0] + "' AND active = 1 LIMIT 1";

            using var plugin_cmd = new SQLiteCommand(plugin_stm, con);
            using SQLiteDataReader plugin_rdr = plugin_cmd.ExecuteReader();

            if (plugin_rdr.HasRows == true)
            {

                while (plugin_rdr.Read())
                {
                    try
                    {
                        script = File.ReadAllText(plugin_directory + $"{(string)plugin_rdr["file"]}");
                    }
                    catch (Exception Ex)
                    {
                        Console.WriteLine(Ex.Message);
                    }
                }
            }

            // Close Database
            con.Close();

            try
            {
                // Start the JS Engine
                var js = new Engine(cfg => cfg.AllowClr());

                // System
                js.SetValue("Console", TypeReference.CreateTypeReference(js, typeof(System.Console)));
                js.SetValue("Convert", TypeReference.CreateTypeReference(js, typeof(System.Convert)));
                js.SetValue("DateTime", TypeReference.CreateTypeReference(js, typeof(System.DateTime)));
                js.SetValue("List", TypeReference.CreateTypeReference(js, typeof(System.Collections.Generic.List<string>)));
                js.SetValue("StreamReader", TypeReference.CreateTypeReference(js, typeof(StreamReader)));
                js.SetValue("WebRequest", TypeReference.CreateTypeReference(js, typeof(System.Net.WebRequest)));

                // Newtonsoft.JSON Declarations
                js.SetValue("jsonConvert", TypeReference.CreateTypeReference(js, typeof(Newtonsoft.Json.JsonConvert)));

                // SQLite Declarations
                js.SetValue("botSQLPath", "URI=file:" + AppDomain.CurrentDomain.BaseDirectory + "Data/bot.db");
                js.SetValue("pluginSQLPath", "URI=file:" + AppDomain.CurrentDomain.BaseDirectory + "Data/plugins.db");
                js.SetValue("SQLiteConnection", TypeReference.CreateTypeReference(js, typeof(System.Data.SQLite.SQLiteConnection)));
                js.SetValue("SQLiteCommand", TypeReference.CreateTypeReference(js, typeof(System.Data.SQLite.SQLiteCommand)));

                // Twitch Declarations
                js.SetValue("twitchAPI", TypeReference.CreateTypeReference(js, typeof(TwitchLib.Api.TwitchAPI)));
                js.SetValue("twitchClientID", Config.TwitchClientId);
                js.SetValue("twitchClientOAuth", Config.TwitchClientOAuth);

                js.SetValue("twitchClient", client);
                js.SetValue("twitchChannel", channel);
                js.SetValue("botCommand", twitch_msg);
                js.SetValue("twitch_eData", e.Command.ChatMessage);

                // Run the Plugin
                js.Execute(script);
            }
            catch (Jint.Runtime.JavaScriptException Ex)
            {
                Console.WriteLine(Ex.Message);
            }

        }

        public async Task WaitForDbToBeUnlocked(CancellationToken token)
        {
            while (SQLiteStatus())
            {
                await Task.Delay(TimeSpan.FromSeconds(1), token);
            }
        }

        public bool SQLiteStatus()
        {
            bool locked = true;
            SQLiteConnection connection = new SQLiteConnection(cs);
            connection.Open();

            try
            {
                SQLiteCommand beginCommand = connection.CreateCommand();
                beginCommand.CommandText = "BEGIN EXCLUSIVE"; // tries to acquire the lock
                                                              // CommandTimeout is set to 0 to get error immediately if DB is locked 
                                                              // otherwise it will wait for 30 sec by default
                beginCommand.CommandTimeout = 0;
                beginCommand.ExecuteNonQuery();

                SQLiteCommand commitCommand = connection.CreateCommand();
                commitCommand.CommandText = "COMMIT"; // releases the lock immediately
                commitCommand.ExecuteNonQuery();
                locked = false;
            }
            catch (SQLiteException)
            {
                // database is locked error
            }
            finally
            {
                connection.Close();
            }

            return locked;
        }

    }
}
