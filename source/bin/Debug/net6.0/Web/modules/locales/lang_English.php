<?php 
define("_MAINTENANCE", "Down for Maintenance");

define("_PAGE_TITLE", "FoxxiBot | Dashboard");
define("_HOME", "Home");
define("_NOTIFICATION", "Notifications");
define("_NOTIFICATION_ALL", "See All Notifications");

define("_BOTNAME", "FoxxiBot");
define("_LOADING", "Loading...");
define("_DASHBOARD", "Dashboard");
define("_MANAGEMENT", "Management");
define("_BROADCASTER", "BROADCASTER");
define("_FOLLOWS", "FOLLOWS");
define("_FOLLOWS_LATEST", "Latest Followers");
define("_VIEWS", "VIEWS");
define("_EVENTS_LATEST", "Latest Events");
define("_WAITING_STREAM", "Waiting for next stream!");
define("_GLOBAL_FEAT", "GLOBAL FEATURES");
define("_OTHER_SERVICE", "OTHER SERVICES");

define("_TWITCH_SETTINGS", "Twitch Settings");
define("_TWITCH_SETTINGS_MAIN", "Main Twitch Bot Settings");
define("_TWITCH_SETTINGS_PARTNER", "I'm an Affiliate / Partner");
define("_TWITCH_SETTINGS_BOT_CHANNEL", "Bot Message on Join Channel");
define("_TWITCH_SETTINGS_BOT_CHANNEL_MSG", "Enter your Bot Message used when it joins your channel");
define("_TWITCH_SETTINGS_STREAM", "Stream Messages");
define("_TWITCH_SETTINGS_STREAM_FOLLOW", "Twitch Follow Message");
define("_TWITCH_SETTINGS_STREAM_FOLLOW_PLACE", "Enter your Twitch Follow Message");
define("_TWITCH_SETTINGS_STREAM_RAID", "Twitch Raid Message");
define("_TWITCH_SETTINGS_STREAM_RAID_PLACE", "Enter your Twitch Raid Message");
define("_TWITCH_SETTINGS_STREAM_SUB", "Twitch Subscription Message");
define("_TWITCH_SETTINGS_STREAM_SUB_PLACE", "Enter your Twitch Subcriber Message");
define("_TWITCH_SETTINGS_STREAM_PRIMESUB", "Twitch Prime Subscription Message");
define("_TWITCH_SETTINGS_STREAM_PRIMESUB_PLACE", "Enter your Twitch Prime Subcriber Message");
define("_TWITCH_SETTINGS_INFO", "These settings make the bot more personal to your Twitch channel.");

define("_TWITCH_FEAT", "TWITCH FEATURES");
define("_TWITCH_DATA", "Twitch Data");
define("_TWITCH_DATA_DELAY", "(There might be a slight delay...)");

