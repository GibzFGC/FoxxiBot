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
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace FoxxiBot.DiscordBot
{
    public class Discord_Variables
    {

        public string convertVariables(string commandText, string input, string displayName)
        {

            var new_string = input;

            if (new_string.Contains("{1}"))
            {
                var split = commandText.Split(" ");
                new_string = new_string.Replace("{1}", split[1]);
            }

            if (new_string.Contains("{2}"))
            {
                var split = commandText.Split(" ");
                new_string = new_string.Replace("{2}", split[2]);
            }

            if (new_string.Contains("{8ball}"))
            {
                // A array of values  
                string[] responses = { 
                    "It is certain", "It is decidedly so", "Without a doubt", "Yes definitely", "You may rely on it", "As I see it, yes", "Most likely",
                    "Outlook good", "Yes", "Signs point to yes", "Reply hazy, try again", "Ask again later", "Better not tell you now", "Cannot predict now",
                    "Concentrate and ask again", "Don't count on it", "My reply is no", "My sources say no", "Outlook not so good", "Very doubtful"
                };

                // Create a Random object  
                Random rand = new Random();

                // Generate a random index less than the size of the array.  
                int index = rand.Next(responses.Length);

                // Display the result
                new_string = new_string.Replace("{8ball}", responses[index]);
            }

            if (new_string.Contains("{dice}"))
            {
                Random rnd = new Random();
                int dice = rnd.Next(1, 7);
                new_string = new_string.Replace("{dice}", dice.ToString());
            }

            if (new_string.Contains("{sender}"))
            {
                new_string = new_string.Replace("{sender}", displayName);
            }

            return new_string;

        }

    }
}
