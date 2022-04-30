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
    public class Discord_Ping : ModuleBase<SocketCommandContext>
    {

        [Command("ping", RunMode = RunMode.Async)]
        private async Task GetPing()
        {
            string pingTime = string.Empty;
            pingTime = $"My current ping time is **{Context.Client.Latency}**ms";
            await ReplyAsync(pingTime);
        }

    }
}
