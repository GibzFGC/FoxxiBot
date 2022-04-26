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
using Discord.Commands;
using Discord.WebSocket;
using Microsoft.Extensions.DependencyInjection;
using Newtonsoft.Json;
using Newtonsoft.Json.Linq;
using System;
using System.Collections.Generic;
using System.Data.SQLite;
using System.IO;
using System.Linq;
using System.Reflection;
using System.Text;
using System.Threading;
using System.Threading.Tasks;
using TwitchLib.Api;

namespace FoxxiBot.DiscordBot
{
    public class Discord_Main
    {
        private DiscordSocketClient client;
        private CommandService commands;

        string cs = @"URI=file:" + AppDomain.CurrentDomain.BaseDirectory + "/Data/bot.db";
        private Timer promoTimer = null;
        public async Task MainAsync()
        {

            using var services = ConfigureServices();
            client = services.GetRequiredService<DiscordSocketClient>();
            commands = services.GetRequiredService<CommandService>();

            // Subscribe the logging handler to both the client and the CommandService.
            client.Log += Log;
            commands.Log += Log;
            client.SlashCommandExecuted += SlashCommandHandler;

            // Channel check pointers
            client.ChannelCreated += Channel_Created;
            client.ChannelUpdated += Channel_Updated;
            client.ChannelDestroyed += Channel_Destroyed;

            // When the Bot Joins the Server
            client.Ready += Client_Ready;
            client.JoinedGuild += Client_JoinedGuild;

            // New / Leaving Discord Member
            client.UserJoined += Server_UserJoined;
            client.UserLeft += Server_UserLeft;

            // Role check pointers
            client.RoleCreated += Role_Created;
            client.RoleUpdated += Role_Updated;
            client.RoleDeleted += Role_Deleted;

            // Centralize the logic for commands into a separate method.
            await InitCommands();

            // Login and connect.
            await client.LoginAsync(TokenType.Bot, Config.DiscordToken);
            await client.StartAsync();

            // Check Discord Plugins
            Discord_Jint plugins = new Discord_Jint();
            plugins.loadPlugins();

            // Start the Promo Live Timer
            promoTimer = new Timer(promoLiveCallbackAsync, null, 0, 60000);

            // Wait infinitely so your bot actually stays connected.
            await Task.Delay(Timeout.Infinite);
        }

        // Service Handling (Singletons because only one server usage)
        public ServiceProvider ConfigureServices()
        {
            return new ServiceCollection()
                .AddSingleton(new DiscordSocketClient(new DiscordSocketConfig
                {
                    MessageCacheSize = 500,
                    LogLevel = LogSeverity.Info,
                    GatewayIntents = GatewayIntents.All
                }))

                .AddSingleton(new CommandService(new CommandServiceConfig
                {
                    LogLevel = LogSeverity.Info,
                    DefaultRunMode = RunMode.Async,
                    CaseSensitiveCommands = false,
                }))

                .BuildServiceProvider();
        }

        // Log Handling
        private static Task Log(LogMessage message)
        {
            switch (message.Severity)
            {
                case LogSeverity.Critical:
                case LogSeverity.Error:
                    Console.ForegroundColor = ConsoleColor.Red;
                    break;
                case LogSeverity.Warning:
                    Console.ForegroundColor = ConsoleColor.Yellow;
                    break;
                case LogSeverity.Info:
                    Console.ForegroundColor = ConsoleColor.White;
                    break;
                case LogSeverity.Verbose:
                case LogSeverity.Debug:
                    Console.ForegroundColor = ConsoleColor.DarkGray;
                    break;
            }
            Console.WriteLine($"{DateTime.Now,-19} [{message.Severity,8}] {message.Source}: {message.Message} {message.Exception}");
            Console.ResetColor();

            return Task.CompletedTask;
        }

        private async Task InitCommands()
        {
            // Subscribe a handler to see if a message invokes a command.
            client.MessageReceived += HandleCommandAsync;
            await commands.AddModulesAsync(assembly: Assembly.GetEntryAssembly(), services: null);
        }

