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

if ($_REQUEST["v"] == "save") {
    $sql = 'INSERT OR REPLACE INTO gb_win_loss (parameter, value) VALUES (:parameter, :value)' or die(print_r($PDO->errorInfo(), true));

        // Prepare for large data dump
        $PDO->beginTransaction();
    
        // Prepare to Insert Data
        $stmt = $PDO->prepare($sql);

        // Check if value null
        if (!isset($_POST["wins"])) {
            $_POST["wins"] = "0";
        }

        // Insert Table Info
        $stmt->bindValue(':parameter', "wins");
        $stmt->bindValue(':value', $_POST["wins"]);
        $stmt->execute();

        // Check if value null
        if (!isset($_POST["losses"])) {
            $_POST["losses"] = "0";
        }

        $stmt->bindValue(':parameter', "losses");
        $stmt->bindValue(':value', $_POST["losses"]);
        $stmt->execute();

        // Check if value null
        if (!isset($_POST["ratio"])) {
            $_POST["ratio"] = "-";
        }

        $stmt->bindValue(':parameter', "ratio");
        $stmt->bindValue(':value', $_POST["ratio"]);
        $stmt->execute();

        // Commit Data & End Transaction
        $PDO->commit();
}