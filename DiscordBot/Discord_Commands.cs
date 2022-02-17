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
using System.Data.SQLite;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using Discord;
using Discord.Commands;
using Discord.WebSocket;

namespace FoxxiBot.DiscordBot
{

    [RequireUserPermission(Discord.GuildPermission.Administrator)]
    [Group("system")]
    public class SystemModule : ModuleBase<SocketCommandContext>
    {

        string cs = @"URI=file:" + AppDomain.CurrentDomain.BaseDirectory + "\\Data\\bot.db";

        // ~system serverid
        [Command("serverid")]
        public async Task serverId()
        {
            Config.DiscordServerId = Context.Guild.Id.ToString();

            // Save the new JSON Data
            Class.Bot_Functions functions = new Class.Bot_Functions();
            functions.SaveConfig().GetAwaiter().GetResult();
            
            SQLite.discordSQL discordSQL = new SQLite.discordSQL();
            var active = discordSQL.getOptions("BotChannel_Status");

            if (active == "off")
            {
                await ReplyAsync("The Server ID has been Registered");
            }
            else
            {
                var channel = discordSQL.getOptions("BotChannel");
                await Context.Client.GetGuild(Convert.ToUInt64(Config.DiscordServerId))
                    .GetTextChannel(Convert.ToUInt64(channel)).SendMessageAsync($"The Server ID has been Registered");
            }
        }

        // ~system botchannel
        [Command("botchannel")]
        public async Task botChannel()
        {
            SQLite.discordSQL discordSQL = new SQLite.discordSQL();
            discordSQL.updateOptions("BotChannel", Context.Channel.Id.ToString());
            var active = discordSQL.getOptions("BotChannel_Status");

            if (active == "off")
            {
                await ReplyAsync("This channel has been set as the Bot Channel");
            }
            else
            {   
                var channel = discordSQL.getOptions("BotChannel");
                await Context.Client.GetGuild(Convert.ToUInt64(Config.DiscordServerId))
                    .GetTextChannel(Convert.ToUInt64(channel)).SendMessageAsync($"The channel '{Context.Channel.Name}' has been set as the Bot Channel");
            }
        }

        // ~system botchannel on
        [Command("botchannel on")]
        public async Task botChannelOn()
        {
            SQLite.discordSQL discordSQL = new SQLite.discordSQL();
            discordSQL.updateOptions("BotChannel_Status", "1");
            var active = discordSQL.getOptions("BotChannel_Status");

            if (active == "off")
            {
                await ReplyAsync("This Bot will now be locked to it's specified channel");
            }
            else
            {
                var channel = discordSQL.getOptions("BotChannel");
                await Context.Client.GetGuild(Convert.ToUInt64(Config.DiscordServerId))
                    .GetTextChannel(Convert.ToUInt64(channel)).SendMessageAsync("The Bot will now be locked to it's specified channel");
            }
        }

        // ~system botchannel off
        [Command("botchannel off")]
        public async Task botChannelOff()
        {
            SQLite.discordSQL discordSQL = new SQLite.discordSQL();
            discordSQL.updateOptions("BotChannel_Status", "0");
            var active = discordSQL.getOptions("BotChannel_Status");

            if (active == "off")
            {
                await ReplyAsync("This Bot will no longer be locked to it's specified channel");
            }
            else
            {
                var channel = discordSQL.getOptions("BotChannel");
                await Context.Client.GetGuild(Convert.ToUInt64(Config.DiscordServerId))
                    .GetTextChannel(Convert.ToUInt64(channel)).SendMessageAsync("The Bot will no longer be locked to it's specified channel");
            }
        }

        // ~system greetingchannel
        [Command("greetingchannel")]
        public async Task greetingChannel()
        {
            SQLite.discordSQL discordSQL = new SQLite.discordSQL();
            discordSQL.updateOptions("GreetingChannel", Context.Channel.Id.ToString());
            var active = discordSQL.getOptions("BotChannel_Status");

            if (active == "off")
            {
                await ReplyAsync("This channel has been set as the Greeting / Leaving Channel");
            }
            else
            {
                var channel = discordSQL.getOptions("BotChannel");
                await Context.Client.GetGuild(Convert.ToUInt64(Config.DiscordServerId))
                    .GetTextChannel(Convert.ToUInt64(channel)).SendMessageAsync($"The channel '{Context.Channel.Name}' has been set as the Greeting / Leaving Channel");
            }
        }

