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
using System.Net.Http;
using System.Net.Http.Headers;
using System.Threading.Tasks;
using System.Web;
using Discord;
using Discord.Commands;
using Newtonsoft.Json.Linq;

namespace FoxxiBot.DiscordBot.Commands.Standard
{

    [Group("mal")]
        public class Discord_MAL : ModuleBase<SocketCommandContext>
        {

            // ~mal
            [Command]
            [Summary("Returns a Random Anime from MAL")]
            public async Task DefaultMAL()
            {

                // Get HTTP Data
                var url = $"https://api.jikan.moe/v4/random/anime";

                HttpClient client = new HttpClient();
                client.BaseAddress = new Uri(url);
                client.DefaultRequestHeaders.Accept.Add(new MediaTypeWithQualityHeaderValue("application/json"));
                HttpResponseMessage response = client.GetAsync(url).Result;

                if (response.IsSuccessStatusCode)
                {

                    var result = response.Content.ReadAsStringAsync().Result;

                    // Get number of items
                    JObject o = JObject.Parse(result);

                    // If no Images Found
                    if (o["data"] == null)
                    {
                        await ReplyAsync($"Sorry, something went wrong. Please try again!");
                        return;
                    }

                    var embed = new EmbedBuilder { ThumbnailUrl = (string)o["data"]["images"]["jpg"]["image_url"] }
                        .AddField("Anime Title", (string)o["data"]["title"] ?? "N/A", true)
                        .AddField("English Title", (string)o["data"]["title_english"] ?? "N/A", true)
                        .AddField("Japanese Title", (string)o["data"]["title_japanese"] ?? "N/A", true)
                        .AddField("Type", (string)o["data"]["type"] ?? "N/A", true)
                        .AddField("Source", (string)o["data"]["source"] ?? "N/A", true)
                        .AddField("Episodes", (string)o["data"]["episodes"] ?? "N/A", true)
                        .AddField("Status", (string)o["data"]["status"] ?? "N/A", true)
                        .AddField("Dates", (string)o["data"]["aired"]["string"] ?? "N/A", true)
                        .AddField("MAL Rank", (string)o["data"]["rank"] ?? "N/A", true)
                        .AddField("Synopsis", (string)o["data"]["synopsis"] ?? "N/A", true)
                        .WithUrl((string)o["data"]["url"])
                        .WithTimestamp(DateTimeOffset.Now)
                        .WithAuthor(x =>
                        {
                            x.Name = (string)o["data"]["title_english"] ?? (string)o["data"]["title"];
                            x.IconUrl = (string)o["data"]["images"]["jpg"]["image_url"];
                        })
                        .WithFooter(x =>
                        {
                            x.Text = $"Requested from My Anime List (via Jikan)";
                        })
                        .WithColor(Color.Red);

                    await ReplyAsync(message: (string)o["data"]["title_english"] ?? (string)o["data"]["title"] + "'s Page: " + (string)o["data"]["url"], embed: embed.Build());

                }
                else
                {
                    await ReplyAsync($"Sorry, I couldn't pull a random anime at the moment. Maybe the server is down.");
                }

            }

