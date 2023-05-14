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
using System.Data.SQLite;
using System.Text.RegularExpressions;

namespace FoxxiBot.TwitchBot
{
    internal class Twitch_Moderation
    {

        string cs = @"URI=file:" + AppDomain.CurrentDomain.BaseDirectory + "/Data/bot.db";

        // Check if a message is mostly CAPS
        public bool checkBlacklist(string input)
        {

            // Remove Extra Whitespace
            string q = input;
            string a = String.Join(" ", q.Split(new string[] { " " }, StringSplitOptions.RemoveEmptyEntries));

            var split = a.Split(" ");

            using var con = new SQLiteConnection(cs);
            con.Open();

            foreach (string word in split)
            {
                var stm = $"SELECT item FROM gb_twitch_modlist WHERE item LIKE @word AND allowed='0'";
                using var cmd = new SQLiteCommand(stm, con);
                cmd.Parameters.AddWithValue("@word", word + "%");

                using SQLiteDataReader rdr = cmd.ExecuteReader();

                if (rdr.HasRows == true)
                {
                    return true;
                }
            }

            con.Close();
            return false;
        }

        public bool checkWhitelist(string input)
        {

            var split = input.Split(" ");

            using var con = new SQLiteConnection(cs);
            con.Open();

            foreach (var word in split)
            {
                var stm = $"SELECT item FROM gb_twitch_modlist WHERE item LIKE @word AND allowed='1'";

                using var cmd = new SQLiteCommand(stm, con);
                cmd.Parameters.AddWithValue("@word", word + "%");

                using SQLiteDataReader rdr = cmd.ExecuteReader();

                if (rdr.HasRows == true)
                {
                    return true;
                }
            }

            con.Close();
            return false;
        }

        // Check if a message is mostly CAPS
        public bool checkCaps(string input)
        {
            int count = 0;
            float maxLength = input.Length * 0.3f;

            foreach (char c in input)
            {
                if (char.IsUpper(c))
                {
                    count++;
                }

                if (count >= maxLength)
                {
                    return true;
                }
            }

            return false;
        }

        // Check if a message is mostly Symbols
        public bool checkSymbols(string input)
        {
            string specialChar = @"\|!#$%&/()=?»«@£§€{}.-;'<>_,";

            int count = 0;
            float maxLength = input.Length * 0.3f;

            foreach (var item in specialChar)
            {
                if (input.Contains(item)) count++;
            }

            if (count >= maxLength)
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        // Check if a message has a link
        public bool checkURL(string input)
        {
            Regex UrlMatch = new Regex(@"(?i)(http(s)?:\/\/)?(\w{2,25}\.)+\w{3}([a-z0-9\-?=$-_.+!*()]+)(?i)", RegexOptions.Singleline);

            if (UrlMatch.Match(input).Success)
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        // Check if a message has duplicates / spam
        public bool checkSpam(string input)
        {
            Regex UrlMatch = new Regex("(.)(?<=\\1\\1\\1\\1\\1\\1)", RegexOptions.IgnoreCase | RegexOptions.CultureInvariant | RegexOptions.Compiled);

            if (UrlMatch.Match(input).Success)
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        // Check if a message has /me
        public bool checkMe(string input)
        {
            if (input.StartsWith(""))
            {
                return true;
            }

            return false;
        }

        // Check if a message has fake command / system results
        public bool checkSystemMsg(string input)
        {
            if (input.Contains("<message deleted>"))
            {
                return true;
            }

            if (input.Contains("<has been blocked>"))
            {
                return true;
            }

            return false;
        }

    }
}