        // ~system greetingchannel on
        [Command("greetingchannel on")]
        public async Task greetingChannelOn()
        {
            SQLite.discordSQL discordSQL = new SQLite.discordSQL();
            discordSQL.updateOptions("GreetingChannel_Status", "1");
            var active = discordSQL.getOptions("BotChannel_Status");

            if (active == "off")
            {
                await ReplyAsync("This Bot will now send welcome / leave greetings");
            }
            else
            {
                var channel = discordSQL.getOptions("BotChannel");
                await Context.Client.GetGuild(Convert.ToUInt64(Config.DiscordServerId))
                    .GetTextChannel(Convert.ToUInt64(channel)).SendMessageAsync("This Bot will now send welcome / leave greetings");
            }
        }

        // ~system greetingchannel off
        [Command("greetingchannel off")]
        public async Task greetingChannelOff()
        {
            SQLite.discordSQL discordSQL = new SQLite.discordSQL();
            discordSQL.updateOptions("GreetingChannel_Status", "0");
            var active = discordSQL.getOptions("BotChannel_Status");

            if (active == "off")
            {
                await ReplyAsync("This Bot will no longer send welocme / leave greetings");
            }
            else
            {
                var channel = discordSQL.getOptions("BotChannel");
                await Context.Client.GetGuild(Convert.ToUInt64(Config.DiscordServerId))
                    .GetTextChannel(Convert.ToUInt64(channel)).SendMessageAsync("This Bot will no longer send welocme / leave greetings");
            }
        }

        // ~system streamchannel
        [Command("autorole")]
        public async Task autorole(IRole role)
        {
            SQLite.discordSQL discordSQL = new SQLite.discordSQL();
            discordSQL.updateOptions("AutoRole", role.Id.ToString());
            var active = discordSQL.getOptions("BotChannel_Status");

            if (active == "off")
            {
                await ReplyAsync($"The auto-join role has been set as {role.Name}");
            }
            else
            {
                var channel = discordSQL.getOptions("BotChannel");
                await Context.Client.GetGuild(Convert.ToUInt64(Config.DiscordServerId))
                    .GetTextChannel(Convert.ToUInt64(channel)).SendMessageAsync($"The auto-join role has been set as {role.Name}");
            }
        }

        // ~system autorole on
        [Command("autorole on")]
        public async Task autoroleOn()
        {
            SQLite.discordSQL discordSQL = new SQLite.discordSQL();
            discordSQL.updateOptions("AutoRole_Status", "1");

            await ReplyAsync("The Bot will now assign the auto-join role to all who join the Server");
        }

        // ~system autorole off
        [Command("autorole off")]
        public async Task autoroleOff()
        {
            SQLite.discordSQL discordSQL = new SQLite.discordSQL();
            discordSQL.updateOptions("AutoRole_Status", "0");
            var active = discordSQL.getOptions("BotChannel_Status");

            if (active == "off")
            {
                await ReplyAsync($"The Bot will no longer assign the auto-join role");
            }
            else
            {
                var channel = discordSQL.getOptions("BotChannel");
                await Context.Client.GetGuild(Convert.ToUInt64(Config.DiscordServerId))
                    .GetTextChannel(Convert.ToUInt64(channel)).SendMessageAsync($"The Bot will no longer assign the auto-join role");
            }
        }

        // ~system promochannel
        [Command("promochannel")]
        public async Task streamChannel()
        {
            SQLite.discordSQL discordSQL = new SQLite.discordSQL();
            discordSQL.updateOptions("StreamChannel", Context.Channel.Id.ToString());
            var active = discordSQL.getOptions("BotChannel_Status");

            if (active == "off")
            {
                await ReplyAsync($"This channel has been set as the Streaming Channel");
            }
            else
            {
                var channel = discordSQL.getOptions("BotChannel");
                await Context.Client.GetGuild(Convert.ToUInt64(Config.DiscordServerId))
                    .GetTextChannel(Convert.ToUInt64(channel)).SendMessageAsync($"The channel '{Context.Channel.Name}' has been set as the Streaming Channel");
            }
        }

