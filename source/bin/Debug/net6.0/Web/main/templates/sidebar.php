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
?>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php print $gfw['site_url']; ?>" class="brand-link">
      <img src="<?php print $gfw['template_path']; ?>/img/FoxxiBot.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">FoxxiBot</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        <a target="_blank" href="https://www.twitch.tv/<?php print $gfw["Twitch_BroadcasterChannel"]; ?>">
          <img id="twitch_profile_sidebar" src="<?php print $gfw['template_path']; ?>/img/default_profile.png" class="img-circle elevation-2" alt="User Image">
        </a>
        </div>
        <div class="info">
          <a id="twitch_profile_name" target="_blank" href="https://www.twitch.tv/<?php print $gfw["Twitch_BroadcasterChannel"]; ?>" class="d-block">
          Loading...
          </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
            <a href="<?php print $gfw['site_url']; ?>" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php print $gfw["site_url"]; ?>/index.php?p=notifications" class="nav-link">
              <i class="nav-icon fas fa-bell"></i>
              <p>
                Notifications
              </p>
            </a>
          </li>

          <li class="li_header">TWITCH FEATURES</li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-terminal"></i>
              <p>
                Twitch Commands
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="<?php print $gfw["site_url"]; ?>/index.php?p=twitch_commands&a=add" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add a Command</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php print $gfw["site_url"]; ?>/index.php?p=twitch_commands" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Management</p>
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-play"></i>
              <p>
                Audio / Sounds
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="<?php print $gfw["site_url"]; ?>/index.php?p=audio&a=add" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add an Audio / Sound</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php print $gfw["site_url"]; ?>/index.php?p=audio" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Management</p>
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chalkboard"></i>
              <p>
                Ticker
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="<?php print $gfw["site_url"]; ?>/index.php?p=ticker&a=add" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add a Tick</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php print $gfw["site_url"]; ?>/index.php?p=ticker" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Management</p>
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-clock"></i>
              <p>
                Timers
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="<?php print $gfw["site_url"]; ?>/index.php?p=timers&a=add" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add a Timer</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php print $gfw["site_url"]; ?>/index.php?p=timers" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Management</p>
                </a>
              </li>

            </ul>
          </li>

          <li class="li_header">DISCORD FEATURES</li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-terminal"></i>
              <p>
                Discord Commands
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="<?php print $gfw["site_url"]; ?>/index.php?p=discord_commands&a=add" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add a Command</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php print $gfw["site_url"]; ?>/index.php?p=discord_commands" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Management</p>
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item">
            <a href="<?php print $gfw["site_url"]; ?>/index.php?p=promo" class="nav-link">
              <i class="nav-icon fab fa-twitch"></i>
              <p>
                Promo / Streamers
              </p>
            </a>
          </li>          

          <li class="li_header">GLOBAL FEATURES</li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-comment-dots"></i>
              <p>
                Quotes
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="<?php print $gfw["site_url"]; ?>/index.php?p=quotes&a=add" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add an Audio / Sound</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php print $gfw["site_url"]; ?>/index.php?p=quotes" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Management</p>
                </a>
              </li>

            </ul>
          </li>

          <li class="li_header">BOT MANAGEMENT</li>

          <li class="nav-item">
            <a href="<?php print $gfw["site_url"]; ?>/index.php?p=discord&a=settings" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Discord Settings
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php print $gfw["site_url"]; ?>/index.php?p=plugins" class="nav-link">
              <i class="nav-icon fas fa-plug"></i>
              <p>
                Plugins
              </p>
            </a>
          </li>

          <li class="li_header">HELP & SUPPORT</li>

          <li class="nav-item">
            <a target="_blank" href="https://github.com/GibzFGC/FoxxiBot" class="nav-link">
              <i class="nav-icon fab fa-github"></i>
              <p>
                Github
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a target="_blank" href="https://discord.gg/TeRCVh2xBQ" class="nav-link">
              <i class="nav-icon fab fa-discord"></i>
              <p>
                Discord
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a target="_blank" href="https://www.twitter.com/Mega_Gibz" class="nav-link">
              <i class="nav-icon fab fa-twitter"></i>
              <p>
                Twitter
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php print $gfw["site_url"]; ?>/index.php?p=version" class="nav-link">
              <i class="nav-icon fas fa-code-branch"></i>
              <p>
                Version Information
              </p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  
  <script type="text/javascript">
    <?php if (isset($_REQUEST["p"])) { ?>   
      const clientId = "<?php print $gfw["Twitch_ClientID"]; ?>";
      const token = "<?php print $gfw["Twitch_ClientOAuth"]; ?>";
      const { api } = new TwitchJs({ clientId, token })
      
      // Get Users Profile Image & View Count
      api.get('users', { search: { id: <?php print $gfw["Twitch_BroadcasterId"]; ?> } })
      .then(response => {
        document.getElementById("twitch_profile_sidebar").src = response["data"][0].profileImageUrl;
        document.getElementById("twitch_profile_name").innerHTML = response["data"][0].displayName;
      })
    <?php } ?>
  </script>