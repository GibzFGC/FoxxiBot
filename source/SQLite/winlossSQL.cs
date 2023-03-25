using System;
using System.Data.SQLite;

namespace FoxxiBot.SQLite
{
    internal class winlossSQL
    {

        string cs = @"URI=file:" + AppDomain.CurrentDomain.BaseDirectory + "/Data/bot.db";

        public string getOptions(string parameter)
        {
            using var con = new SQLiteConnection(cs);
            con.Open();
            var stm = $"SELECT value FROM gb_win_loss WHERE parameter='{parameter}' LIMIT 1";

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
