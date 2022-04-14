using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using CoreTweet;

namespace FoxxiBot.TwitterIntegration
{
    public class Twitter_Main
    {
        public Tokens tokens { get; private set; }
        public CoreTweet.OAuth.OAuthSession session { get; private set; }
        
        public Twitter_Main()
        {
            authorizeUser();
        }
        private void authorizeUser()
        //authorize user to get tweets/post tweets
        {
            session = CoreTweet.OAuth.Authorize("consumer_key", "consumer_secret"); // todo : get these from main app, interface with sqlite

            System.Diagnostics.Process.Start(session.AuthorizeUri.AbsoluteUri);

            tokens = session.GetTokens("PINCODE"); // todo : figure out scraping this
        }
        private void tweetStreamStart()
        //post twitter status that stream is starting
        //@username is streaming {game name} on {twitch_url}
        {
            string username = "trashcanmagic";
            string game = "Bishoujo Senshi Sailor Moon S: Jougai Rantou!? Shuyaku Soudatsuse"; // todo: these are temps, obviously
            string twitchUrl = string.Format("www.twitch.tv/{0}", username);

            var tweetBody = string.Format("I'm going live on Twitch playing {0}! {1}", game, username);

            var task = tokens.Statuses.Update(tweetBody);

        }

        private void fetchHashtagTweet()
        //get latest n tweets featuring tournament hashtag
        {

        }

    }
}
