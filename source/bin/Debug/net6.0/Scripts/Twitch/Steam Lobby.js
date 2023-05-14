///////////////////////////////////////////////////////////////////
//   PLUGIN BEGINS -- HAVE FUN AND MAKE SOMETHING REALLY COOL~   //
///////////////////////////////////////////////////////////////////

// Put your Steam API key and ID here
let steam_key = "";
let user_id = "";

// Request the API
let request = WebRequest.Create('https://api.steampowered.com/ISteamUser/GetPlayerSummaries/v2/?key='+ steam_key +'&format=json&steamids=' + user_id);  
let response = request.GetResponse();

// Read the data and store as a string
let reader = new StreamReader(response.GetResponseStream());
var str = reader.ReadLine();

// Turn into a usable JSON string
var steam = jsonConvert.DeserializeObject(str);

// Check for the existance of a game being played
if (!steam.response.players[0].gameid) {
    twitchClient.SendMessage(twitchChannel, "No active game");
} else {
    twitchClient.SendMessage(twitchChannel, "steam://joinlobby/" + steam.response.players[0].gameid + "/"
     + steam.response.players[0].lobbysteamid + "/" + steam.response.players[0].steamid); // Send a message to Twitch
}