        // ~system promochannel on
        [Command("promochannel on")]
        public async Task streamChannelOn()
        {
            SQLite.discordSQL discordSQL = new SQLite.discordSQL();
            discordSQL.updateOptions("StreamChannel_Status", "1");
            var active = discordSQL.getOptions("BotChannel_Status");

            if (active == "off")
            {
                await ReplyAsync($"The Bot will now send stream notifications to the specified channel");
            }
            else
            {
                var channel = discordSQL.getOptions("BotChannel");
                await Context.Client.GetGuild(Convert.ToUInt64(Config.DiscordServerId))
                    .GetTextChannel(Convert.ToUInt64(channel)).SendMessageAsync($"The Bot will now send stream notifications to the specified channel");
            }
        }

        // ~system promochannel off
        [Command("promochannel off")]
        public async Task streamChannelOff()
        {
            SQLite.discordSQL discordSQL = new SQLite.discordSQL();
            discordSQL.updateOptions("StreamChannel_Status", "0");
            var active = discordSQL.getOptions("BotChannel_Status");

            if (active == "off")
            {
                await ReplyAsync($"The Bot will no longer send stream notifications");
            }
            else
            {
                var channel = discordSQL.getOptions("BotChannel");
                await Context.Client.GetGuild(Convert.ToUInt64(Config.DiscordServerId))
                    .GetTextChannel(Convert.ToUInt64(channel)).SendMessageAsync($"The Bot will no longer send stream notifications");
            }
        }

        // ~system syncroles
        [Command("syncroles", RunMode = RunMode.Async)]
        public async Task syncRolesasync()
        {
            SQLite.discordSQL discordSQL = new SQLite.discordSQL();
            foreach (var role in Context.Guild.Roles)
            {
               await discordSQL.syncRoles(role.Id.ToString(), role.Name);
            }

            var active = discordSQL.getOptions("BotChannel_Status");

            if (active == "off")
            {
                await ReplyAsync($"The roles have been synced to the database");
            }
            else
            {
                var channel = discordSQL.getOptions("BotChannel");
                await Context.Client.GetGuild(Convert.ToUInt64(Config.DiscordServerId))
                    .GetTextChannel(Convert.ToUInt64(channel)).SendMessageAsync($"The roles have been synced to the database");
            }
        }

        // ~system syncchannels
        [Command("syncchannels", RunMode = RunMode.Async)]
        public async Task syncChannelsasync()
        {
            SQLite.discordSQL discordSQL = new SQLite.discordSQL();
            foreach (var channel in Context.Guild.Channels)
            {
                var channel_type = channel.GetChannelType();
                await discordSQL.syncChannels(channel.Id.ToString(), channel.Name, channel_type.Value.ToString());
            }

            var active = discordSQL.getOptions("BotChannel_Status");

            if (active == "off")
            {
                await ReplyAsync($"The channels have been synced to the database");
            }
            else
            {
                var channel = discordSQL.getOptions("BotChannel");
                await Context.Client.GetGuild(Convert.ToUInt64(Config.DiscordServerId))
                    .GetTextChannel(Convert.ToUInt64(channel)).SendMessageAsync($"The channels have been synced to the database");
            }
        }

    }

    [Group("status")]
    public class StatusModule : ModuleBase<SocketCommandContext>
    {
        // ~status
        [Command]
        [RequireUserPermission(Discord.GuildPermission.Administrator)]
        public async Task CustomStatus(string type, string link = null, [Remainder] string status = null)
        {
            // Set the game status
            switch (type)
            {
                case "streaming":
                    await Context.Client.SetGameAsync(status, link, ActivityType.Streaming);
                    break;

                case "watching":
                    await Context.Client.SetGameAsync(status, null, ActivityType.Watching);
                    break;

                case "playing":
                    await Context.Client.SetGameAsync(status, null, ActivityType.Playing);
                    break;

                case "listening":
                    await Context.Client.SetGameAsync(status, null, ActivityType.Listening);
                    break;
            }

            // Tell Admin it's Done
            SQLite.discordSQL discordSQL = new SQLite.discordSQL();
            var active = discordSQL.getOptions("BotChannel_Status");

            if (active == "off")
            {
                await ReplyAsync($"The playing status has been set to '{status}'");
            }
            else
            {
                var channel = discordSQL.getOptions("BotChannel");
                await Context.Client.GetGuild(Convert.ToUInt64(Config.DiscordServerId))
                    .GetTextChannel(Convert.ToUInt64(channel)).SendMessageAsync($"The playing status has been set to '{status}'");
            }
        }
    }

