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

namespace FoxxiBot.DiscordBot.Commands.Standard
{
    public class Discord_CatFact : ModuleBase<SocketCommandContext>
    {

        [Command("catfact")]
        [Summary("Returns a Cat Fact")]
        [Alias("catfacts")]
        public async Task CatFactAsync()
        {

            // Get HTTP Data
            var url = $"https://catfact.ninja/fact";

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

                var eb = new EmbedBuilder();
                eb.WithColor(Color.Orange);
                eb.AddField("Cat Fact", (string)o["fact"], true);
                eb.WithTimestamp(DateTimeOffset.Now);

                await ReplyAsync(embed: eb.Build());

            }
            else
            {
                await ReplyAsync($"Sorry, I couldn't pull a cat fact at the moment. Maybe the server is down.");
            }

        }

    }
}
