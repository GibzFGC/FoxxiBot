// Set your Plugin info here
plugin_data = {
    "name":"Steam Lobby",
    "command":"lobby",
    "author":"Gibz (https://www.twitter.com/mega_gibz)",
    "date":"1/2/2022",
    "file":"Steam Lobby.js"
};

// SEND TO BOT FOR REGISTRATION, DON'T EDIT!
var plugin_json = jsonConvert.SerializeObject(plugin_data);
var plugin_register = jsonConvert.DeserializeObject((plugin_json));
// SEND TO BOT FOR REGISTRATION, DON'T EDIT!