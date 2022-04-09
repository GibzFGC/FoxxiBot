using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace FoxxiBot.TwitchBot
{
    internal class Twitch_Games
    {

        string cs = @"URI=file:" + AppDomain.CurrentDomain.BaseDirectory + "\\Data\\bot.db";
        SQLite.twitchSQL twitchSQL = new SQLite.twitchSQL();

        public string commandDuel(TwitchLib.Client.Events.OnChatCommandReceivedArgs e)
        {

            // Check if game is active
            if (twitchSQL.getGameOptions("game_duel") == "on")
            {

                if (e.Command.ArgumentsAsList.Count == 0)
                {

                }

                if (e.Command.ArgumentsAsList.Count == 1 && e.Command.ArgumentsAsString != "cancel")
                {

                }

                if (e.Command.ArgumentsAsString == "cancel")
                {

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
