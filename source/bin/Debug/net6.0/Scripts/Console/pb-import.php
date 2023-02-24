<?php
// If not in cli context, stop
if (PHP_SAPI != "cli") die();

$foxxibot_db = null;
$phantombot_db = null;

echo "Before continuing to run this script, stop FoxxiBot.\nEnter Y to confirm: ";
$check = readline();

if (!isset($check) || strtolower($check) !== "y") die("Aborting...");

// Check if this script was called with arguments
if (isset($argc) && $argc > 0) {
    // If we don't have at least 1 argument, ask the user for Foxxibot DB location
    if (!isset($argv[1])) {
        echo "Location to FoxxiBot bot.db file:\n";
        $foxxibot_db = readline();
    } else { $foxxibot_db = $argv[1]; }

    // If we don't have at least 2 arguments, ask the user for Foxxibot DB location
    if (!isset($argv[2])) {
        echo "Location to PhantomBot phantombot.db file:\n";
        $phantombot_db = readline();
    } else { $phantombot_db = $argv[2]; }

    // Verify string length & convert relative to absolute paths (for sqlite3), otherwise use default locations
    $foxxibot_db = (strlen($foxxibot_db)) ? realpath($foxxibot_db) : __DIR__."/Data/bot.db";
    $phantombot_db = (strlen($phantombot_db)) ? realpath($phantombot_db) : __DIR__."/Data/phantombot.db";

    // Check whether the files exist, because if we create a PDO instance of a nonexistent sqlite3 file, sqlite3 just creates an empty one
    if (!file_exists($foxxibot_db)) die("Cannot find FoxxiBot bot.db. Specify a correct location or make sure it's in the Data folder.");
    if (!file_exists($phantombot_db)) die("Cannot find PhantomBot phantombot.db. Specify a correct location or make sure it's in the Data folder.");

    try {
        // Open FoxxiBot Database file
        $PDO = new PDO('sqlite:'.$foxxibot_db);
        $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Attach PhantomBot Database file
        $PDO->exec('ATTACH \''.$phantombot_db.'\' as phantombot');

        // Copy over points, if that user exists, sum FoxxiBot and PhantomBot points for them
        $stmt = $PDO->prepare("INSERT OR IGNORE INTO main.gb_points (username, value)
                                     SELECT variable, value FROM phantombot.phantombot_points WHERE true
                                     ON CONFLICT (username) DO UPDATE SET value = (value + excluded.value)");
        $stmt->execute();
        die("Points imported. Restart FoxxiBot.");

    } catch (PDOException $e) {
        echo "ERROR: " . $e->getMessage()."\n";
        echo "Make sure both bot.db and phantombot.db have data inside them.\n";
    }
} else {
    echo "argc and argv disabled\n";
}
die();