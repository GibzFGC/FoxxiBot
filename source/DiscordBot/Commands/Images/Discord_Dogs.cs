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
using System.Linq;
using System.Net.Http;
using System.Net.Http.Headers;
using System.Threading.Tasks;

namespace FoxxiBot.DiscordBot.Commands.Images
{
    public class Discord_Dogs : ModuleBase<SocketCommandContext>
    {

        [Command("dog")]
        [Summary
        ("Returns a random dog / puppy from the server")]
        [Alias("dogs")]
        public async Task DogSync()
        {

            // Get HTTP Data
            var url = $"https://random.dog/woof.json";

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

                // Set JSON Object
                JObject o = JObject.Parse(result);

                // Build Discord Embed
                var eb = new EmbedBuilder();
                eb.WithColor(Color.Orange);
                eb.WithImageUrl($"{(string)o["url"]}");
                eb.WithTimestamp(DateTimeOffset.Now);

                string dog_url = (string)o["url"];
                if (dog_url.Contains(".mp4"))
                {
                    await ReplyAsync($"{(string)o["url"]}");
                }
                else
                {
                    await ReplyAsync(embed: eb.Build());
                }

            }
            else
            {
                await ReplyAsync($"Sorry, I couldn't pull a dog image at the moment. Maybe the server is down.");
            }

        }

    }
}
