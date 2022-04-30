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
using System.Threading.Tasks;
using Discord;
using Discord.Commands;

namespace FoxxiBot.DiscordBot.Commands.System
{
    public class Discord_AutoRole : ModuleBase<SocketCommandContext>
    {

        [RequireUserPermission(Discord.GuildPermission.Administrator)]
        [Group("system")]
        public class SystemModule : ModuleBase<SocketCommandContext>
        {

            string cs = @"URI=file:" + AppDomain.CurrentDomain.BaseDirectory + "/Data/bot.db";

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

        }

    }
}
