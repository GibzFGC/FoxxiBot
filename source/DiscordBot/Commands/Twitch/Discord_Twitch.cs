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
using FoxxiBot.TwitchBot;
using System.Threading.Tasks;

namespace FoxxiBot.DiscordBot.Commands.Images
{
    public class Discord_Twitch : ModuleBase<SocketCommandContext>
    {

        [Group("twitch")]
        [Summary("Returns a random anime image from the server")]
        public class TwitchModule : ModuleBase<SocketCommandContext>
        {
            // ~twitch age <user>
            [Command("age")]
            public async Task GetAge([Remainder] string user)
            {

                var username = Twitch_GetData.displayNametoUserID(user).GetAwaiter().GetResult();
                var data = Twitch_GetData.getAccountAge(username).GetAwaiter().GetResult();

                await ReplyAsync($"{user} joined Twitch {data}");

            }

            // ~twitch age <user>
            [Command("followers")]
            public async Task GetFollowers([Remainder] string user)
            {

                var username = Twitch_GetData.displayNametoUserID(user).GetAwaiter().GetResult();
                var data = Twitch_GetData.getAccountAge(username).GetAwaiter().GetResult();

                await ReplyAsync($"{user} joined Twitch {data}");

            }

        }

    }
}