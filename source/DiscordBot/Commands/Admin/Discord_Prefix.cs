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
using Discord.Commands;

namespace FoxxiBot.DiscordBot.Commands.Admin
{
    public class Discord_Prefix : ModuleBase<SocketCommandContext>
    {

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

    }
}