        private Task CreateSlashCommands()
        {

            return Task.CompletedTask;
        }

        private async Task HandleCommandAsync(SocketMessage arg)
        {
            // Bail out if it's a System Message.
            var msg = arg as SocketUserMessage;
            if (msg == null) return;

            // We don't want the bot to respond to itself or other bots.
            if (msg.Author.Id == client.CurrentUser.Id || msg.Author.IsBot) return;

            // Create a number to track where the prefix ends and the command begins
            int pos = 0;

            // User Perms BOOL (initial state is false)
            bool perms_validated = false;

            // Get Bot Channel Status
            SQLite.discordSQL discordSQL = new SQLite.discordSQL();
            var bot_channel = discordSQL.getOptions("BotChannel_Status");

            // Gets the bots current prefix and uses it
            // Can be changed with the "prefix set" command
            if (msg.HasCharPrefix(char.Parse(Config.DiscordPrefix), ref pos) || msg.HasMentionPrefix(client.CurrentUser, ref pos))
            {

                // Create a Command Context.
                var context = new SocketCommandContext(client, msg);

                // Execute the command with the command context we just
                // created, along with the service provider for precondition checks.
                await commands.ExecuteAsync(context: context, argPos: pos, services: null);

                // If it's a SQLite / Created Command or a Plugin, the following kicks in
                // split into args
                var discordMsg = msg.Content.Split(" ");
                
                using var con = new SQLiteConnection(cs);
                con.Open();
                
                string stm = "SELECT * FROM gb_discord_commands WHERE name = '" + discordMsg[0].Substring(1) + "' AND active = 1";
                
                using var cmd = new SQLiteCommand(stm, con);
                using SQLiteDataReader rdr = cmd.ExecuteReader();
                
                if (rdr.HasRows == true)
                {

                    while (rdr.Read())
                    {
                        Discord_Variables variables = new Discord_Variables();

                        // Get User Roles
                        var user = (msg.Author as SocketGuildUser);

                        // Get users nickname
                        var nickname = (msg.Author as SocketGuildUser).Nickname;

                        // Check if Nickname is Null
                        if (nickname == null)
                        {
                            nickname = msg.Author.Username;
                        }

                        // Get the Users Roles (JSON)
                        string perm_json = rdr["permission"].ToString();
                        dynamic perm_roles = JsonConvert.DeserializeObject(perm_json);

                        // Check if the user has the requried role
                        foreach (var item in perm_roles)
                        {
                            if (user.Roles.Any(r => r.Id == Convert.ToUInt64(item)))
                            {
                                perms_validated = true;
                            }
                        }

                        // If Perms valid, fire command
                        if (perms_validated == true)
                        {
                            // Parse the variables
                            var var_string = variables.convertVariables(msg.Content.ToString(), (string)rdr["response"], nickname.ToString());

                            // Reply on Discord
                            if (bot_channel == "off")
                            {
                                await context.Message.ReplyAsync(var_string);
                            }
                            else
                            {
                                var channel = discordSQL.getOptions("BotChannel");
                                await client.GetGuild(Convert.ToUInt64(Config.DiscordServerId))
                                .GetTextChannel(Convert.ToUInt64(channel)).SendMessageAsync(var_string);
                            }
                        }
                        else
                        {
                            // Reply on Discord
                            if (bot_channel == "off")
                            {
                                await context.Message.ReplyAsync("Sorry, you do not have permission to use that command");
                            }
                            else
                            {
                                var channel = discordSQL.getOptions("BotChannel");
                                await client.GetGuild(Convert.ToUInt64(Config.DiscordServerId))
                                .GetTextChannel(Convert.ToUInt64(channel)).SendMessageAsync("Sorry, you do not have permission to use that command");
                            }
                        }

                    }
                }
                else
                {
                    // Check if Plugin
                    Discord_Jint plugin = new Discord_Jint();
                    plugin.ExecPlugin(client, context, arg, msg);
                }
                
                con.Close();

            }
        }

        private async Task SlashCommandHandler(SocketSlashCommand command)
        {
            await command.RespondAsync($"You executed {command.Data.Name}");
        }