    [Group("prefix")]
    public class PrefixModule : ModuleBase<SocketCommandContext>
    {
        // ~prefix
        [Command]
        public async Task DefaultPrefix()
        {
            SQLite.discordSQL discordSQL = new SQLite.discordSQL();
            var active = discordSQL.getOptions("BotChannel_Status");

            if (active == "off")
            {
                await ReplyAsync($"The current prefix is {Config.DiscordPrefix}");
            }
            else
            {
                var channel = discordSQL.getOptions("BotChannel");
                await Context.Client.GetGuild(Convert.ToUInt64(Config.DiscordServerId))
                    .GetTextChannel(Convert.ToUInt64(channel)).SendMessageAsync($"The current prefix is {Config.DiscordPrefix}");
            }
        }

        // ~preflix set <prefix>
        [Command("set")]
        [RequireUserPermission(Discord.GuildPermission.Administrator)]
        public async Task SetPrefix(string prefix)
        {
            // Set new Prefix Value
            Config.DiscordPrefix = prefix;

            // Save the new JSON Data
            Class.Bot_Functions functions = new Class.Bot_Functions();
            await functions.SaveConfig();

            // Tell Admin it's Done
            SQLite.discordSQL discordSQL = new SQLite.discordSQL();
            var active = discordSQL.getOptions("BotChannel_Status");

            if (active == "off")
            {
                await ReplyAsync($"The prefix has been set to {prefix}");
            }
            else
            {
                var channel = discordSQL.getOptions("BotChannel");
                await Context.Client.GetGuild(Convert.ToUInt64(Config.DiscordServerId))
                    .GetTextChannel(Convert.ToUInt64(channel)).SendMessageAsync($"The prefix has been set to {prefix}");
            }
        }
    }

	public class Discord_Commands : ModuleBase<SocketCommandContext>
    {
        // say hello world -> hello world
        [Command("say")]
        [Summary("Echoes a message.")]
        public Task SayAsync([Remainder][Summary("The text to echo")] string echo)
            => ReplyAsync(echo);

		[Command("userinfo")]
		[Summary
		("Returns info about the current user, or the user parameter, if one passed.")]
		[Alias("user", "whois")]
		public async Task UserInfoAsync(
		[Summary("The (optional) user to get info from")]
		SocketUser user = null)
		{
			var userInfo = user ?? Context.Client.CurrentUser;

            // Tell Admin it's Done
            SQLite.discordSQL discordSQL = new SQLite.discordSQL();
            var active = discordSQL.getOptions("BotChannel_Status");

            if (active == "off")
            {
                await ReplyAsync($"{userInfo.Username}#{userInfo.Discriminator}");
            }
            else
            {
                var channel = discordSQL.getOptions("BotChannel");
                await Context.Client.GetGuild(Convert.ToUInt64(Config.DiscordServerId))
                    .GetTextChannel(Convert.ToUInt64(channel)).SendMessageAsync($"{userInfo.Username}#{userInfo.Discriminator}");
            }
		}

        [Command("avatar")]
        [Summary
        ("Returns the full version of the users avatar")]
        [Alias("useravatar", "profileimg")]
        public async Task UserAvatarAsync(
        [Summary("The (optional) user to get avatar from")]
        SocketUser user = null)
        {
            var userInfo = user ?? Context.Client.CurrentUser;

            var eb = new EmbedBuilder();
            eb.WithColor(Color.Orange);
            eb.WithImageUrl(userInfo.GetAvatarUrl());

            // Tell Admin it's Done
            SQLite.discordSQL discordSQL = new SQLite.discordSQL();
            var active = discordSQL.getOptions("BotChannel_Status");

            if (active == "off")
            {
                await ReplyAsync($"The avatar for {userInfo.Username}", false, eb.Build());
            }
            else
            {
                var channel = discordSQL.getOptions("BotChannel");
                await Context.Client.GetGuild(Convert.ToUInt64(Config.DiscordServerId))
                    .GetTextChannel(Convert.ToUInt64(channel)).SendMessageAsync($"The avatar for {userInfo.Username}", false, eb.Build());
            }
        }

