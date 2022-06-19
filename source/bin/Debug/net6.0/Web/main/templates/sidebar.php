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

$options = array();

$result = $PDO->query("SELECT * FROM gb_options");
foreach($result as $row)
{
  $options[$row["parameter"]] = $row["value"];
}
?>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php print $gfw['site_url']; ?>" class="brand-link">
      <img src="<?php print $gfw['template_path']; ?>/img/FoxxiBot.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><?= _BOTNAME ?></span>
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
          <?= _LOADING ?>
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
                <?= _DASHBOARD ?>
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php print $gfw["site_url"]; ?>/index.php?p=notifications" class="nav-link">
              <i class="nav-icon fas fa-bell"></i>
              <p>
                <?= _NOTIFICATION ?>
              </p>
            </a>
          </li>

          <?php if ($options["tournament_features"] == "on") { ?>
          <li class="li_header">TOURNAMENT FEATURES</li>

          <li class="nav-item">
            <a href="<?php print $gfw["site_url"]; ?>/index.php?p=tournament" class="nav-link">
              <i class="nav-icon fas fa-award"></i>
              <p>
                Scoreboard
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php print $gfw["site_url"]; ?>/index.php?p=tournament&a=top8" class="nav-link">
              <i class="nav-icon fas fa-award"></i>
              <p>
                Top 8
              </p>
            </a>
          </li> 

          <li class="nav-item">
            <a href="<?php print $gfw["site_url"]; ?>/index.php?p=tournament&a=players" class="nav-link">
              <i class="nav-icon fas fa-award"></i>
              <p>
                Player Management
              </p>
            </a>
          </li>
          <?php } ?>

          <?php if ($options["twitch_features"] == "on") { ?>
          <li class="li_header"><?= _TWITCH_FEAT ?></li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-terminal"></i>
              <p>
              <?= _TWITCH_CMDS ?>
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="<?php print $gfw["site_url"]; ?>/index.php?p=twitch_commands&a=add" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p><?= _TWITCH_ADD_CMD ?></p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php print $gfw["site_url"]; ?>/index.php?p=twitch_commands" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p><?= _MANAGEMENT ?></p>
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-play"></i>
              <p>
              <?= _AUDIO ?>
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="<?php print $gfw["site_url"]; ?>/index.php?p=audio&a=add" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p><?= _AUDIO_ADD ?></p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php print $gfw["site_url"]; ?>/index.php?p=audio" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p><?= _MANAGEMENT ?></p>
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item">
            <a href="<?php print $gfw["site_url"]; ?>/index.php?p=giveaway" class="nav-link">
              <i class="nav-icon fas fa-award"></i>
              <p>
              <?= _GIVEAWAY ?>
              </p>
            </a>
          </li>          

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tasks"></i>
              <p>
              <?= _MODERATION ?>
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="<?php print $gfw["site_url"]; ?>/index.php?p=twitch&a=modlist" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p><?= _MODERATION_WL_BL ?></p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php print $gfw["site_url"]; ?>/index.php?p=twitch&a=moderation" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p><?= _MODERATION_SETTINGS ?></p>
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chalkboard"></i>
              <p>
              <?= _TICKER ?>
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="<?php print $gfw["site_url"]; ?>/index.php?p=ticker&a=add" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p><?= _TICKER_ADD ?></p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php print $gfw["site_url"]; ?>/index.php?p=ticker" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p><?= _MANAGEMENT ?></p>
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-clock"></i>
              <p>
              <?= _TIMERS ?>
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="<?php print $gfw["site_url"]; ?>/index.php?p=timers&a=add" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p><?= _TIMERS_ADD ?></p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php print $gfw["site_url"]; ?>/index.php?p=timers" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p><?= _MANAGEMENT ?></p>
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item">
            <a href="<?php print $gfw["site_url"]; ?>/index.php?p=twitch&a=settings" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
              <?= _TWITCH_SETTINGS ?>
              </p>
            </a>
          </li>          
          <?php } ?>

          <?php if ($options["discord_features"] == "on") { ?>
          <li class="li_header"><?= _DISCORD_FEAT ?></li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-terminal"></i>
              <p>
              <?= _DISCORD_CMDS ?>
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="<?php print $gfw["site_url"]; ?>/index.php?p=discord_commands&a=add" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p><?= _DISCORD_ADD_CMD ?></p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php print $gfw["site_url"]; ?>/index.php?p=discord_commands" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p><?= _MANAGEMENT ?></p>
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item">
            <a href="<?php print $gfw["site_url"]; ?>/index.php?p=promo" class="nav-link">
              <i class="nav-icon fab fa-twitch"></i>
              <p>
              <?= _PROMO ?>
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php print $gfw["site_url"]; ?>/index.php?p=discord&a=settings" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
              <?= _DISCORD_SETTINGS ?>
              </p>
            </a>
          </li>          
          <?php } ?>
          <?php if ($options["twitter_features"] == "on") { ?>
          <li class="li_header"><?= _OTHER_SERVICE ?></li>
          

            <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fab fa-twitter"></i>
              <p>
              <?= _TWITTER ?>
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="<?php print $gfw["site_url"]; ?>/index.php?p=twitter&a=add" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p><?= _TWITTER_GAME_STATUS ?></p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php print $gfw["site_url"]; ?>/index.php?p=twitter" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p><?= _TWITTER_STATUS_LIST ?></p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php print $gfw["site_url"]; ?>/index.php?p=twitter&a=settings" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p><?= _TWITTER_SETTINGS ?></p>
                </a>
              </li>

            </ul>
          </li>

          <?php } ?>

          <li class="li_header"><?= _GLOBAL_FEAT ?></li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-stopwatch-20"></i>
              <p>
              <?= _COUNTDOWN ?>
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
              <a href="<?php print $gfw["site_url"]; ?>/index.php?p=countdowns&a=add" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p><?= _COUNTDOWN_ADD ?></p>
                </a>
              </li>              

              <li class="nav-item">
              <a href="<?php print $gfw["site_url"]; ?>/index.php?p=countdowns" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p><?= _MANAGEMENT ?></p>
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-money-bill-wave"></i>
              <p>
              <?= _POINTS ?>
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="<?php print $gfw["site_url"]; ?>/index.php?p=points&a=listing" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p><?= _POINT_RANK ?></p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php print $gfw["site_url"]; ?>/index.php?p=points&a=redeems" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p><?= _POINT_REDEEM ?></p>
                </a>
              </li>              

              <li class="nav-item">
                <a href="<?php print $gfw["site_url"]; ?>/index.php?p=points" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p><?= _MANAGEMENT ?></p>
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-poll"></i>
              <p>
              Polls
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
              <a href="<?php print $gfw["site_url"]; ?>/index.php?p=polls&a=add" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create a Poll</p>
                </a>
              </li>              

              <li class="nav-item">
              <a href="<?php print $gfw["site_url"]; ?>/index.php?p=polls" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Polls</p>
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-comment-dots"></i>
              <p>
              <?= _QUOTES ?>
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="<?php print $gfw["site_url"]; ?>/index.php?p=quotes&a=add" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p><?= _QUOTES_ADD ?></p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php print $gfw["site_url"]; ?>/index.php?p=quotes" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p><?= _MANAGEMENT ?></p>
                </a>
              </li>

            </ul>
          </li>

          <li class="li_header"><?= _BOT_MANAGEMENT ?></li>

          <li class="nav-item">
            <a href="<?php print $gfw["site_url"]; ?>/index.php?p=options&a=settings" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
              <?= _SETTINGS ?>
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php print $gfw["site_url"]; ?>/index.php?p=plugins" class="nav-link">
              <i class="nav-icon fas fa-plug"></i>
              <p>
              <?= _PLUGINS ?>
              </p>
            </a>
          </li>

          <li class="li_header"><?= _HELP ?></li>

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
                <?= _VERSION_INFO ?>
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