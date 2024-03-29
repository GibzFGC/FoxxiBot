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

// Define Secure Connection
define("G_FW", true);

// Load the Bootstrap Loader
require_once("modules/bootloader.php");

// I no API Key Given
if (!isset($_REQUEST["key"])) {
    print "No API Key Provided!";
    return;
}

// Check API Key
if (isset($_REQUEST["key"])) {

    if ($_REQUEST["key"] != $bot_obj->APIKey)
    {
        print "The Provided API Key is Wrong!";
        return;
    }

}

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

        // Set Header Type
        header('Content-Type: application/json; charset=UTF-8');

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
            $where_fix = str_replace(":","=", $_REQUEST["where"]);
            $where = "WHERE " . $where_fix;
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

        if (!isset($_REQUEST["table"])) {
            print "Error: Please profile a table to access.";
            return;
        }
        else
        {
            $table = $_REQUEST["table"];
        }     

        if (isset($_REQUEST["column"])) {
            $column = $_REQUEST["column"];
        }

        if (isset($_REQUEST["value"])) {
            $value = $_REQUEST["value"];
        }

        if (isset($_REQUEST["id"])) {
            $id = $_REQUEST["id"];
        }

        if (isset($_REQUEST["position"])) {
            $position = $_REQUEST["position"];
        }

        $statement = $PDO->prepare("UPDATE $table SET $column = :value WHERE $id = :position");
        $statement->bindValue(':value', $value);
        $statement->bindValue(':position', $position);
        $statement->execute();

        // var_dump($statement);
        print "Updated " . $table . " Column " . $column . " value " . $value;

    }

    if ($_REQUEST["state"] == "delete") {

        if (!isset($_REQUEST["table"])) {
            print "Error: Please profile a table to access.";
            return;
        }
        else
        {
            $table = $_REQUEST["table"];
        }

        if (isset($_REQUEST["column"])) {
            $column = $_REQUEST["column"];
        }

        if (isset($_REQUEST["value"])) {
            $value = $_REQUEST["value"];
        }

        $statement = $PDO->prepare("DELETE FROM $table WHERE $column = :value");
        $statement->bindValue(':value', $value);
        $statement->execute();

        // var_dump($statement);
        print "Deleted " . $table . " Column " . $column . " value " . $value;
    }

} else {
    print "Error: No valid state given";
}
?>