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
    public class Discord_Userinfo : ModuleBase<SocketCommandContext>
    {

        [Command("userinfo")]
        [RequireContext(ContextType.Guild, ErrorMessage = "Sorry, this command must be ran from within a server, not a DM!")]
        public async Task UserInfoAsync(SocketGuildUser user = null)
        {
            user = (SocketGuildUser)(user ?? Context.User);

            if (user.IsBot)
            {
                await ReplyAsync("Bots are not people~");
                return;
            }

            var embed = new EmbedBuilder { ThumbnailUrl = user.GetAvatarUrl() }
                .AddField("Member ID", user.Id, true)
                .AddField("Status", user.Status, true)
                .AddField("Joined Guild", user.JoinedAt.Value.ToString("dd MMMM, yyyy"), true)
                .AddField("Account Created", user.CreatedAt.ToString("dd MMMM, yyyy"), true)
                .AddField("Roles", user.Roles.Count - 1, true)
                .WithTimestamp(DateTimeOffset.Now)
                .WithAuthor(x =>
                {
                    x.Name = user.Username;
                    x.IconUrl = user.GetAvatarUrl();
                })
                .WithFooter(x =>
                {
                    x.Text = $"Requested By {Context.User.Username}";
                    x.IconUrl = Context.User.GetAvatarUrl();
                })
                .WithColor(Color.Red);

            if (user?.Activities.Count > 0)
            {
                var userActivities = user?.Activities.ToList();
                var userAct = userActivities?.First();

                if (userAct is SpotifyGame spot)
                    embed.AddField("Listening To", "Spotify", true)
                        .AddField("Track", spot.TrackTitle, true)
                        .AddField("Artist(s)", string.Join(", ", spot.Artists), true)
                        .AddField("Album", spot.AlbumTitle, true)
                        .WithThumbnailUrl(spot.AlbumArtUrl)
                        .WithColor(Color.Green);
                else if (userAct is CustomStatusGame statusGame)
                    embed.AddField("Activity", statusGame.Name, true)
                        .AddField("Details", statusGame.Details, true)
                        .AddField("Playing Since", statusGame.CreatedAt, true)
                        .WithColor(Color.Magenta);
                else if (userAct is RichGame richGame)
                    embed.AddField("Activity", richGame.Name, true)
                        .AddField("Details", richGame.Details, true)
                        .AddField("Playing Since", richGame.Timestamps?.Start.Value.ToString("hh:mm:ss tt") ?? "Unknown", true)
                        .WithThumbnailUrl(richGame.SmallAsset?.GetImageUrl() ?? user.GetAvatarUrl())
                        .WithColor(Color.Gold);
                else
                    embed.AddField("Activity", userAct.Name ?? "None", true);
            }
            else
            {
                embed.AddField("Activity", "None", true);
            }

            // Check if Bot locked to a Channel
            SQLite.discordSQL discordSQL = new SQLite.discordSQL();
            var active = discordSQL.getOptions("BotChannel_Status");
            if (active == "off")
            {
                await ReplyAsync(embed: embed.Build());
            }
            else
            {
                var channel = discordSQL.getOptions("BotChannel");
                await Context.Client.GetGuild(Convert.ToUInt64(Config.DiscordServerId))
                    .GetTextChannel(Convert.ToUInt64(channel)).SendMessageAsync(embed: embed.Build());
            }
        }

    }
}
