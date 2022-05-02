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
using System.Net.Http;
using System.Net.Http.Headers;
using System.Threading.Tasks;
using Discord;
using Discord.Commands;
using Newtonsoft.Json.Linq;

namespace FoxxiBot.DiscordBot.Commands.Images
{
    public class Discord_Anime : ModuleBase<SocketCommandContext>
    {

        [Group("anime")]
        [Summary("Returns a random anime image from the server")]
        public class PrefixModule : ModuleBase<SocketCommandContext>
        {
            // ~anime
            [Command]
            public async Task AnimeAsync()
            {

                // Get a random Array value
                Random rnd = new Random();
                int index = rnd.Next(1000);

                // Get HTTP Data
                var url = $"https://safebooru.org/index.php?page=dapi&s=post&q=index&pid={index}&json=1";

                HttpClient client = new HttpClient();
                client.BaseAddress = new Uri(url);
                client.DefaultRequestHeaders.Accept.Add(new MediaTypeWithQualityHeaderValue("application/json"));
                HttpResponseMessage response = client.GetAsync(url).Result;

                if (response.IsSuccessStatusCode)
                {
                    var result = response.Content.ReadAsStringAsync().Result;

                    // Get number of items
                    JArray o = JArray.Parse(result);
                    int count = o.Count;

                    // Ger random from JSON Count
                    Random json_rnd = new Random();
                    int selected = json_rnd.Next(count);

                    var eb = new EmbedBuilder();
                    eb.WithColor(Color.Orange);
                    eb.WithImageUrl($"https://safebooru.org/images/{(string)o[selected]["directory"]}/{(string)o[selected]["image"]}");
                    eb.WithTimestamp(DateTimeOffset.Now);

                    await ReplyAsync(embed: eb.Build());
                }
                else
                {
                    await ReplyAsync($"Sorry, I couldn't pull an anime image at the moment. Maybe the server is down.");
                }

            }

            // ~anime get <tags>
            [Command("get")]
            public async Task GetAnime([Remainder] string tags)
            {

                // Get HTTP Data
                var url = $"https://safebooru.org/index.php?page=dapi&s=post&q=index&tags={tags}&pid=1&json=1";

                HttpClient client = new HttpClient();
                client.BaseAddress = new Uri(url);
                client.DefaultRequestHeaders.Accept.Add(new MediaTypeWithQualityHeaderValue("application/json"));
                HttpResponseMessage response = client.GetAsync(url).Result;

                if (response.IsSuccessStatusCode)
                {
                    var result = response.Content.ReadAsStringAsync().Result;

                    // Get number of items
                    JArray o = JArray.Parse(result);
                    int count = o.Count;

                    // Ger random from JSON Count
                    Random json_rnd = new Random();
                    int selected = json_rnd.Next(count);

                    var eb = new EmbedBuilder();
                    eb.WithColor(Color.Orange);
                    eb.WithImageUrl($"https://safebooru.org/images/{(string)o[selected]["directory"]}/{(string)o[selected]["image"]}");
                    eb.WithTimestamp(DateTimeOffset.Now);

                    await ReplyAsync(embed: eb.Build());
                }
                else
                {
                    await ReplyAsync($"Sorry, I couldn't pull an anime image at the moment. Maybe the server is down.");
                }

            }
        }
        
    }
}