            // ~id
            [Command("id")]
            [Summary("Returns an Anime based on the given MAL ID")]
            public async Task idMAL([Remainder] string id)
            {

                // Get HTTP Data
                var url = $"https://api.jikan.moe/v4/anime/{id}";

                HttpClient client = new HttpClient();
                client.BaseAddress = new Uri(url);
                client.DefaultRequestHeaders.Accept.Add(new MediaTypeWithQualityHeaderValue("application/json"));
                HttpResponseMessage response = client.GetAsync(url).Result;

                if (response.IsSuccessStatusCode)
                {

                    var result = response.Content.ReadAsStringAsync().Result;

                    // Get number of items
                    JObject o = JObject.Parse(result);

                    // If no Images Found
                    if (o["data"] == null)
                    {
                        await ReplyAsync($"Sorry, something went wrong. Please try again!");
                        return;
                    }

                    var embed = new EmbedBuilder { ThumbnailUrl = (string)o["data"]["images"]["jpg"]["image_url"] }
                        .AddField("Anime Title", (string)o["data"]["title"] ?? "N/A", true)
                        .AddField("English Title", (string)o["data"]["title_english"] ?? "N/A", true)
                        .AddField("Japanese Title", (string)o["data"]["title_japanese"] ?? "N/A", true)
                        .AddField("Type", (string)o["data"]["type"] ?? "N/A", true)
                        .AddField("Source", (string)o["data"]["source"] ?? "N/A", true)
                        .AddField("Episodes", (string)o["data"]["episodes"] ?? "N/A", true)
                        .AddField("Status", (string)o["data"]["status"] ?? "N/A", true)
                        .AddField("Dates", (string)o["data"]["aired"]["string"] ?? "N/A", true)
                        .AddField("MAL Rank", (string)o["data"]["rank"] ?? "N/A", true)
                        .AddField("Synopsis", (string)o["data"]["synopsis"] ?? "N/A", true)
                        .WithUrl((string)o["data"]["url"])
                        .WithTimestamp(DateTimeOffset.Now)
                        .WithAuthor(x =>
                        {
                            x.Name = (string)o["data"]["title_english"] ?? (string)o["data"]["title"];
                            x.IconUrl = (string)o["data"]["images"]["jpg"]["image_url"];
                        })
                        .WithFooter(x =>
                        {
                            x.Text = $"Requested from My Anime List (via Jikan)";
                        })
                        .WithColor(Color.Red);

                    await ReplyAsync(message: (string)o["data"]["title_english"] ?? (string)o["data"]["title"] + "'s Page: " + (string)o["data"]["url"], embed: embed.Build());

                }
                else
                {
                    await ReplyAsync($"Sorry, I couldn't pull the requested anime at the moment. Maybe the server is down.");
                }

            }

            // ~title
            [Command("title")]
            [Summary("Returns an Anime based on the given Anime Title (may be inaccurate, ID is better)")]
            public async Task titleMAL([Remainder] string title)
            {

                // Fix Search String
                title = HttpUtility.HtmlEncode(title);

                // Get HTTP Data
                var url = $"https://api.jikan.moe/v4/anime?q={title}";

                HttpClient client = new HttpClient();
                client.BaseAddress = new Uri(url);
                client.DefaultRequestHeaders.Accept.Add(new MediaTypeWithQualityHeaderValue("application/json"));
                HttpResponseMessage response = client.GetAsync(url).Result;

                if (response.IsSuccessStatusCode)
                {

                    var result = response.Content.ReadAsStringAsync().Result;

                    // Get number of items
                    JObject o = JObject.Parse(result);

                    // If no Images Found
                    if (o["data"] == null)
                    {
                        await ReplyAsync($"Sorry, something went wrong. Please try again!");
                        return;
                    }

                    var embed = new EmbedBuilder { ThumbnailUrl = (string)o["data"][0]["images"]["jpg"]["image_url"] }
                        .AddField("Anime Title", (string)o["data"][0]["title"] ?? "N/A", true)
                        .AddField("English Title", (string)o["data"][0]["title_english"] ?? "N/A", true)
                        .AddField("Japanese Title", (string)o["data"][0]["title_japanese"] ?? "N/A", true)
                        .AddField("Type", (string)o["data"][0]["type"] ?? "N/A", true)
                        .AddField("Source", (string)o["data"][0]["source"] ?? "N/A", true)
                        .AddField("Episodes", (string)o["data"][0]["episodes"] ?? "N/A", true)
                        .AddField("Status", (string)o["data"][0]["status"] ?? "N/A", true)
                        .AddField("Dates", (string)o["data"][0]["aired"]["string"] ?? "N/A", true)
                        .AddField("MAL Rank", (string)o["data"][0]["rank"] ?? "N/A", true)
                        .AddField("Synopsis", (string)o["data"][0]["synopsis"] ?? "N/A", true)
                        .WithUrl((string)o["data"][0]["url"])
                        .WithTimestamp(DateTimeOffset.Now)
                        .WithAuthor(x =>
                        {
                            x.Name = title;
                            x.IconUrl = (string)o["data"][0]["images"]["jpg"]["image_url"];
                        })
                        .WithFooter(x =>
                        {
                            x.Text = $"Requested from My Anime List (via Jikan)";
                        })
                        .WithColor(Color.Red);

                    await ReplyAsync(message: (string)o["data"][0]["title_english"] ?? (string)o["data"][0]["title"] + "'s Page: " + (string)o["data"][0]["url"], embed: embed.Build());

                }
                else
                {
                    await ReplyAsync($"Sorry, I couldn't pull the requested anime at the moment. Maybe the server is down.");
                }

            }
        
    }
}