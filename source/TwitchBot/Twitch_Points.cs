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

namespace FoxxiBot.TwitchBot
{
    internal class Twitch_Points
    {

        string cs = @"URI=file:" + AppDomain.CurrentDomain.BaseDirectory + "\\Data\\bot.db";
        SQLite.twitchSQL twitchSQL = new SQLite.twitchSQL();

        public string commandGamblePoints(TwitchLib.Client.Events.OnChatCommandReceivedArgs e)
        {

            if (e.Command.ArgumentsAsList.Count == 0)
            {
                return "Please specify an amount of points you would like to gamble";
            }

            if (e.Command.ArgumentsAsList.Count > 0)
            {
                int n;
                int points = Convert.ToInt32(Twitch_GetData.userPoints(e.Command.ChatMessage.Username));

                if (e.Command.ArgumentsAsString.Equals("all"))
                {

                    var seed = (int)DateTime.Now.Ticks;
                    var random = new Random(seed);

                    var rand_value = random.Next(10);

                    if (rand_value % 2 == 0)
                    {

                        // Math for Points
                        int final_points = points + points;

                        // Winner, Give X% More
                        twitchSQL.pointsChange(e.Command.ChatMessage.Username, final_points);

                        // Num is Even
                        return "Congratulations, you gambled everything and won double! You now have " + final_points + " point(s)";

                    }
                    else
                    {

                        // Math for Points
                        int final_points = 0;

                        // Winner, Give X% More
                        twitchSQL.pointsChange(e.Command.ChatMessage.Username, final_points);

                        // Num is Even
                        return "Oh no!, you gambled everything and lost all your points!";

                    }
                }

                if (e.Command.ArgumentsAsString.Contains("%"))
                {
                    decimal percentage = Convert.ToInt32(e.Command.ArgumentsAsString.Replace("%", ""));
                    var math = (percentage / 100) * points;

                    var seed = (int)DateTime.Now.Ticks;
                    var random = new Random(seed);

                    var rand_value = random.Next(10);

                    if (rand_value % 2 == 0)
                    {
                        // Math for Points
                        decimal final_points = points + Math.Round(math);

                        // Winner, Give X% More
                        twitchSQL.pointsChange(e.Command.ChatMessage.Username, final_points);

                        // Num is Even
                        return "Congratulations, you gambled " + percentage + "% and won an extra " + Math.Round(math) + " giving you " + final_points + " point(s)";
                    }
                    else
                    {
                        // Math for Points
                        decimal final_points = points - Math.Round(math);

                        // Loser, Take X%
                        twitchSQL.pointsChange(e.Command.ChatMessage.Username, final_points);

                        // Num is Odd
                        return "What a shame, you gambled " + percentage + "% and lost " + Math.Round(math) + " giving you " + final_points + " point(s)";
                    }

                }

                bool isNumeric = int.TryParse(e.Command.ArgumentsAsString, out n);
                if (isNumeric == true)
                {

                    if (points < n)
                    {
                        return "Sorry, you don't have " + n + " points to gamble with. Your currently have " + points + " point(s)";
                    }

                    if (n < 1)
                    {
                        return "You cannot gamble a value less than 1 point. You currently have " + points + " point(s)";
                    }

                    var seed = (int)DateTime.Now.Ticks;
                    var random = new Random(seed);

                    var rand_value = random.Next(10);

                    if (rand_value % 2 == 0)
                    {
                        // Math for Points
                        decimal final_points = points + n;

                        // Winner, Give X More
                        twitchSQL.pointsChange(e.Command.ChatMessage.Username, final_points);

                        // Num is Even
                        return "Congratulations, you gambled " + n + " points and now have " + final_points + " point(s)";
                    }
                    else
                    {
                        // Math for Points
                        decimal final_points = points - n;

                        // Loser, Take X Points
                        twitchSQL.pointsChange(e.Command.ChatMessage.Username, final_points);

                        // Num is Even
                        return "Oh no, you gambled " + n + " points and now have " + final_points + " point(s)";
                    }
                }
                else
                {
                    return "The value given was not a number";
                }

            }

                return null;
        }

    }
}
