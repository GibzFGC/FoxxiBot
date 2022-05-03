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
    public class Discord_Cats : ModuleBase<SocketCommandContext>
    {

        [Command("cat")]
        [Summary("Returns a random cat / kitten from the server")]
        [Alias("cats")]
        public async Task CatSync()
        {

            // Define an Array of searchable items
            string[] list = new string[] { "cat", "cats", "catpics", "kitten", "kittens", "catpictures", "cursedcats", "angrycatpics", "CatsInSinks", "JellyBeanToes", "CatReactionGifs" };

            // Get a random Array value
            Random rnd = new Random();
            int index = rnd.Next(list.Length);

            // Get HTTP Data
            var url = $"https://imgur.com/r/{list[index]}/hot.json";

            HttpClient client = new HttpClient();
            client.BaseAddress = new Uri(url);
            client.DefaultRequestHeaders.Accept.Add(new MediaTypeWithQualityHeaderValue("application/json"));
            HttpResponseMessage response = client.GetAsync(url).Result;

            if (response.IsSuccessStatusCode)
            {
                var result = response.Content.ReadAsStringAsync().Result;

                // If no Images Found
                if (result.Length == 0)
                {
                    await ReplyAsync($"Sorry, something went wrong. Please try again!");
                    return;
                }

                // Get number of items
                JObject o = JObject.Parse(result);
                int count = o["data"].Count();

                // Ger random from JSON Count
                Random json_rnd = new Random();
                int selected = json_rnd.Next(count);

                var eb = new EmbedBuilder();
                eb.WithColor(Color.Orange);
                eb.WithImageUrl($"https://imgur.com/{(string)o["data"][selected]["hash"]}{(string)o["data"][selected]["ext"]}");
                eb.WithTimestamp(DateTimeOffset.Now);

                if ((string)o["data"][selected]["ext"] == ".mp4")
                {
                    await ReplyAsync($"https://imgur.com/{(string)o["data"][selected]["hash"]}{(string)o["data"][selected]["ext"]}");
                }
                else
                {
                    await ReplyAsync(embed: eb.Build());
                }

            }
            else
            {
                await ReplyAsync($"Sorry, I couldn't pull a cat image at the moment. Maybe the server is down.");
            }

        }

    }
}