        [Command("purge", RunMode = RunMode.Async)]
        [Summary("Deletes the specified amount of messages.")]
        [RequireUserPermission(GuildPermission.Administrator)]
        [RequireBotPermission(ChannelPermission.ManageMessages)]
        public async Task PurgeChat(int amount)
        {
            IEnumerable<IMessage> messages = await Context.Channel.GetMessagesAsync(amount + 1).FlattenAsync();
            await ((ITextChannel)Context.Channel).DeleteMessagesAsync(messages);
            const int delay = 3000;

            // Tell Admin it's Done
            SQLite.discordSQL discordSQL = new SQLite.discordSQL();
            var active = discordSQL.getOptions("BotChannel_Status");

            IUserMessage m;

            if (active == "off")
            {
                m = await ReplyAsync($"{amount} messages have been deleted from this channel");
            }
            else
            {
                var channel = discordSQL.getOptions("BotChannel");
                m = await Context.Client.GetGuild(Convert.ToUInt64(Config.DiscordServerId))
                    .GetTextChannel(Convert.ToUInt64(channel)).SendMessageAsync($"{amount} messages have been deleted from this channel");
            }

            await Task.Delay(delay);
            await m.DeleteAsync();
        }
    }

    [Group("promo")]
    public class StreamModule : ModuleBase<SocketCommandContext>
    {
        string cs = @"URI=file:" + AppDomain.CurrentDomain.BaseDirectory + "\\Data\\bot.db";

        // ~promo
        [Command]
        public async Task PromoDefault()
        {
            SQLite.discordSQL discordSQL = new SQLite.discordSQL();
            var active = discordSQL.getOptions("StreamChannel_Status");

            if (active == "off")
            {
                await ReplyAsync($"The promo system is turned off right now");
            }
            else
            {
                var channel = discordSQL.getOptions("StreamChannel");
                var name = Context.Client.GetGuild(Convert.ToUInt64(Config.DiscordServerId)).GetChannel(Convert.ToUInt64(channel)).Name;

                await Context.Client.GetGuild(Convert.ToUInt64(Config.DiscordServerId))
                    .GetTextChannel(Convert.ToUInt64(channel)).SendMessageAsync($"The promo system is turned on and pushing updates in here");
            }
        }

        // ~promo add <username>
        [Command("add")]
        public async Task PromoAdd([Remainder] string username)
        {
            using var con = new SQLiteConnection(cs);
            con.Open();

            using var cmd = new SQLiteCommand(con);

            cmd.CommandText = "INSERT or REPLACE INTO gb_discord_streamers(username, live) VALUES (@username, @live)";

            cmd.Parameters.AddWithValue("@username", username);
            cmd.Parameters.AddWithValue("@live", "0");

            cmd.Prepare();
            cmd.ExecuteNonQuery();

            con.Close();

            SQLite.discordSQL discordSQL = new SQLite.discordSQL();
            var active = discordSQL.getOptions("BotChannel_Status");

            if (active == "off")
            {
                await ReplyAsync($"{username} has been added to the Promo list");
            }
            else
            {
                var channel = discordSQL.getOptions("BotChannel");
                await Context.Client.GetGuild(Convert.ToUInt64(Config.DiscordServerId))
                    .GetTextChannel(Convert.ToUInt64(channel)).SendMessageAsync($"{username} has been added to the Streamers list");
            }
        }

        // ~promo remove <username>
        [Command("remove")]
        public async Task StreamerRemove([Remainder] string username)
        {
            using var con = new SQLiteConnection(cs);

            con.Open();
            using var insertCmd = new SQLiteCommand(con);

            insertCmd.CommandText = $"DELETE FROM gb_discord_streamers WHERE username='{username}'";
            insertCmd.ExecuteNonQuery();

            con.Close();

            SQLite.discordSQL discordSQL = new SQLite.discordSQL();
            var active = discordSQL.getOptions("BotChannel_Status");

            if (active == "off")
            {
                await ReplyAsync($"{username} has been removed from the Promo list");
            }
            else
            {
                var channel = discordSQL.getOptions("BotChannel");
                await Context.Client.GetGuild(Convert.ToUInt64(Config.DiscordServerId))
                    .GetTextChannel(Convert.ToUInt64(channel)).SendMessageAsync($"{username} has been removed from the Promo list");
            }
        }

    }
}