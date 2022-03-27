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

namespace FoxxiBot.TwitchBot
{
    public class Twitch_Variables
    {

        public string convertVariables(string commandText, string input, string displayName, string username)
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

            if (new_string.Contains("{dice}"))
            {
                Random rnd = new Random();
                int dice = rnd.Next(1, 7);
                new_string = new_string.Replace("{dice}", dice.ToString());
            }

            if (new_string.Contains("{follows}"))
            {
                var data = Twitch_GetData.getFollows().GetAwaiter().GetResult();
                new_string = new_string.Replace("{follows}", data.ToString());
            }

            if (new_string.Contains("{game}"))
            {
                var data = Twitch_GetData.getGame().GetAwaiter().GetResult();
                new_string = new_string.Replace("{game}", data.ToString());
            }

            if (new_string.Contains("{points}"))
            {
                var data = Twitch_GetData.userPoints(username);
                new_string = new_string.Replace("{points}", data.ToString());
            }

            if (new_string.Contains("{points_name}"))
            {
                SQLite.botSQL botSQL = new SQLite.botSQL();
                new_string = new_string.Replace("{points_name}", botSQL.pointOptions("points_name").ToString());
            }

            if (new_string.Contains("{sender}"))
            {
                new_string = new_string.Replace("{sender}", displayName);
            }

            if (new_string.Contains("{title}"))
            {
               var data = Twitch_GetData.getTitle().GetAwaiter().GetResult();
               new_string = new_string.Replace("{title}", data.ToString());
            }

            if (new_string.Contains("{user}"))
            {
                var split = commandText.Split(" ");
                new_string = new_string.Replace("{user}", split[1]);
            }

            if (new_string.Contains("{uptime}"))
            {
                var data = Twitch_GetData.getUpTime().GetAwaiter().GetResult();

                if (data != null) {
                    new_string = new_string.Replace("{uptime}", data.ToString());
                } else
                {
                    new_string = new_string.Replace("{uptime}", "Offline");
                }
            }

            if (new_string.Contains("{views}"))
            {
                var data = Twitch_GetData.getViews().GetAwaiter().GetResult();
                new_string = new_string.Replace("{views}", data.ToString());
            }

            return new_string;

        }

    }
}
