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
    internal class discordSQL
    {
        string cs = @"URI=file:" + AppDomain.CurrentDomain.BaseDirectory + "/Data/bot.db";

        public string getOptions(string parameter)
        {
            using var con = new SQLiteConnection(cs);
            con.Open();
            var stm = $"SELECT value FROM gb_discord_options WHERE parameter='{parameter}' LIMIT 1";

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

            cmd.CommandText = "INSERT or REPLACE INTO gb_discord_options(parameter, value) VALUES (@parameter, @value)";

            cmd.Parameters.AddWithValue("@parameter", parameter);
            cmd.Parameters.AddWithValue("@value", value);

            cmd.Prepare();
            cmd.ExecuteNonQuery();

            con.Close();
        }

        public void updateStreamer(string username, string live)
        {
            using var con = new SQLiteConnection(cs);
            con.Open();

            using var cmd = new SQLiteCommand(con);

            cmd.CommandText = "INSERT or REPLACE INTO gb_discord_streamers(username, live) VALUES (@username, @live)";

            cmd.Parameters.AddWithValue("@username", username);
            cmd.Parameters.AddWithValue("@live", live);

            cmd.Prepare();
            cmd.ExecuteNonQuery();

            con.Close();
        }

        public Task syncRoles(string id, string name)
        {
            using var con = new SQLiteConnection(cs);

            con.Open();
            using var insertCmd = new SQLiteCommand(con);

            // Table Row Insertion
            insertCmd.CommandText = "INSERT OR IGNORE INTO gb_discord_roles(role_id, role_name) VALUES (@role_id, @role_name)";
            insertCmd.Parameters.AddWithValue("@role_id", id);
            insertCmd.Parameters.AddWithValue("@role_name", name);

            insertCmd.Prepare();
            insertCmd.ExecuteNonQuery();

            con.Close();
            return Task.CompletedTask;
        }

        public Task updateRoles(string old_id, string id, string name)
        {
            using var con = new SQLiteConnection(cs);

            con.Open();
            using var insertCmd = new SQLiteCommand(con);

            insertCmd.CommandText = $"DELETE FROM gb_discord_roles WHERE role_id='{old_id}'";
            insertCmd.ExecuteNonQuery();

            insertCmd.CommandText = "INSERT OR REPLACE INTO gb_discord_roles(role_id, role_name) VALUES (@role_id, @role_name)";
            insertCmd.Parameters.AddWithValue("@role_id", id);
            insertCmd.Parameters.AddWithValue("@role_name", name);

            insertCmd.Prepare();
            insertCmd.ExecuteNonQuery();

            con.Close();
            return Task.CompletedTask;
        }

        public Task deleteRoles(string id)
        {
            using var con = new SQLiteConnection(cs);

            con.Open();
            using var insertCmd = new SQLiteCommand(con);

            insertCmd.CommandText = $"DELETE FROM gb_discord_roles WHERE role_id='{id}'";
            insertCmd.ExecuteNonQuery();

            con.Close();
            return Task.CompletedTask;
        }

        public Task syncChannels(string id, string name, string type)
        {
            using var con = new SQLiteConnection(cs);

            con.Open();
            using var insertCmd = new SQLiteCommand(con);

            insertCmd.CommandText = "INSERT OR IGNORE INTO gb_discord_channels(channel_id, channel_name, channel_type) VALUES (@channel_id, @channel_name, @channel_type)";
            insertCmd.Parameters.AddWithValue("@channel_id", id);
            insertCmd.Parameters.AddWithValue("@channel_name", name);
            insertCmd.Parameters.AddWithValue("@channel_type", type);

            insertCmd.Prepare();
            insertCmd.ExecuteNonQuery();

            con.Close();
            return Task.CompletedTask;
        }

        public Task updateChannels(string old_id, string id, string name)
        {
            using var con = new SQLiteConnection(cs);

            con.Open();
            using var insertCmd = new SQLiteCommand(con);

            insertCmd.CommandText = $"DELETE FROM gb_discord_channels WHERE channel_id='{old_id}'";
            insertCmd.ExecuteNonQuery();

            insertCmd.CommandText = "INSERT OR REPLACE INTO gb_discord_channels(channel_id, channel_name) VALUES (@channel_id, @channel_name)";
            insertCmd.Parameters.AddWithValue("@channel_id", id);
            insertCmd.Parameters.AddWithValue("@channel_name", name);

            insertCmd.Prepare();
            insertCmd.ExecuteNonQuery();

            con.Close();
            return Task.CompletedTask;
        }

        public Task deleteChannels(string id)
        {
            using var con = new SQLiteConnection(cs);

            con.Open();
            using var insertCmd = new SQLiteCommand(con);

            insertCmd.CommandText = $"DELETE FROM gb_discord_channels WHERE channel_id='{id}'";
            insertCmd.ExecuteNonQuery();

            con.Close();
            return Task.CompletedTask;
        }

    }
}
