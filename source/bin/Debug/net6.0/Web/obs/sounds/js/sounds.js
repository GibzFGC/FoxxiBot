var xmlhttp = new XMLHttpRequest();
// String to hold API Key
var apikey;
// Boolean to determine playing state
var isPlaying = false;
// Boolean to determine timer state
var timerPaused = false;
// Boolean to determine update state
var doUpdate = false;

function api_key() {
    let searchParams = new URLSearchParams(window.location.search);
    if (searchParams.has('key')) {
        apikey = searchParams.get("key");
    } else {
        console.log("API Key Error");
        return;
    }
}

function isEmpty(obj) {
    return Object.keys(obj).length === 0;
}

function pollHandler() {
    doUpdate = true;
    if (!isPlaying && doUpdate) {
        console.log("Waiting for a Sound Call");
        loadSounds();
    }
}

function loadSounds() {
     // Load Data
    $.getJSON('/api.php?key='+ apikey +'&state=get&table=gb_sounds_queue&order="id"&order_state=asc&limit=1', function (data) {
        playSoundFromQueue(data);
    });
}

/**
 * Plays first audio file from an array of at least 1 file
 * @param data The Array containing the files
 * @returns boolean
 */
function playSoundFromQueue(data) {
    if (isEmpty(data)) return false;

    timerPaused = true;
    console.log("Received Play Request: " + data[0]["file"]);
    let sound = new Howl({
        src: ["files/" + data[0]["file"]],
        volume: 0.15,
        autoplay: false,
        loop: false,
        onload: function () {
            console.log("Audio loaded: " + data[0]["file"]);
            console.log("Waiting for permission to play audio");
            sound.play();
        },
        onplay: function () {
            console.log("Playing: " + data[0]["file"]);
            deletePlayed(data[0]["id"]);
            isPlaying = true;
        },
        onend: function () {
            console.log("ENDPlay: " + data[0]["file"]);
            isPlaying = false;
            timerPaused = false;
        },
    });

    updateVolume = function(value) {
        console.log('before update volume:', sound.volume());
        sound.volume(value);
        console.log('after update volume:', sound.volume());
    }

    return true;
}

// Perform SQL Delete on Viewed
function deletePlayed(id) {
    $.ajax({
        type: "POST", url: "/api.php?key="+ apikey +"&state=delete&table=gb_sounds_queue&column=id&value=" + id, success: function () {
            console.log("Info: Deleted SQL Row " + id);
        }
    });
}

function init() {
    xmlhttp.overrideMimeType('application/json');

    // Check API Key
    api_key();

    var timeout = this.window.setInterval(function () {
        if (!timerPaused) pollHandler();
    }, 1000);
}