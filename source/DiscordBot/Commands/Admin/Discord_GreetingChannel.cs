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

using Discord.Commands;
using System;
using System.Threading.Tasks;

namespace FoxxiBot.DiscordBot.Commands.System
{
    public class Discord_GreetingChannel : ModuleBase<SocketCommandContext>
    {

        [RequireUserPermission(Discord.GuildPermission.Administrator)]
        [Group("system")]
        public class SystemModule : ModuleBase<SocketCommandContext>
        {

            string cs = @"URI=file:" + AppDomain.CurrentDomain.BaseDirectory + "/Data/bot.db";

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

        }

    }
}