        private async Task Client_Ready()
        {
            if (Config.DiscordServerId.Length > 0)
            {
                // Init Channel & Roles Data
                await ChannelListSQL();
                await RolesListtSQL();
            }

            // Create Slash Commands
            // await CreateSlashCommands();

            // Delete Slash Commands
            //var remove_slash = client.Rest.DeleteAllGlobalCommandsAsync(null);
            // await remove_slash;
        }

        private async Task Channel_Created(SocketChannel channel)
        {
            var name = (channel as SocketGuildChannel).Name;
            var channel_type = channel.GetChannelType();

            SQLite.discordSQL discordSQL = new SQLite.discordSQL();

            await discordSQL.syncChannels(channel.Id.ToString(), name, channel_type.Value.ToString());
        }

        private async Task Channel_Updated(SocketChannel old_channel, SocketChannel new_channel)
        {
            var name = (new_channel as SocketGuildChannel).Name;

            SQLite.discordSQL discordSQL = new SQLite.discordSQL();
            await discordSQL.updateChannels(old_channel.Id.ToString(), new_channel.Id.ToString(), name);
        }

        private async Task Channel_Destroyed(SocketChannel channel)
        {
            SQLite.discordSQL discordSQL = new SQLite.discordSQL();
            await discordSQL.deleteChannels(channel.Id.ToString());
        }

        private async Task Role_Created(SocketRole role)
        {
            SQLite.discordSQL discordSQL = new SQLite.discordSQL();
            await discordSQL.syncRoles(role.Id.ToString(), role.Name);
        }

        private async Task Role_Updated(SocketRole old_role, SocketRole new_role)
        {
            SQLite.discordSQL discordSQL = new SQLite.discordSQL();
            await discordSQL.updateRoles(old_role.Id.ToString(), new_role.Id.ToString(), new_role.Name);
        }

        private async Task Role_Deleted(SocketRole role)
        {
            SQLite.discordSQL discordSQL = new SQLite.discordSQL();
            await discordSQL.deleteRoles(role.Id.ToString());
        }

        private async Task Server_UserJoined(SocketGuildUser user)
        {
            SQLite.discordSQL discordSQL = new SQLite.discordSQL();
            var getting_channel = discordSQL.getOptions("GreetingChannel_Status");
            var auto_role = discordSQL.getOptions("AutoRole_Status");

            if (getting_channel == "on")
            {
                var value = Convert.ToUInt64(discordSQL.getOptions("GreetingChannel"));

                var channel = client.GetChannel(value) as SocketTextChannel;
                await channel.SendMessageAsync($"Welcome {user.Mention} to {channel.Guild.Name}. We hope you enjoy your stay!");
            }

            if (auto_role == "on")
            {
                var role_id = Convert.ToUInt64(discordSQL.getOptions("AutoRole"));
                await user.AddRoleAsync(role_id);
            }
            
        }

        private async Task Server_UserLeft(SocketGuild guild, SocketUser user)
        {
            SQLite.discordSQL discordSQL = new SQLite.discordSQL();
            var active = discordSQL.getOptions("GreetingChannel_Status");

            if (active == "on")
            {
                var value = Convert.ToUInt64(discordSQL.getOptions("GreetingChannel"));

                var channel = client.GetChannel(value) as SocketTextChannel;
                await channel.SendMessageAsync($"{user.Mention} has left the server, we're sorry to see them go...");
            }
        }

        private Task Client_JoinedGuild(SocketGuild guild)
        {
            Config.DiscordServerId = guild.Id.ToString();

            // Save the new JSON Data
            Class.Bot_Functions functions = new Class.Bot_Functions();
            functions.SaveConfig().GetAwaiter().GetResult();

            return Task.CompletedTask;
        }

        private async Task ChannelListSQL()
        {
            var Context = client.GetGuild(Convert.ToUInt64(Config.DiscordServerId));
            if (Context == null) { return; }

            SQLite.discordSQL discordSQL = new SQLite.discordSQL();
            foreach (var channel in Context.Channels)
            {
                var channel_type = channel.GetChannelType();
                await discordSQL.syncChannels(channel.Id.ToString(), channel.Name, channel_type.Value.ToString());
            }
        }

