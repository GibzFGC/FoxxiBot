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

namespace FoxxiBot.TwitchBot
{
    internal class Twitch_Games
    {

        string cs = @"URI=file:" + AppDomain.CurrentDomain.BaseDirectory + "/Data/bot.db";
        SQLite.twitchSQL twitchSQL = new SQLite.twitchSQL();

        public string commandDuel(TwitchLib.Client.Events.OnChatCommandReceivedArgs e)
        {

            // Check if game is active
            if (twitchSQL.getGameOptions("game_duel") == "on")
            {

                if (e.Command.ArgumentsAsList.Count == 0)
                {

                    // Does a Duel Exist?
                    using var con = new SQLiteConnection(cs);
                    con.Open();

                    string stm = "SELECT * FROM gb_game_duel WHERE recipient = '" + e.Command.ChatMessage.DisplayName + "' LIMIT 1";

                    using var cmd = new SQLiteCommand(stm, con);
                    using SQLiteDataReader rdr = cmd.ExecuteReader();

                    if (rdr.HasRows == true)
                    {

                        while (rdr.Read())
                        {

                            // Define Fighters
                            string fighter_1 = (string)rdr["sender"];
                            string fighter_2 = (string)rdr["recipient"];

                            // Store Winner & Loser
                            string winner = "";
                            string loser = "";

                            // Lets do some RNG
                            var seed = (int)DateTime.Now.Ticks;
                            var random = new Random(seed);

                            var rand_value = random.Next(10);

                            if (rand_value % 2 == 0)
                            {
                                winner = fighter_2;
                                loser = fighter_1;
                            }
                            else
                            {
                                winner = fighter_1;
                                loser = fighter_2;
                            }

                            // A array of stating points  
                            string[] start_duel = {
                                "In the Grand Halls of History, " + (string)rdr["sender"] + " and " + (string)rdr["recipient"] + " are preparing to face off to the death!",
                                "As the wheel of fate is turning, " + (string)rdr["sender"] + " and " + (string)rdr["recipient"] + " face off -- REBEL 1... ACTION!",
                                "This is a kingdoms junction, please tell me your select! " + (string)rdr["sender"] + " vs " + (string)rdr["recipient"] + " fight!",
                                "Get ready for the next battle! It's " + (string)rdr["sender"] + " vs " + (string)rdr["recipient"] + "!",
                                "It's the time for retribution, battle 1... DECIDE THE DESTINY!",
                                "1st clause... DIVIDE! " + (string)rdr["sender"] + " vs " + (string)rdr["recipient"] + "!",
                                "Choose your envoy of hope -- " + (string)rdr["sender"] + " vs " + (string)rdr["recipient"] + "!",
                                "As the clock strikes noon, two enter. " + (string)rdr["sender"] + " and " + (string)rdr["recipient"] + " have arrived!",
                                "Heaven or Hell... DUEL 1 -- LET'S ROCK! " + (string)rdr["sender"] + " vs " + (string)rdr["recipient"] + "!",
                            };

                            string[] mid_duel = {
                                "The battle is fierce, neither side looking to give leeway and each opponent prepared to give thier lives for the battle!",
                                "As spectators look on in stages of awe and terror -- both combatants clash weapons as the steel and metal clang in a symphony of destruction!",
                                "The battle has been wrought with losses, the armies of " + loser + " have fallen. " + loser + " is the only one left standing. Weapon in hand, they prepare to lay it all on the line!",
                                "Back to back, they walk three paces",
                                "The toll is large but both fight to the bitter end. " + winner + " looks badly beaten whilst " + loser + "lays quiet on the floor...",
                            };

                            string[] end_duel = {
                                "Both fighters fought valiantly but in the end, only one remains standing and the victor is " + winner + "!",
                                "Worn and tired, a victor has been chosen. While " + loser + " fought well, they were no match for " + winner + "!",
                                "Like a flash of lightning, both draw but one falls... " + winner + " is the victor!",
                                "Two entered, one left. Victory to " + winner + "! Glory to their name!",
                                "Welcome back to the stange of History... " + winner + "!",
                                winner.ToUpper() + " WINS !",
                            };

                            // Select Story Elements (Random)
                            Random rand = new Random();

                            // Generate a random index less than the size of the array.
                            int match_start = rand.Next(start_duel.Length);
                            int match_mid = rand.Next(mid_duel.Length);
                            int match_end = rand.Next(end_duel.Length);

                            // Delete this Duel
                            using var deleteDuelCmd = new SQLiteCommand(con);
                            deleteDuelCmd.CommandText = "DELETE FROM gb_game_duel WHERE sender = @sender";
                            deleteDuelCmd.Parameters.AddWithValue("@sender", fighter_1);

                            deleteDuelCmd.Prepare();
                            deleteDuelCmd.ExecuteNonQuery();

                            // Return fight results!
                            return start_duel[match_start] + " " + mid_duel[match_mid] + " " + end_duel[match_end];

                        }

                    }
                    else
                    {
                        return e.Command.ChatMessage.DisplayName + ", you currently are not locked in battle!";
                    }


                }

                if (e.Command.ArgumentsAsList.Count == 1 && e.Command.ArgumentsAsString != "cancel")
                {

                    // Challenging Self!?!!
                    if (e.Command.ChatMessage.DisplayName == e.Command.ArgumentsAsString.Replace("@", "").ToString())
                    {
                        return e.Command.ChatMessage.DisplayName + ", you can't fight yourself!";
                    }

                    // Does a Duel Exist?
                    using var con = new SQLiteConnection(cs);
                    con.Open();

                    string stm = "SELECT * FROM gb_game_duel WHERE sender = '" + e.Command.ChatMessage.DisplayName + "'";

                    using var cmd = new SQLiteCommand(stm, con);
                    using SQLiteDataReader rdr = cmd.ExecuteReader();

                    if (rdr.HasRows == true)
                    {

                        string old_duel_recipient = "";

                        while (rdr.Read())
                        {
                            // Set old Recipient
                            old_duel_recipient = (string)rdr["recipient"];

                            // Delete old Duel
                            using var deleteDuelCmd = new SQLiteCommand(con);
                            deleteDuelCmd.CommandText = "DELETE FROM gb_game_duel WHERE sender = @sender";
                            deleteDuelCmd.Parameters.AddWithValue("@sender", e.Command.ChatMessage.DisplayName);

                            deleteDuelCmd.Prepare();
                            deleteDuelCmd.ExecuteNonQuery();

                            // Create new Duel
                            using var createDuelCmd = new SQLiteCommand(con);
                            createDuelCmd.CommandText = "INSERT INTO gb_game_duel (sender, recipient) VALUES (@sender, @recipient)";

                            createDuelCmd.Parameters.AddWithValue("@sender", e.Command.ChatMessage.DisplayName);
                            createDuelCmd.Parameters.AddWithValue("@recipient", e.Command.ArgumentsAsString.Replace("@", ""));

                            createDuelCmd.Prepare();
                            createDuelCmd.ExecuteNonQuery();

                        }

                        con.Close();
                        return e.Command.ChatMessage.DisplayName + ", your existing duel with " + old_duel_recipient + " has been cancelled. A new one has started with " + e.Command.ArgumentsAsString + "! opponent must type !duel to accept";

                    }
                    else
                    {

                        // Create a Duel
                        using var createDuelCmd = new SQLiteCommand(con);
                        createDuelCmd.CommandText = "INSERT INTO gb_game_duel (sender, recipient) VALUES (@sender, @recipient)";

                        createDuelCmd.Parameters.AddWithValue("@sender", e.Command.ChatMessage.DisplayName);
                        createDuelCmd.Parameters.AddWithValue("@recipient", e.Command.ArgumentsAsString.Replace("@", ""));

                        createDuelCmd.Prepare();
                        createDuelCmd.ExecuteNonQuery();
                        
                        con.Close();
                        return e.Command.ChatMessage.DisplayName + ", has challenged " + e.Command.ArgumentsAsString + " to a Duel!! Opponent must type !duel to accept";

                    }

                }

                if (e.Command.ArgumentsAsString == "cancel")
                {

                    // Does a Duel Exist?
                    using var con = new SQLiteConnection(cs);
                    con.Open();

                    // Delete old Duel
                    using var deleteDuelCmd = new SQLiteCommand(con);
                    deleteDuelCmd.CommandText = "DELETE FROM gb_game_duel WHERE sender = @sender";
                    deleteDuelCmd.Parameters.AddWithValue("@sender", e.Command.ChatMessage.DisplayName);

                    deleteDuelCmd.Prepare();
                    deleteDuelCmd.ExecuteNonQuery();

                    con.Close();
                    return e.Command.ChatMessage.DisplayName + ", Your duel has been cancelled!";

                }

            }
            else
            {
                return "Duel has been turned off on this channel";
            }

            return null;

        }

    }
}
