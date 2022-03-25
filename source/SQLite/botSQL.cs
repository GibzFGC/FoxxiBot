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
using System.Data.SQLite;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace FoxxiBot.SQLite
{
    internal class botSQL
    {
        string cs = @"URI=file:" + AppDomain.CurrentDomain.BaseDirectory + "\\Data\\bot.db";

        public void debugMode()
        {
            using var con = new SQLiteConnection(cs);
            con.Open();

            var stm = $"SELECT parameter, value FROM gb_options WHERE parameter='debug'";
            using var cmd = new SQLiteCommand(stm, con);

            using SQLiteDataReader rdr = cmd.ExecuteReader();

            if (rdr.HasRows == true)
            {
                while (rdr.Read())
                {
                    if (rdr["value"].ToString() == "on")
                    {
                        Config.Debug = "true";
                    }
                    else
                    {
                        Config.Debug = "false";
                    }
                }
            }

            con.Close();

            // Save the new JSON Data
            Class.Bot_Functions functions = new Class.Bot_Functions();
            functions.SaveConfig().GetAwaiter().GetResult();
        }

        public string pointOptions(string parameter)
        {
            using var con = new SQLiteConnection(cs);
            con.Open();
            var stm = $"SELECT value FROM gb_points_options WHERE parameter='{parameter}' LIMIT 1";

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

    }
}