        private async Task RolesListtSQL()
        {
            var Context = client.GetGuild(Convert.ToUInt64(Config.DiscordServerId));
            if (Context == null) { return; }

            SQLite.discordSQL discordSQL = new SQLite.discordSQL();
            foreach (var role in Context.Roles)
            {
                await discordSQL.syncRoles(role.Id.ToString(), role.Name);
            }
        }

        private async void promoLiveCallbackAsync(object state)
        {
            SQLite.discordSQL discordSQL = new SQLite.discordSQL();
            var active = discordSQL.getOptions("StreamChannel_Status");

            if (active == "on") {

                // create twitch api instance
                var api = new TwitchAPI();
                api.Settings.ClientId = Config.TwitchClientId;
                api.Settings.AccessToken = Config.TwitchClientOAuth;

                using var con = new SQLiteConnection(cs);
                con.Open();
                var stm = $"SELECT * FROM gb_discord_streamers";

                using var cmd = new SQLiteCommand(stm, con);
                using SQLiteDataReader rdr = cmd.ExecuteReader();

                if (rdr.HasRows == true)
                {
                    while (rdr.Read())
                    {
                        var data = await api.Helix.Streams.GetStreamsAsync(userLogins: new List<string> { rdr["username"].ToString() });
                        if (rdr["live"].ToString() == "0")
                        {
                            
                            if (data.Streams.Length >= 1)
                            {
                                // Define Discord Context
                                var Context = client.GetGuild(Convert.ToUInt64(Config.DiscordServerId));
                                if (Context == null) { return; }

                                // Get Promo / Stream Channel
                                var channel = discordSQL.getOptions("StreamChannel");

                                // Create Embed
                                var twitch_url = $"http://www.twitch.tv/{data.Streams[0].UserLogin}";

                                // Repair Twitch Stupid Image Link
                                StringBuilder builder = new StringBuilder(data.Streams[0].ThumbnailUrl);
                                builder.Replace("{width}", "600");
                                builder.Replace("{height}", "400");

                                var eb = new EmbedBuilder();
                                eb.WithColor(Color.Orange);
                                eb.Url = twitch_url;
                                eb.Title = $"{data.Streams[0].UserName} is live on Twitch!";
                                eb.Description = $"{data.Streams[0].UserName} is currently streaming {data.Streams[0].GameName} @ {twitch_url}. Go check them out!";
                                eb.WithFooter(footer => footer.Text = "FoxxiBot [Twitch Promo]");
                                eb.Footer.IconUrl = "";
                                eb.WithCurrentTimestamp();

                                string image_url = builder.ToString();
                                eb.ImageUrl = image_url;

                                // Send Promo Message
                                await Context.GetTextChannel(Convert.ToUInt64(channel))
                                    .SendMessageAsync($"Go check out our friend, {data.Streams[0].UserName}. They're streaming {data.Streams[0].GameName} over @ {twitch_url}", false, eb.Build());

                                // Set as Complete
                                using var update = new SQLiteCommand(con);
                                update.CommandText = "INSERT or REPLACE INTO gb_discord_streamers(username, live) VALUES (@username, @live)";

                                update.Parameters.AddWithValue("@username", rdr["username"]);
                                update.Parameters.AddWithValue("@live", "1");
                                update.ExecuteNonQuery();
                            }

                        }

                        if (rdr["live"].ToString() == "1")
                        {

                            if (data.Streams.Length == 0)
                            {
                                // Set as Complete
                                using var update = new SQLiteCommand(con);
                                update.CommandText = "INSERT or REPLACE INTO gb_discord_streamers(username, live) VALUES (@username, @live)";

                                update.Parameters.AddWithValue("@username", rdr["username"]);
                                update.Parameters.AddWithValue("@live", "0");
                                update.ExecuteNonQuery();
                            }

                        }

                    }
                }

                con.Close();
            }
        }

    }
}
