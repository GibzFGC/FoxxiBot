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

// Read Bot JSON / Get Twitch API Data
	$gfw["bot_config"] = file_get_contents("../Data/config.json");
	$bot_obj = json_decode($gfw["bot_config"]);

	$gfw["Twitch_ClientID"] = $bot_obj->TwitchClientID;
	$gfw["Twitch_ClientOAuth"] = $bot_obj->TwitchClientOAuth;
	$gfw["Twitch_BroadcasterId"] = $bot_obj->TwitchBroadcasterId;
	$gfw["Twitch_BroadcasterChannel"] = $bot_obj->TwitchClientChannel;

// Set Website Settings:-
    /* Edit as Needed */
    $gfw['in_development'] = true;																			// Is on a Development Server (TRUE / FALSE)
	$gfw['in_database'] = true; 																			// Use an SQLite Database? (TRUE / FALSE)
    $gfw['site_active'] = true;	    																		// Sets if the website is online for public viewing or not


// Set Website Path, Title and Description:-
    /* (edit these settings as needed) */
	if ($bot_obj->TwitchClientID) {
		$gfw['site_url'] = "http://localhost:" . $bot_obj->WebserverPort;             	      				// Set the url for the website (NO TRAILING SLASH!)
	} else {
		$gfw['site_url'] = "http://localhost:25000";       	      											// Set the url for the website (NO TRAILING SLASH!)
	}

// Advanced Website Settings:-
    /* (please don't edit unless you know what you're doing) */
    $gfw['server_path'] = getcwd();																			// Gets the server path of the website

	$gfw['base_assets'] = "assets";																			// Sets the assets folders name (can be changed but must be fixed in the directory)	
	$gfw['main_dir'] = "main";  					    													// Sets the main content folders name (can be changed but must be fixed in the directory)
	$gfw['template_dir'] = "templates";		    															// Sets the guest / public folders name (can be changed but must be fixed in the directory)
	$gfw['server_dir'] = "server";				    														// Sets the admin / server folders name (can be changed but must be fixed in the directory)

    $gfw['base_admin'] = "system.php";																		// Sets the filename for the admin panel (NO TRAILING SLASH!)
    $gfw['base_admin_folder'] = "system";																	// Sets the folder name for the admin panel

	$gfw['template_path'] = $gfw['site_url'] ."/". $gfw['main_dir'] ."/". $gfw['template_dir'];		        // Sets the path to the public folder (uses parameters above)
	$gfw['server_path'] = $gfw['site_url'] ."/".$gfw['main_dir'] ."/". $gfw['server_dir'];      			// Sets the path to the private folder (uses parameters above)
	$gfw['assets_path'] = $gfw['site_url'] ."/". $gfw['base_assets'];										// Sets the path to the assets folder (uses parameters above)
	
	$gfw['admin_path'] = $gfw['site_url'] ."/". $gfw['base_admin'];											// Sets the path to the admin panel (uses parameters above)
    
// Extra Website Settings
	$gfw['current_year'] = date("Y");																		// Gets the current year from the server
	$gfw['current_version'] = "1.0.1r2";																	// Current Bot Version

// Website Timezone
    date_default_timezone_set('Europe/London');																// Sets the default timezone for your website (change if needed)
    
// Define any custom constant parameters under here:-
    $gfw['base_message'] = "";
    
/* End of file */