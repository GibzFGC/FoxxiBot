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
using System.Threading.Tasks;
using Discord;
using Discord.Commands;

namespace FoxxiBot.DiscordBot.Commands.System
{
    public class Discord_Purge : ModuleBase<SocketCommandContext>
    {

        [Command("purge", RunMode = RunMode.Async)]
        [Summary("Deletes the specified amount of messages.")]
        [Alias("prune", "clear")]
        [RequireUserPermission(GuildPermission.Administrator)]
        [RequireBotPermission(ChannelPermission.ManageMessages)]
        public async Task PurgeChat(int amount)
        {
            IEnumerable<IMessage> messages = await Context.Channel.GetMessagesAsync(amount + 1).FlattenAsync();
            await ((ITextChannel)Context.Channel).DeleteMessagesAsync(messages);
            const int delay = 3000;

            // Check if Bot locked to a Channel
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
}
