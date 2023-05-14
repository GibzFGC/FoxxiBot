function validityCheck(form) {

    // Check if name is a locked one
    var CommandName = form.commandName.value;

    // List of Bot Controlled Commands
    const bot_controlled = [
        'stop',
        'restart',
        'addcom',
        'editcom',
        'delcom',
        'disconnect',
        'permit',
        'botlist',
        'wl',
        'raid',
        'disconnect',
        'accountage',
        'deaths',
        'followage',
        'gw',
        'giveaway',
        'so',
        'shoutout',
        'sound',
        'audio',
        'play',
        'duel',
        'gamble',
    ];

    // Check if Command Name Reserved
    if (bot_controlled.includes(CommandName)) {
        document.getElementById("commandNameError").innerHTML = "The Command Name given is a reserved one the bot uses <a id='commandNameErrorLink' href='#'><img width='12' height='12' src='main/templates/img/close.png' /></a>";
        
        document.getElementById('commandNameErrorLink').addEventListener('click',function(){
            document.getElementById('commandNameError').style.visibility = "hidden";
        });

        document.getElementById("commandNameError").style.visibility = "visible";
        return false;
    }
}