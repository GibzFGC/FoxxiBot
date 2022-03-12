<!-- Don't edit the following file if you don't know what you're doing! -->

<?php
// Copyright (C) 2020-2022 FoxxiBot
// This program is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
// You should have received a copy of the GNU General Public License
// along with this program.  If not, see <http://www.gnu.org/licenses/>.

// Set Header Type
header('Content-Type: application/json; charset=UTF-8');

// Define Secure Connection
define("G_FW", true);

// Load the Bootstrap Loader
require_once("modules/bootloader.php");

// Connect to the SQLite Database
try {
    $PDO = new PDO('sqlite:../Data/bot.db');
}

catch (PDOException $e) {
    echo "ERROR: " . $e->getMessage();
}

// Begin API Constructor
if (isset($_REQUEST["state"])) {

    if ($_REQUEST["state"] == "get") {

        $select = "*";
        $table = null;
        $where = null;
        $order = null;
        $order_state = null;
        $limit = null;

        if (!isset($_REQUEST["select"])) {
            $select = "SELECT *";
        } else {
            $select = "SELECT " . $_REQUEST["select"];
        }

        if (!isset($_REQUEST["table"])) {
            print "Error: Please profile a table to access.";
            return;
        }
        else
        {
            $table = "FROM " . $_REQUEST["table"];
        }

        if (isset($_REQUEST["where"])) {
            $where = "WHERE " . $_REQUEST["select"];
        }

        if (isset($_REQUEST["order"])) {
            $order = "ORDER BY" . $_REQUEST["order"];
        }

        if (isset($_REQUEST["order_state"])) {
            $order_state = $_REQUEST["order_state"];
        }        

        if (isset($_REQUEST["limit"])) {
            $limit = "LIMIT " . $_REQUEST["limit"];
        }

        // Example: http://localhost:25000/api.php?state=get&table=gb_discord_channels&limit=1        
        $statement = $PDO->prepare("$select $table $where $order $order_state $limit");
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);

        // var_dump($statement);
        print $json;
    }

    if ($_REQUEST["state"] == "send") {

    }

    if ($_REQUEST["state"] == "delete") {

    }

} else {
    print "Error: No valid state given";
}
?>