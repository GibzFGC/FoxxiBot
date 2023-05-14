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

namespace FoxxiBot.SQLite
{
    class pollSQL

    {
        string cs = @"URI=file:" + AppDomain.CurrentDomain.BaseDirectory + "/Data/bot.db";

        public string getOptions(string parameter)
        {
            using var con = new SQLiteConnection(cs);
            con.Open();
            var stm = $"SELECT value FROM gb_polls_options WHERE parameter='{parameter}' LIMIT 1";

            using var cmd = new SQLiteCommand(stm, con);
            using SQLiteDataReader rdr = cmd.ExecuteReader();

            if (rdr.HasRows == true)
            {
                while (rdr.Read())
                {
                    return rdr["value"].ToString();
                }
            }

            con.Close();
            return null;
        }

        public void updateOptions(string parameter, string value)
        {
            using var con = new SQLiteConnection(cs);
            con.Open();

            using var cmd = new SQLiteCommand(con);

            cmd.CommandText = "INSERT or REPLACE INTO gb_polls_options(parameter, value) VALUES (@parameter, @value)";

            cmd.Parameters.AddWithValue("@parameter", parameter);
            cmd.Parameters.AddWithValue("@value", value);

            cmd.Prepare();
            cmd.ExecuteNonQuery();

            con.Close();
        }

        public string pollData(string id)
        {
            using var con = new SQLiteConnection(cs);
            con.Open();
            var stm = $"SELECT * FROM gb_polls WHERE id='{id}' LIMIT 1";

            using var cmd = new SQLiteCommand(stm, con);
            using SQLiteDataReader rdr = cmd.ExecuteReader();

            if (rdr.HasRows == true)
            {
                while (rdr.Read())
                {
                    return "A poll has been started for " + rdr["title"] + ". See on-screen options and !vote";
                }
            }

            con.Close();
            return null;
        }

        public int voteCheck(string displayname, int id)
        {

            int state = -1;

            using var con = new SQLiteConnection(cs);
            con.Open();
            var stm = $"SELECT poll_id, user FROM gb_polls_votes WHERE user='{displayname}' AND poll_id='{id}' LIMIT 1";

            using var cmd = new SQLiteCommand(stm, con);
            using SQLiteDataReader rdr = cmd.ExecuteReader();

            if (rdr.HasRows == true)
            {
                // Vote Already Processed
                state = 1;
            }
            else
            {
                // Not Voted Yet
                state = 0;
            }

            con.Close();
            return state;
        }

    }
}