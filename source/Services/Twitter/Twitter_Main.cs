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
using System.Diagnostics;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using LinqToTwitter;
using LinqToTwitter.Common;
using LinqToTwitter.OAuth;

namespace FoxxiBot.Services.Twitter
{
    internal class Twitter_Main
    {

        public static TwitterContext twitter;
        SQLite.botSQL botSQL = new SQLite.botSQL();

        public Twitter_Main()
        {

            var auth = new SingleUserAuthorizer
            {
                CredentialStore = new InMemoryCredentialStore()
                {
                    ConsumerKey = botSQL.getOptions("twitter_consumerkey"), // Application API Key
                    ConsumerSecret = botSQL.getOptions("twitter_consumersecret"), // & Application Key Secret
                    OAuthToken = botSQL.getOptions("twitter_usertoken"), // User Access Token
                    OAuthTokenSecret = botSQL.getOptions("twitter_usertokensecret") // User Access Secret
                }
            };

            twitter = new TwitterContext(auth);

        }

        public async Task sendTweet(string status)
        {
            
            // Check if twitter active
            if (botSQL.getOptions("twitter_features") == "on")
            {

                try
                {
                    await twitter.TweetAsync(status);
                    Console.WriteLine(DateTime.Now + ": " + Config.TwitchBotName + $" - A tweet has been sent: " + status);
                }
                catch (Exception e)
                {
                    Console.WriteLine(e.Message);
                }
            
            }

        }

    }
}