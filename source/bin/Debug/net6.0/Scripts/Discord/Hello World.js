///////////////////////////////////////////////////////////////////
//   PLUGIN BEGINS -- HAVE FUN AND MAKE SOMETHING REALLY COOL~   //
///////////////////////////////////////////////////////////////////

// Get Sent Data
let command = botCommand.Content; // The returned command from Discord Chat
const splitArgs = command.split(" "); // Split into Arguments - e.g. splitArgs[0] for first value

// This will send a normal version
discordContext.Channel.SendMessageAsync("Hello World!");