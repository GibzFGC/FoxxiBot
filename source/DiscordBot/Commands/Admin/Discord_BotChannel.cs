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
    public class Discord_BotChannel : ModuleBase<SocketCommandContext>
    {

        [RequireUserPermission(Discord.GuildPermission.Administrator)]
        [Group("system")]
        public class SystemModule : ModuleBase<SocketCommandContext>
        {

            string cs = @"URI=file:" + AppDomain.CurrentDomain.BaseDirectory + "/Data/bot.db";

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

        }

    }
}
