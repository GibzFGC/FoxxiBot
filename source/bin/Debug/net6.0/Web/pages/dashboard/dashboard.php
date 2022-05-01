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
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?= _DASHBOARD ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><?= _HOME ?></a></li>
              <li class="breadcrumb-item active"><?= _DASHBOARD ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">

          <div class="col-md-6">
              <!-- Widget: user widget style 1 -->
              <div class="card card-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-primary">
                  <h3 id="dashboard_displayname" class="widget-user-username"><?= _LOADING ?></h3>
                  <h5 class="widget-user-desc"><?= _BROADCASTER ?></h5>
                </div>

                <a target="_blank" href="https://www.twitch.tv/<?php print $gfw["Twitch_BroadcasterChannel"]; ?>">
                <div class="widget-user-image">
                    <img id="twitch_profile_url" class="img-circle elevation-2" src="<?php print $gfw['template_path']; ?>/img/default_profile.png" alt="User Avatar">
                </div>
                </a>

                <div class="card-footer">
                  <div class="row">
                    <div class="col-sm-4 border-right">
                      <div class="description-block">
                        <h5 id="stream_status" class="description-header"><?= _LOADING ?></h5>
                        <span class="description-text">STREAM</span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 border-right">
                      <div class="description-block">
                        <h5 id="total_follows" class="description-header"><?= _LOADING ?></h5>
                        <span class="description-text"><?= _FOLLOWS ?></span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4">
                      <div class="description-block">
                        <h5 id="total_views" class="description-header"><?= _LOADING ?></h5>
                        <span class="description-text"><?= _VIEWS ?></span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </div>
              </div>
              <!-- /.widget-user -->
            </div>
            <!-- /.col -->

            <div class="col-md-6">
            <!-- Widget: user widget style 2 -->
            <div class="card card-widget widget-user-2">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-primary">
                <!-- /.widget-user-image -->
                <h3 class="user-username"><?= _TWITCH_DATA ?></h3>
                <h5 class="user-desc"><?= _TWITCH_DATA_DELAY ?></h5>
              </div>
              <div class="card-footer p-0">
                <ul class="nav flex-column">
                  <li class="nav-item">
                    <span class="nav-link">
                      <?= _TITLE ?>: <span id="stream_title" class="float-right"><?= _LOADING ?></span>
                    </span>
                  </li>
                  <li class="nav-item">
                    <span class="nav-link">
                      <?= _GAME ?>: <span id="stream_game" class="float-right"><?= _LOADING ?></span>
                    </span>
                  </li>

                  <li class="nav-item">
                    <span class="nav-link">
                      <?= _VIEWERS ?>: <span id="stream_viewers" class="float-right"><?= _LOADING ?></span>
                    </span>
                  </li>

                  <li class="nav-item">
                    <span class="nav-link">
                      <?= _UPTIME ?>: <span id="stream_uptime" class="float-right"><?= _LOADING ?></span>
                    </span>
                  </li>
                  
                  <!-- <a href="#" class="btn btn-block btn-primary btn-sm float-right" data-toggle="modal" data-target="#streamModal">Edit Stream Info</a> -->
                </ul>
              </div>
            </div>
            <!-- /.widget-user -->
          </div>

        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">

        <div class="col-md-4">
            <!-- Widget: user widget style 2 -->
            <div class="card card-widget">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header">
                <!-- /.widget-user-image -->
                <h3 style="margin-top: 5px; margin-left: 5px; padding: 5px;" class="user-username"><?= _FOLLOWS_LATEST ?></h3>
              </div>
              <div class="card-footer p-0">
                <ul id="follower_list" class="nav flex-column">                  
                <?= _LOADING ?>
                </ul>
              </div>
            </div>
            <!-- /.widget-user -->
          </div>
            <!-- /.col -->

            <div class="col-md-4">
            <!-- Widget: user widget style 2 -->
            <div class="card card-widget">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header">
                <!-- /.widget-user-image -->
                <h3 style="margin-top: 5px; margin-left: 5px; padding: 5px;" class="user-username"><?= _EVENTS_LATEST ?></h3>
              </div>
              <div class="card-footer p-0">
                <ul class="nav flex-column">

                <?php
                  $n_result = $PDO->query("SELECT * FROM gb_twitch_notifications WHERE type IS NOT 'Follower' ORDER BY id DESC LIMIT 8");
                  foreach($n_result as $n_row)
                  {
                    print '
                    <li class="nav-item">
                      <span class="nav-link"><a style="margin-right: 10px;" href="'. $gfw['site_url'] .'/index.php?p=notifications&a=funcs&v=event&type='. $n_row["type"] .'&name='. $n_row["user"] .'&views='. $n_row["viewers"] .'" class="btn btn-primary btn-sm">'._PLAY.'</a>'.$n_row["type"] .': <a style="color: #fff;" target="_blank" href="https://www.twitch.tv/'. $n_row["user"] .'">'. $n_row["user"] .'</a>
                        <span class="float-right">'. $n_row["viewers"] .' '._VIEWERS.'</span>
                      </span>
                    </li>
                    ';
                  }
                ?>

                </ul>
              </div>
            </div>
            <!-- /.widget-user -->
          </div>

          <div class="col-md-4">
          <?php print '
            <iframe frameBorder="0" src="https://www.twitch.tv/embed/'. $gfw["Twitch_BroadcasterChannel"] .'/chat?darkpopout&parent=localhost"
              width="100%",
              height="440",
              sandbox="allow-scripts allow-same-origin allow-popups allow-popups-to-escape-sandbox allow-modals">
            </iframe>
          </div>';
          ?>

        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->
  
  <script type="text/javascript">
    var TwitchClientID = "<?php print $gfw["Twitch_ClientID"]; ?>";
    var TwitchClientOAuth = "<?php print $gfw["Twitch_ClientOAuth"]; ?>";
    var TwitchChannelID = "<?php print $gfw["Twitch_BroadcasterId"]; ?>";
  </script>
  
  <script src="<?php print $gfw['template_path']; ?>/plugins/jquery/jquery.min.js"></script>
  <script src="/pages/dashboard/dashboard.js"></script>