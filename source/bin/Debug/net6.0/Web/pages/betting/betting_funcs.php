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

    $sql = 'INSERT OR REPLACE INTO gb_betting_options (parameter, value) VALUES (:parameter, :value)' or die(print_r($PDO->errorInfo(), true));
    $stmt = $PDO->prepare($sql);

    // Check if value null
    if (!isset($_POST["betting_active"])) {
        $_POST["betting_active"] = "off";
    }

    $stmt->bindValue(':parameter', "bet_info");
    $stmt->bindValue(':value', $_POST["bettingDetails"]);
    $stmt->execute();

    $stmt->bindValue(':parameter', "bet_option_1");
    $stmt->bindValue(':value', $_POST["bettingOption1"]);
    $stmt->execute();
    
    $stmt->bindValue(':parameter', "bet_option_2");
    $stmt->bindValue(':value', $_POST["bettingOption2"]);
    $stmt->execute();

    $stmt->bindValue(':parameter', "bet_win_percentage");
    $stmt->bindValue(':value', $_POST["bettingPercentage"]);
    $stmt->execute();

    $stmt->bindValue(':parameter', "bet_winner");
    $stmt->bindValue(':value', 0);
    $stmt->execute();

    // Redirect
    $URL="$gfw[site_url]/index.php?p=betting&s=success";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';

}

if ($_REQUEST["v"] == "clear") {



}