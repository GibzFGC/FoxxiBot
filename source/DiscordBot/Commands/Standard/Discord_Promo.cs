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
using System.Data.SQLite;
using System.Threading.Tasks;

namespace FoxxiBot.DiscordBot.Commands.Standard
{
    public class Discord_Promo : ModuleBase<SocketCommandContext>
    {

        [Group("promo")]
        public class StreamModule : ModuleBase<SocketCommandContext>
        {
            string cs = @"URI=file:" + AppDomain.CurrentDomain.BaseDirectory + "/Data/bot.db";

            // ~promo
            [Command]
            public async Task PromoDefault()
            {
                SQLite.discordSQL discordSQL = new SQLite.discordSQL();
                var active = discordSQL.getOptions("StreamChannel_Status");

                // Check if Bot locked to a Channel
                if (active == "off")
                {
                    await ReplyAsync($"The promo system is turned off right now");
                }
                else
                {
                    var channel = discordSQL.getOptions("StreamChannel");
                    var name = Context.Client.GetGuild(Convert.ToUInt64(Config.DiscordServerId)).GetChannel(Convert.ToUInt64(channel)).Name;

                    await Context.Client.GetGuild(Convert.ToUInt64(Config.DiscordServerId))
                        .GetTextChannel(Convert.ToUInt64(channel)).SendMessageAsync($"The promo system is turned on and pushing updates in here");
                }
            }

            // ~promo add <username>
            [Command("add")]
            public async Task PromoAdd([Remainder] string username)
            {
                using var con = new SQLiteConnection(cs);
                con.Open();

                using var cmd = new SQLiteCommand(con);

                cmd.CommandText = "INSERT or REPLACE INTO gb_discord_streamers(username, live) VALUES (@username, @live)";

                cmd.Parameters.AddWithValue("@username", username);
                cmd.Parameters.AddWithValue("@live", "0");

                cmd.Prepare();
                cmd.ExecuteNonQuery();

                con.Close();

                // Check if Bot locked to a Channel
                SQLite.discordSQL discordSQL = new SQLite.discordSQL();
                var active = discordSQL.getOptions("BotChannel_Status");

                if (active == "off")
                {
                    await ReplyAsync($"{username} has been added to the Promo list");
                }
                else
                {
                    var channel = discordSQL.getOptions("BotChannel");
                    await Context.Client.GetGuild(Convert.ToUInt64(Config.DiscordServerId))
                        .GetTextChannel(Convert.ToUInt64(channel)).SendMessageAsync($"{username} has been added to the Streamers list");
                }
            }

            // ~promo remove <username>
            [Command("remove")]
            public async Task StreamerRemove([Remainder] string username)
            {
                using var con = new SQLiteConnection(cs);

                con.Open();
                using var insertCmd = new SQLiteCommand(con);

                insertCmd.CommandText = $"DELETE FROM gb_discord_streamers WHERE username='{username}'";
                insertCmd.ExecuteNonQuery();

                con.Close();

                // Check if Bot locked to a Channel
                SQLite.discordSQL discordSQL = new SQLite.discordSQL();
                var active = discordSQL.getOptions("BotChannel_Status");

                if (active == "off")
                {
                    await ReplyAsync($"{username} has been removed from the Promo list");
                }
                else
                {
                    var channel = discordSQL.getOptions("BotChannel");
                    await Context.Client.GetGuild(Convert.ToUInt64(Config.DiscordServerId))
                        .GetTextChannel(Convert.ToUInt64(channel)).SendMessageAsync($"{username} has been removed from the Promo list");
                }
            }
        }

    }
}