define("_TWITCH_CMDS", "Twitch Commands");
define("_TWITCH_ADD_CMD", "Add a Command");
define("_TWITCH_CMD_INFO", "Command Information");
define("_TWITCH_CMD_NAME", "Name (without !)");
define("_TWITCH_CMD_NAME_PLACE", "Enter Command Name");
define("_TWITCH_CMD_RESPONSE", "Enter the response text here...");
define("_TWITCH_CMD_USEFUL_VARS", "Useful Variables");
define("_TWITCH_CMD_VARS_INFO", "Here is a list of internal variables:<br /><br />
{1} - A custom argument for whatever you want<br />
{2} - A custom argument for whatever you want (only works if the first is set)<br />
{dice} - rolls a dice and returns a random value<br />
{follows} - returns the amount of followers on your channel<br />
{game} - returns the currently played game<br />
{points} - returns the current points for the user<br />
{points_name} - returns the current points name in the bot<br />
{sender} - returns the command users display name<br />
{title} - returns the current stream title<br />
{uptime} - returns the live stream time of your channel<br />
{user} - returns the targeted user in the message<br />
{views} - returns the overall views of your channel");
define("_TWITCH_CMD_EDIT", "Editing a Command");
define("_TWITCH_CMD_MNGMNT", "Twitch Commands Management");
define("_TWITCH_CMD_YOURS", "Here are your Twitch Commands.");

define("_TWITCH_MODERATION", "Twitch Moderation");
define("_TWITCH_MODERATION_EXPL", "Below you can manage how the bot will handle Twitch Moderation");
define("_TWITCH_MODERATION_BL", "Blacklist Words / URLs");
define("_TWITCH_MODERATOIN_BL_FEAT", "This feature will take the words you've put into the blacklist and remove them from messages.");
define("_TWITCH_MODERATION_WL", "Whitelist Words / URLs");
define("_TWITCH_MODERATOIN_WL_FEAT", "This feature will take the words or links you've put into the whitelist and make sure they're sent.");
define("_TWITCH_MODERATION_FILTER", "Link Filter");
define("_TWITCH_MODERATION_FILTER_FEAT", "Link filtering will stop web links from being posted in your Twitch chat. (unless whitelisted)");
define("_TWITCH_MODERATION_CAPS", "Caps Filter");
define("_TWITCH_MODERATION_CAPS_FEAT", "Will prevent messages from being posted if they're mostly capital letters.");
define("_TWITCH_MODERATION_SYMBOLS", "Symbols Filter");
define("_TWITCH_MODERATION_SYMBOLS_FEAT", "Will prevent messages from being posted if they're mostly symbols.");
define("_TWITCH_MODERATION_SPAM", "Spam Filter");
define("_TWITCH_MODERATION_SPAM_FEAT", "Attempt to prevent messages that comtain a lot of spam.");
define("_TWITCH_MODERATION_ME", "/me Filter");
define("_TWITCH_MODERATION_ME_FEAT", "Prevents use of the /me function on Twitch in chat messages.");
define("_TWITCH_MODERATION_PURGE", "Purge Fake System Messages");
define("_TWITCH_MODERATION_PURGE_FEAT", "This will prevent people from sending messages like <code>&lt;message deleted&gt;</code>.");
define("_TWITCH_MODERATION_SUBMIT", "Make sure to save your settings!");

define("_AUDIO", "Audio / Sounds");
define("_AUDIO_ADD", "Add an Audio / Sound");
define("_AUDIO_ADD_PAGE", "Adding a Audio / Sound");
define("_AUDIO_EDIT", "Editing a Audio / Sound");
define("_AUDIO_MANAGEMENT", "Audio / Sound Management");
define("_AUDIO_CLIPS", "Here are your Audio / Sound Clips");
define("_AUDIO_NAME", "Enter Sound Name");
define("_AUDIO_UPLOAD", "Sound Upload");
define("_AUDIO_CREATE", "Create Sound");
define("_AUDIO_FILE", "Local Sound File");
define("_AUDIO_UPDATE", "Update Sound");
define("_AUDIO_INFO", "Audio / Sound Information");
define("_AUDIO_INFO_TEXT", "You can add sounds, music or any other audio with the bot if you add a file. It can be accessed by using the \"!sound name\" function.<br /><br />
When using this fuction, please be aware of copyright and know that any files you use must either be owned by you, you have permission to use them or
some other agreement.<br /><br />
This is to prevent you from getting Twitch Copyright Claimed or worse from rights holders.<br /><br />
This module supports most major audio formats through the stream browser source widget in \"obs/sounds\". Information @ <a target=\"_blank\" href=\"https://github.com/goldfire/howler.js#format-recommendations\">Howler</a>");

define("_GIVEAWAY", "Giveaway");
define("_GIVEAWAY_MNGMNT", "Giveaway Management");
define("_GIVEAWAY_INFO", "Here is Giveaway Information.");
define("_GIVEAWAY_DETAILS", "Giveaway Details");
define("_GIVEAWAY_NAME", "Giveaway Name");
define("_GIVEAWAY_PLACE_ENTER", "Giveaway Name");
define("_GIVEAWAY_PLACE_INFO", "Ex. Want to win a bla, then type !giveaway to be added to the draw");
define("_GIVEAWAY_CLEAR", "Are you sure you want to clear all data, including giveaway participants?");
define("_GIVEAWAY_OPTIONS", "Giveaway Options");
define("_GIVEAWAY_OPTIONS_STAFF", "Allow Twitch Staff to Join Giveaway?");
define("_GIVEAWAY_OPTIONS_MODS", "Allow Mods to Join Giveaway?");
define("_GIVEAWAY_RESULTS", "Giveaway Results");
define("_GIVEAWAY_PARTICIPANTS", "Participants");
define("_GIVEAWAY_NO_WINNER", "No giveaway winner yet");

define("_NOTIFICATION_MNGMNT", "Notifications Management");
define("_NOTIFICATION_LATEST", "Here are your latest Twitch Notifications.");

define("_MODERATION", "Moderation");
define("_MODERATION_WL_BL", "Whitelist / Blacklist");
define("_MODERATION_SETTINGS", "Moderation Settings");
define("_MODERATION_MNGMNT", "Whitelist / Blacklist Management");
define("_MODERATION_DEFINITION", "Add a New Definition");
define("_MODERATION_STRING", "Word / Text String");
define("_MODERATION_STRING_PLACE", "Enter a Word or String here");
define("_MODERATION_LIST", "Select a List");
define("_MODERATION_ADD", "Add to...");
define("_MODERATION_ADD_LIST", "Add to List");

define("_TICKER", "Ticker");
define("_TICKER_ADD", "Add a Tick");
define("_TICKER_ADDING", "Adding a Ticker");
define("_TICKER_INFO", "Ticker Information");
define("_TICKER_NAME", "Name");
define("_TICKER_NAME_PLACE", "Enter Ticker Name");
define("_TICKER_RESPONSE", "Response");
define("_TICKER_RESPONSE_PLACE", "Enter the response text here...");
define("_TICKER_CREATE", "Create Ticker");
define("_TICKER_USEFUL", "Useful Information");
define("_TICKER_USEFUL_TEXT", "Tickers are for showing information in a consice box that scrolls with information you set.
<br /><br />
This could be useful for showing social media info, events / meet-ups / game announcement, etc.
<br /><br />
You can also set which are active at any time, meaning they can be re-used or recycled (edited).");
define("_TICKER_EDIT", "Editing a Ticker");
define("_TICKER_MNGMNT", "Ticker Management");
define("_TICKER_UPDATE", "Update Ticker");
define("_TICKER_YOURS", "Here are your Tickers.");

define("_TIMERS", "Timers");
define("_TIMERS_ADD", "Add a Timer");
define("_TIMERS_ADDING", "Adding a Timer");
define("_TIMERS_INFO", "Timer Information");
define("_TIMERS_NAME_PLACE", "Enter Timer Name");
define("_TIMERS_RESPONSE_PLACE", "Enter the response text here...");
define("_TIMERS_CREATE", "Create Timer");
define("_TIMERS_USEFUL", "Useful Information");
define("_TIMERS_USEFUL_TEXT", "Timers are used to show a message every 15 minutes (set to prevent spam). Using these is useful for showing social media
for example.
<br /><br />
We don't recommend using too many timers so that you don't over-bombard your viewers as they can chase them off.");
define("_TIMERS_EDIT", "Editing a Timer");
define("_TIMERS_UPDATE", "Update Timer");
define("_TIMERS_MNGMNT", "Timers Management");
define("_TIMERS_YOURS", "Here are your Twitch Timers.");

define("_DISCORD_SETTINGS", "Discord Settings");
define("_DISCORD_SETTINGS_MAIN", "Main Discord Bot Settings");
define("_DISCORD_FEAT", "DISCORD FEATURES");
define("_DISCORD_CMDS", "Discord Commands");
define("_DISCORD_ADD_CMD", "Add a Command");
define("_DISCORD_CMD_MNGMT", "Discord Commands Management");
define("_DISCORD_UR_CMDS", "Here are your Discord Commands.");
define("_DISCORD_BOT_CHANNEL", "Set Bot Channel");
define("_DISCORD_LOCK_BOT_CHANNEL", "Lock Bot to the Bot Channel? (Not recommended if you intend to use plugins!)");
define("_DISCORD_JOIN_CHANNEL", "Set Join/Leave Greeting Channel");
define("_DISCORD_GREET_LEAVE", "Use the Greeting / Leaving System?");
define("_DISCORD_AUTO_ROLE", "Set Join Auto-Role");
define("_DISCORD_SET_AUTO_ROLE", "Use the Join Auto-Role?");
define("_DISCORD_STREAM_SETTINGS", "Streaming Settings");
define("_DISCORD_SET_NOTIFY_CHANNEL", "Set the Notification Channel");
define("_DISCORD_NOTIFICATION_SYS", "Use the Stream Notification System?");
define("_DISCORD_OPTIONAL_SETTINGS", "Optional settings for Discord if you plan to use that side of the bot.");
define("_DISCORD_CMD_INFO", "Command Information");
define("_DISCORD_CMD_NAME", "Name (without prefix)");
define("_DISCORD_CMD_ENTER", "Enter Command Name");
define("_DISCORD_CMD_RESPONSE", "Enter the response text here...");
define("_DISCORD_USEFUL_VARS", "Useful Variables");
define("_DISCORD_VARS_INFO", "Here is a list of internal variables:<br /><br />
{1} - A custom argument for whatever you want<br />
{2} - A custom argument for whatever you want (only works if the first is set)<br />
{8ball} - Creates an 8ball with responses<br />
{dice} - rolls a dice and returns a random value<br />
{sender} - returns the command users display name<br />");

define("_PROMO", "Promo / Streamers");
define("_PROMO_MNGMNT", "Discord Promo / Streamer Management");
define("_PROMO_ADDITION", "Quick Promo / Streamer Addition");
define("_PROMO_STREAMER_NAME", "Add a Streamers Twitch username");
define("_PROMO_STREAMER_PLACE", "Enter a Streamers Username here");
define("_PROMO_STREAMER_ADD_BTN", "Add Streamer to Promo");
define("_PROMO_STREAMER_REGISTERED", "Here are the registered Streamers for Promo.");
define("_PROMO_STREAMER_OFFLINE", "Currently Offline");

define("_TWITTER", "Twitter");
define("_TWITTER_GAME_STATUS", "Add a Game Live Status");
define("_TWITTER_STATUS_LIST", "Twitter Status List");
define("_TWITTER_SETTINGS", "Twitter Settings");
define("_TWITTER_LIVE_ADD", "Adding a Twitter Live Status");
define("_TWITTER_TWEET_INFO", "Tweet Information");
define("_TWITTER_GAME_NAME", "Game Name (must match Twitch name)");
define("_TWITTER_GAME_NAME_PLACE", "Enter a Game Title");
define("_TWITTER_CONTENT", "Tweet Contents");
define("_TWITTER_CONTENT_PLACE", "Enter the tweet text here...");
define("_TWITTER_TWEET_CREATE", "Create Tweet");
define("_TWITTER_TWEET_UPDATE", "Update Tweet");
define("_TWITTER_USEFUL_VARS", "Useful Variables");
define("_TWITTER_VARS_INFO", "Here is a list of internal variables:<br /><br />
{link} - returns your Twitch stream url<br />
{game} - returns the currently assigned Twitch game<br />
{title} - returns the current Twitch stream title<br /><br />
More might be added in future, recommend some!");
define("_TWITTER_EDIT_STATUS", "Editing a Twitter Live Status");
define("_TWITTER_STATUS_MNGMNT", "Twitter Status Management");
define("_TWITTER_STATUS_YOURS", "Here are your Twitter Live Statuses.");
define("_TWITTER_FEAT", "Twitter Features");
define("_TWITTER_USERNAME", "Twitter Username");
define("_TWITTER_USERNAME_PLACE", "Enter Your Twitter Username");
define("_TWITTER_ACCESSTOKEN", "User Access Token");
define("_TWITTER_ACCESSTOKEN_PLACE", "Enter Your User Token");
define("_TWITTER_ACCESSSECRET", "User Access Secret");
define("_TWITTER_ACCESSSECRET_PLACE", "Enter Your Application API Key Secret");
define("_TWITTER_APIKEY", "Application API Key");
define("_TWITTER_APIKEY_PLACE", "Enter Your Consumer Key");
define("_TWITTER_APISECRET", "Application API Key Secret");
define("_TWITTER_APISECRET_PLACE", "Enter Your Consumer Secret");
define("_TWITTER_AUTOTWEET", "Live Auto-Tweet");
define("_TWITTER_OPTIONAL", "This is an optional service if you want Twitter functionality.");

define("_COUNTDOWN", "Countdown Timers");
define("_COUNTDOWN_ADD", "Add a Countdown");
define("_COUNTDOWN_MNGMT", "Countdown Management");
define("_COUNTDOWN_HEADING", "Here are your current countdowns");
define("_COUNTDOWN_ADD_TITLE", "Adding a Countdown");
define("_COUNTDOWN_ADD_INFO", "Countdown Information");
define("_COUNTDOWN_FORM_TITLE", "Countdown Title");
define("_COUNTDOWN_FORM_DATETIME", "Date/Time");
define("_COUNTDOWN_SAVE_CMD", "Save Countdown");
define("_COUNTDOWN_EDIT", "Edit a Countdown");
define("_COUNTDOWN_EDIT_TITLE", "Editing a Countdown");

define("_POINTS", "Points");
define("_POINT_RANK", "Point Rankings");
define("_POINT_REDEEM", "Point Redeems");
define("_POINT_COST", "Point Cost");
define("_POINTS_SETTINGS", "Points Settings");
define("_POINTS_USR_MNGMNT", "User Management");
define("_POINTS_FUN_TOOLS", "Fun Tools");
define("_POINTS_MODIFIER", "Set Points to Change (only works for Give to All & Take from All)");
define("_POINTS_RAIN", "Max Points for Make it Rain?");
define("_POINTS_TAKE_ALL", "Take from All");
define("_POINTS_GIVE_ALL", "Give to All");
define("_POINTS_MAKE_RAIN", "Make it Rain!");
define("_POINTS_SETTINGS_MAIN", "Main Points Settings");
define("_POINTS_NAME", "Points Name");
define("_POINTS_NAME_ENTER", "Enter Points Name");
define("_POINTS_SHORT", "Points Short Name");
define("_POINTS_SHORT_ENTER", "Enter Points Short Name");
define("_POINTS_GIVEN", "Points Given Every 5 Mins");
define("_POINTS_GIVEN_VALUE", "Enter Points Value");
define("_POINTS_RANKING", "Points Rankings");
define("_POINTS_RANKING_TITLE", "Here are the current Points Rankings.");
define("_POINTS_REDEEM", "Point Redeems");
define("_POINTS_REDEEM_TITLE", "Here are the recent stream Point Redeems.");
define("_POINTS_REFUNDED", "Refunded");
define("_POINTS_REFUND", "Refund");
define("_POINTS_NOT_PERFORMED", "Not Performed");
define("_POINTS_SET_COMPLETE", "Set as Complete");
define("_POINTS_SET_INCOMPLETE", "Set as Incomplete");
define("_POINTS_CONFIRM", "Are you sure you want to refund this user their points?");
define("_POINTS_COMPLETED", "Completed");

define("_QUOTES", "Quotes");
define("_QUOTES_ADD", "Add a Quote");
define("_QUOTES_ADDING", "Adding a Quote");
define("_QUOTE_INFORMATION", "Quote Information");
define("_QUOTE_NAME_PLACE", "Enter Quote Name");
define("_QUOTE_TEXT_PLACE", "Enter the bot response here...");
define("_QUOTE_SOURCE", "Source");
define("_QUOTE_SOURCE_PLACE", "Enter Quote Source");
define("_QUOTE_CREATE", "Create Quote");
define("_QUOTE_SYSTEM", "Quote System");
define("_QUOTE_SYSTEM_INFO", "The quote system lets you take some of your favourite media (game, movie, etc) quotes or even awesome stream moments and save them as quotes for
people to call upon and see<br /><br />
Viewers will be able to do \"!quote\" for a random one or if you have a name set, it will work like \"!quote name\".<br /><br />
This will work on both Discord and Twitch so make sure to add some awesome stuff!");
define("_QUOTE_EDIT", "Editing a Quote");
define("_QUOTE_UPDATE", "Update Quote");
define("_QUOTE_MNGMNT", "Quotes Management");
define("_QUOTE_YOURS", "Here are your Quotes");

define("_BOT_MANAGEMENT", "BOT MANAGEMENT");
define("_SETTINGS", "Settings");
define("_PLUGINS", "Plugins");
define("_BOT_SETTINGS", "Bot Settings");
define("_BOT_SETTINGS_MAIN", "Main Bot Settings");
define("_BOT_SETTINGS_LANG", "Web Panel Language");
define("_BOT_SETTINGS_DEBUG", "Debug Mode");
define("_BOT_SETTINGS_DEBUG_RESTART", "(requires a restart)");
define("_BOT_SETTINGS_SIDEBAR", "Side Menu Settings");
define("_BOT_SETTINGS_DISCORD_MENU", "Show Discord Menu");
define("_BOT_SETTINGS_TWITCH_MENU", "Show Twitch Menu");
define("_BOT_SETTINGS_TWITTER_MENU", "Show Twitter Menu");
define("_BOT_SETTINGS_TOURN_MENU", "Show Tournament Menu");
define("_BOT_SETTINGS_DISCORD_OPT", "Optional settings for Discord if you plan to use that side of the bot.");

define("_HELP", "HELP & SUPPORT");
define("_VERSION_INFO", "Version Information");

define("_CHAT_WIDGET_TITLE", "FoxxiBot Chat Widget");

define("_ADD", "Add");
define("_EDIT", "Edit");
define("_CLEAR", "Clear");
define("_TAG", "Tag");
define("_COUNTRY", "Country");
define("_CLEAR_DATA", "Clear all Data");
define("_YES", "Yes");
define("_NO", "No");
define("_INFO", "Important Information");
define("_ACTIVE", "Active");
define("_ID", "ID");
define("_NAME", "Name");
define("_AUTHOR", "Author");
define("_FILE", "File");
define("_TYPE", "Type");
define("_RECIPIENT", "Recipient");
define("_STATUS", "Status");
define("_ACTION", "Action");
define("_ACTIONS", "Actions");
define("_PLAY", "Play");
define("_VIEWERS", "Viewer(s)");
define("_VIEWERS_RAID", "Viewers (if raid / host)");
define("_DATE", "Date");
define("_DATE_TIME", "Date / Time");
define("_UPTIME", "Uptime");
define("_TITLE", "Title");
define("_RESPONSE", "Response");
define("_GAME", "Game");
define("_SAVE_SETTINGS", "Save Settings");
define("_SAVE_DATA", "Save Data");
define("_PERMISSION", "Permission");
define("_CMD", "Command");
define("_CMDS", "Commands");
define("_ADD_CMD", "Adding a Command");
define("_CREATE_CMD", "Create Command");
define("_UPDATE", "Update");
define("_UPDATE_CMD", "Update Command");
define("_URL", "URL");
define("_USERID", "User ID");
define("_DISPLAYNAME", "Display Name");
define("_USERNAME", "Username");
define("_SEARCH_USERNAME", "Search a Username");
define("_WHITELIST", "Whitelist");
define("_BLACKLIST", "Blacklist");
define("_ITEM", "Item");
define("_TWEET", "Tweet");
define("_BOT_CONTROLLED", "Bot Controlled");

define("_DELETE_MSG", "Are you sure you want to delete this item?");
define("_DELETE_MSG_FILES", "Are you sure you want to delete this plugin? \\n\\n If so, delete the related files in the plugins folder to prevent re-install on next load!");
define("_DELETE", "Delete");
define("_DELETE_PLUGIN", "Delete Plugin");
define("_DELETE_USER_POINTS", "Are you sure you want to delete this user and their points?");