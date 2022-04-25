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

namespace FoxxiBot.Settings
{
    public class Settings
    {
        // Bot Specifics
        public string Debug { get; set; }
        public string WebserverIP { get; set; }
        public string WebserverPort { get; set; }

        // Bot & Twitch Main Settings
        public string BotName { get; set; }
        public string TwitchClientID { get; set; }
        public string TwitchClientSecret { get; set; }
        public string TwitchClientRedirect { get; set; }
        public string TwitchClientChannel{ get; set; }

        // Twitch Bot Account Info
        public string TwitchClientUser { get; set; }
        public string TwitchClientOAuth { get; set; }
        public string TwitchClientRefresh { get; set; }
        public string TwitchClientDisplayName { get; set; }

        //Broadcaster Settings
        public string TwitchBroadcasterId { get; set; }
        public string TwitchBroadcasterOAuth { get; set; }
        public string TwitchBroadcasterRefresh { get; set; }
        public string TwitchBroadcasterDisplayName { get; set; }

        // Discord Settings
        public string DiscordServerId { get; set; }
        public string DiscordToken { get; set; }
        public string DiscordPrefix { get; set; }

        public string BotLang { get; set; }
    }
}
