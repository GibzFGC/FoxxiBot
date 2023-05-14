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

using Jint.Native;
using Newtonsoft.Json.Linq;
using System;
using System.ComponentModel.Design;
using System.Data.Common;
using System.Data.SQLite;
using System.Reflection.Metadata;

namespace FoxxiBot.SQLite
{
    internal class betSQL
    {

        string cs = @"URI=file:" + AppDomain.CurrentDomain.BaseDirectory + "/Data/bot.db";

        public bool betExists(string username)
        {

            using var con = new SQLiteConnection(cs);
            con.Open();
            var stm = $"SELECT username FROM gb_betting WHERE username='{username}' LIMIT 1";

            using var cmd = new SQLiteCommand(stm, con);
            using SQLiteDataReader rdr = cmd.ExecuteReader();

            if (rdr.HasRows == true)
            {
                return true;
            }
            else
            {
                return false;
            }

        }

        public void addABet(string username, string bet_option, string bet_points)
        {
            using var con = new SQLiteConnection(cs);

            con.Open();
            using var cmd = new SQLiteCommand(con);

            cmd.CommandText = "INSERT or REPLACE INTO gb_betting (username, bet_option, bet_points) VALUES (@username, @bet_option, @bet_points)";
            
            cmd.Parameters.AddWithValue("@username", username);
            cmd.Parameters.AddWithValue("@bet_option", bet_option);
            cmd.Parameters.AddWithValue("@bet_points", bet_points);

            cmd.Prepare();
            cmd.ExecuteNonQuery();

            con.Close();
        }

        public void deductVotePoints(string username, string bet_points)
        {
            using var con = new SQLiteConnection(cs);

            con.Open();
            using var updateCmd = new SQLiteCommand(con);

            updateCmd.CommandText = "UPDATE gb_points SET value = value - @value WHERE username = @username";

            updateCmd.Parameters.AddWithValue("@username", username);
            updateCmd.Parameters.AddWithValue("@value", bet_points);

            updateCmd.Prepare();
            updateCmd.ExecuteNonQuery();

            con.Close();
        }

        public void eraseBetList()
        {
            using var con = new SQLiteConnection(cs);

            con.Open();
            using var deleteCmd = new SQLiteCommand(con);

            deleteCmd.CommandText = "DELETE FROM gb_betting";
            deleteCmd.ExecuteNonQuery();

            con.Close();
        }

        public string getOptions(string parameter)
        {
            using var con = new SQLiteConnection(cs);
            con.Open();
            var stm = $"SELECT value FROM gb_betting_options WHERE parameter='{parameter}' LIMIT 1";

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

            cmd.CommandText = "INSERT or REPLACE INTO gb_betting_options (parameter, value) VALUES (@parameter, @value)";

            cmd.Parameters.AddWithValue("@parameter", parameter);
            cmd.Parameters.AddWithValue("@value", value);

            cmd.Prepare();
            cmd.ExecuteNonQuery();

            con.Close();
        }

    }
}