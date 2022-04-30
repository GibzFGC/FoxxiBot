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
using System.Linq;
using System.Threading.Tasks;
using Discord;
using Discord.Commands;
using Discord.WebSocket;

namespace FoxxiBot.DiscordBot.Commands.Standard
{
    public class Discord_Avatar : ModuleBase<SocketCommandContext>
    {

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

            // Check if Bot locked to a Channel
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

    }
}
