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

using Discord.Commands;
using System;
using System.Threading.Tasks;

namespace FoxxiBot.DiscordBot.Commands.System
{
    public class Discord_ServerID : ModuleBase<SocketCommandContext>
    {

        [RequireUserPermission(Discord.GuildPermission.Administrator)]
        [Group("system")]
        public class SystemModule : ModuleBase<SocketCommandContext>
        {

            string cs = @"URI=file:" + AppDomain.CurrentDomain.BaseDirectory + "/Data/bot.db";

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
        }

    }
}
