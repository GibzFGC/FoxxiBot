///////////////////////////////////////////////////////////////////
//   PLUGIN BEGINS -- HAVE FUN AND MAKE SOMETHING REALLY COOL~   //
///////////////////////////////////////////////////////////////////

// Get Sent Data
let command = botCommand; // The returned command from Twitch Chat
const splitArgs = command.split(" "); // Split into Arguments - e.g. splitArgs[0] for first value

// Send Hello World
twitchClient.SendMessage(twitchChannel, "Hello Nudel!"); // Send a message to Twitch