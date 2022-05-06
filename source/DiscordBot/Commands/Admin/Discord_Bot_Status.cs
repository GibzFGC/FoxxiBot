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
using System;
using System.Threading.Tasks;

namespace FoxxiBot.DiscordBot.Commands.Admin
{
    public class Discord_Bot_Status : ModuleBase<SocketCommandContext>
    {

        [Group("status")]
        public class StatusModule : ModuleBase<SocketCommandContext>
        {
            // ~status
            [Command]
            [RequireUserPermission(Discord.GuildPermission.Administrator)]
            public async Task CustomStatus([Remainder] string status)
            {

                // Split string up
                string[] args = status.Split(',');

                Console.WriteLine(status);

                // Set the game status
                switch (args[0])
                {
                    case "streaming":
                        await Context.Client.SetGameAsync(args[1], "https://www.twitch.tv/" + args[2], ActivityType.Streaming);
                        break;

                    case "watching":
                        await Context.Client.SetGameAsync(args[1], null, ActivityType.Watching);
                        break;

                    case "playing":
                        await Context.Client.SetGameAsync(args[1], null, ActivityType.Playing);
                        break;

                    case "listening":
                        await Context.Client.SetGameAsync(args[1], null, ActivityType.Listening);
                        break;
                }

                // Tell Admin it's Done
                SQLite.discordSQL discordSQL = new SQLite.discordSQL();
                var active = discordSQL.getOptions("BotChannel_Status");

                if (active == "off")
                {
                    await ReplyAsync($"The {args[0]} status has been set to '{args[1]}'");
                }
                else
                {
                    var channel = discordSQL.getOptions("BotChannel");
                    await Context.Client.GetGuild(Convert.ToUInt64(Config.DiscordServerId))
                        .GetTextChannel(Convert.ToUInt64(channel)).SendMessageAsync($"The {args[0]} status has been set to '{args[1]}'");
                }
            }
        }

    }
}
