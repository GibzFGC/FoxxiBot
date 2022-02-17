// Set your Plugin info here
plugin_data = {
    "name":"Hello World",
    "command":"hw",
    "author":"Gibz (https://www.twitter.com/mega_gibz)",
    "date":"26/1/2022",
    "file":"Hello World.js"
};

// SEND TO BOT FOR REGISTRATION, DON'T EDIT!
var plugin_json = jsonConvert.SerializeObject(plugin_data);
var plugin_register = jsonConvert.DeserializeObject(plugin_json);
// SEND TO BOT FOR REGISTRATION, DON'T EDIT!