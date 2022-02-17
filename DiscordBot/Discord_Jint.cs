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
using System.IO;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using Newtonsoft.Json;
using Jint;
using Jint.Runtime.Interop;
using Jint.Native.Json;
using Newtonsoft.Json.Linq;
using System.Data.SQLite;
using System.Threading;
using Discord;
using Discord.Commands;
using Discord.WebSocket;

namespace FoxxiBot.DiscordBot
{
    public class Discord_Jint
    {
        string cs = @"URI=file:" + AppDomain.CurrentDomain.BaseDirectory + "\\Data\\bot.db";
        string plugin_directory = AppDomain.CurrentDomain.BaseDirectory + "\\Scripts\\Discord\\";

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

                    cmd.CommandText = "INSERT or IGNORE INTO gb_discord_plugins (name, author, date, command, file, active)" +
                        "VALUES(@name, @author, @date, @command, @file, @active)";

                    cmd.Parameters.AddWithValue("@name", (string)o["name"]);
                    cmd.Parameters.AddWithValue("@author", (string)o["author"]);
                    cmd.Parameters.AddWithValue("@date", (string)o["date"]);
                    cmd.Parameters.AddWithValue("@command", (string)o["command"]);
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

        public void ExecPlugin(DiscordSocketClient client, SocketCommandContext context, SocketMessage args, SocketUserMessage msg)
        {
            // Plugin Name
            string script = "";

            // Check if Plugin
            using var con = new SQLiteConnection(cs);
            con.Open();
            
            // Get the Command
            var command = msg.Content.Split(" ");            
            string plugin_stm = "SELECT * FROM gb_discord_plugins WHERE command = '" + command[0].Substring(1) + "' AND active = 1 LIMIT 1";

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
                js.SetValue("botSQLPath", "URI=file:" + AppDomain.CurrentDomain.BaseDirectory + "\\Data\\bot.db");
                js.SetValue("pluginSQLPath", "URI=file:" + AppDomain.CurrentDomain.BaseDirectory + "\\Data\\plugins.db");
                js.SetValue("SQLiteConnection", TypeReference.CreateTypeReference(js, typeof(System.Data.SQLite.SQLiteConnection)));
                js.SetValue("SQLiteCommand", TypeReference.CreateTypeReference(js, typeof(System.Data.SQLite.SQLiteCommand)));

                // Discord Declarations
                js.SetValue("ModuleBase", TypeReference.CreateTypeReference(js, typeof(Discord.Commands.ModuleBase)));
                js.SetValue("SocketCommandContext", TypeReference.CreateTypeReference(js, typeof(Discord.Commands.SocketCommandContext)));
                js.SetValue("IUserMessage", TypeReference.CreateTypeReference(js, typeof(Discord.IUserMessage)));

                js.SetValue("discordClient", client);
                js.SetValue("discordContext", context);
                js.SetValue("botCommand", msg);
                js.SetValue("discord_eData", args);

                // Run the Plugin
                js.Execute(script);
            }
            catch (Jint.Runtime.JavaScriptException Ex)
            {
                Console.WriteLine(Ex.Message);
            }

        }

    }
}
