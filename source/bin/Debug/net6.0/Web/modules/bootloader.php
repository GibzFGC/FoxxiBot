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

// Check for Secure Connection
if (!defined("G_FW") or !constant("G_FW")) die("Direct access not allowed!");

// Load the Settings, Options & Constants File
require_once("settings.inc.php");

// Load the Website Constants File
require_once("constants.inc.php");

// Load the Website Function File
require_once("functions.inc.php");

// Load the Commands Filter File
require_once("commands_filter.inc.php");

// Check if Website is in Development or Not:
/* Set via settings.inc.php */
if ($gfw["in_development"] == true) {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
 } else {
    ini_set('display_errors', '0');
}

// Check for Database Usage (MYSQL Supported):
/* Set options and settings in settings.inc.php */
if ($gfw["in_database"] == true) {
    try {
        $PDO = new PDO('sqlite:../Data/bot.db');
    }

    catch (PDOException $e) {
        echo "ERROR: " . $e->getMessage();
    }
}

/* End of file */