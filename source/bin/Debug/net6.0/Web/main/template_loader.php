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

if (isset($_REQUEST["s"])) {
    
    if ($_REQUEST["s"] == "phpinfo") {
        phpinfo();
        exit();
    }

}

// Initial Checks
if ($gfw["site_active"] == true) {

    include("modules/locales/lang_".$gfw["bot_language"].".php");
    include("main/templates/top.php");
    include("main/templates/sidebar.php");

	if (isset($_REQUEST["s"])) {
        include("modules/messages.inc.php");
	}

    if (!isset($_REQUEST['p'])) {

        $cpage = "pages/dashboard/dashboard.php";

    } else {

        // Load from Given Variable
        $page_loader = htmlspecialchars(preg_replace('/[^a-zA-Z0-9_ *]/', '', htmlspecialchars($_REQUEST["p"], ENT_QUOTES, 'UTF-8')));

            if ($page_loader == 'audio') {
                $cpage = "pages/audio_loader.php";
            }

            if ($page_loader == 'countdowns') {
                $cpage = "pages/countdowns_loader.php";
            }

            if ($page_loader == 'discord') {
                $cpage = "pages/discord_loader.php";
            }

            if ($page_loader == 'discord_commands') {
                $cpage = "pages/discord_commands_loader.php";
            }

            if ($page_loader == 'giveaway') {
                $cpage = "pages/giveaway_loader.php";
            }

            if ($page_loader == 'points') {
                $cpage = "pages/points_loader.php";
            }

            if ($page_loader == 'options') {
                $cpage = "pages/options_loader.php";
            }            

            if ($page_loader == 'polls') {
                $cpage = "pages/polls_loader.php";
            }

            if ($page_loader == 'promo') {
                $cpage = "pages/promo_loader.php";
            }

            if ($page_loader == 'quotes') {
                $cpage = "pages/quotes_loader.php";
            }

            if ($page_loader == 'twitch') {
                $cpage = "pages/twitch_loader.php";
            }

            if ($page_loader == 'twitch_commands') {
                $cpage = "pages/twitch_commands_loader.php";
            }

            if ($page_loader == 'tournament') {
                $cpage = "pages/tournament_loader.php";
            }

            if ($page_loader == 'notifications') {
                $cpage = "pages/notifications_loader.php";
            }

            if ($page_loader == 'ticker') {
                $cpage = "pages/ticker_loader.php";
            }

            if ($page_loader == 'timers') {
                $cpage = "pages/timers_loader.php";
            }

            if ($page_loader == 'quotes') {
                $cpage = "pages/quotes_loader.php";
            }

            if ($page_loader == 'plugins') {
                $cpage = "pages/plugins_loader.php";
            }

            if ($page_loader == 'win_loss') {
                $cpage = "pages/win_loss_loader.php";
            }

            if ($page_loader == 'version') {
                $cpage = "pages/version_loader.php";
            }

        }

        // Load the Requested Section
        if (file_exists($cpage)) {
            include "$cpage";
        }

    }

    include("main/templates/footer.php");

    if ($gfw["site_active"] == false) {
        print _MAINTENANCE;
    }

/* End of file */