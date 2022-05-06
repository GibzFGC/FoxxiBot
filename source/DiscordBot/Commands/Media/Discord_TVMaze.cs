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
using Newtonsoft.Json.Linq;
using System;
using System.Net.Http;
using System.Net.Http.Headers;
using System.Text.RegularExpressions;
using System.Threading.Tasks;
using System.Web;

namespace FoxxiBot.DiscordBot.Commands.Media
{

    [Group("tv")]
    public class Discord_TVMaze : ModuleBase<SocketCommandContext>
    {

        public static string StripHTML(string input)
        {
            return Regex.Replace(input, "<.*?>", String.Empty);
        }

        // ~tvmaze
        [Command]
        [Summary("Returns the TV show Data Requested")]
        [Alias("tvmaze")]
        public async Task DefaultTVMade([Remainder] string title)
        {

            // Fix Search String
            title = HttpUtility.HtmlEncode(title);

            // Get HTTP Data
            var url = $"https://api.tvmaze.com/search/shows?q={title}";

            HttpClient client = new HttpClient();
            client.BaseAddress = new Uri(url);
            client.DefaultRequestHeaders.Accept.Add(new MediaTypeWithQualityHeaderValue("application/json"));
            HttpResponseMessage response = client.GetAsync(url).Result;

            if (response.IsSuccessStatusCode)
            {

                var result = response.Content.ReadAsStringAsync().Result;

                // Get number of items
                JArray o = JArray.Parse(result);

                // If no TV Show Found
                if (o[0]["show"] == null)
                {
                    await ReplyAsync($"Sorry, something went wrong. Please try again!");
                    return;
                }

                var embed = new EmbedBuilder { ThumbnailUrl = (string)o[0]["show"]["image"]["medium"] }
                    .AddField("Show Title", (string)o[0]["show"]["name"] ?? "N/A", true)
                    .AddField("Language", (string)o[0]["show"]["language"] ?? "N/A", true)
                    .AddField("Type", (string)o[0]["show"]["type"] ?? "N/A", true)
                    .AddField("Premiered", (string)o[0]["show"]["premiered"] ?? "N/A", true)
                    .AddField("Ended", (string)o[0]["show"]["ended"] ?? "N/A", true)
                    .AddField("Status", (string)o[0]["show"]["status"] ?? "N/A", true)
                    .AddField("Genre(s)", o[0]["show"]["genres"].ToString().Replace("[", "").Replace("]", "") ?? "N/A", true)
                    .AddField("Made in", (string)o[0]["show"]["network"]["country"]["name"] ?? "N/A", true)
                    .AddField("Originally on", (string)o[0]["show"]["network"]["name"] ?? "N/A", true)
                    .AddField("Synopsis", StripHTML((string)o[0]["show"]["summary"]) ?? "N/A", false)
                    .WithTimestamp(DateTimeOffset.Now)
                    .WithAuthor(x =>
                    {
                        x.Name = (string)o[0]["show"]["name"];
                        x.IconUrl = (string)o[0]["show"]["image"]["medium"];
                    })
                    .WithFooter(x =>
                    {
                        x.Text = $"Requested from TV Maze";
                    })
                    .WithColor(Color.Red);

                await ReplyAsync(message: (string)o[0]["show"]["name"] + "'s Page: " + (string)o[0]["show"]["url"], embed: embed.Build());

            }
            else
            {
                await ReplyAsync($"Sorry, I couldn't pull the TV show at the moment. Maybe the server is down.");
            }

        }

    }
}