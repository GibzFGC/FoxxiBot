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
    class twitchSQL
    {
        string cs = @"URI=file:" + AppDomain.CurrentDomain.BaseDirectory + "\\Data\\bot.db";

        public void SetOption (string parameter, string value)
        {
            using var con = new SQLiteConnection(cs);
            con.Open();

            using var cmd = new SQLiteCommand(con);

            cmd.CommandText = "INSERT or REPLACE INTO gb_options(parameter, value) VALUES (@parameter, @value)";

            cmd.Parameters.AddWithValue("@parameter", parameter);
            cmd.Parameters.AddWithValue("@value", value);

            cmd.Prepare();
            cmd.ExecuteNonQuery();

            con.Close();

        }

        public void saveEvent(string type, string user, string viewers)
        {
            using var con = new SQLiteConnection(cs);

            con.Open();
            using var insertCmd = new SQLiteCommand(con);

            insertCmd.CommandText = "INSERT INTO gb_twitch_events(type, user, viewers) VALUES (@type, @user, @viewers)";
            insertCmd.Parameters.AddWithValue("@type", type);
            insertCmd.Parameters.AddWithValue("@user", user);
            insertCmd.Parameters.AddWithValue("@viewers", viewers);

            insertCmd.Prepare();
            insertCmd.ExecuteNonQuery();

            con.Close();
        }

        public void saveNotification(string type, string user, string viewers, string datetime)
        {
            using var con = new SQLiteConnection(cs);

            con.Open();
            using var insertCmd = new SQLiteCommand(con);

            insertCmd.CommandText = "INSERT INTO gb_twitch_notifications(type, user, viewers, date) VALUES (@type, @user, @viewers, @date)";

            insertCmd.Parameters.AddWithValue("@type", type);
            insertCmd.Parameters.AddWithValue("@user", user);
            insertCmd.Parameters.AddWithValue("@viewers", viewers);
            insertCmd.Parameters.AddWithValue("@date", datetime);

            insertCmd.Prepare();
            insertCmd.ExecuteNonQuery();

            con.Close();
        }

    }
}
