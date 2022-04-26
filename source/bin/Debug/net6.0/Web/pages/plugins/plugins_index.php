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

$twitch = $PDO->query("SELECT * FROM gb_twitch_plugins");
$discord = $PDO->query("SELECT * FROM gb_discord_plugins");
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Plugins Management</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Plugins Management</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true" style="">Twitch</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false" style="">Discord</a>
                  </li>
                </ul>
              </div>
              <!-- /.card-header -->

              <div class="card-body">

                <div class="tab-content" id="custom-tabs-three-tabContent">
                  <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">

                    <table id="gb_datatable" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th><?= _CMD ?></th>
                        <th><?= _NAME ?></th>
                        <th><?= _AUTHOR ?></th>
                        <th><?= _DATE ?></th>
                        <th><?= _FILE ?></th>
                        <th><?= _ACTIONS ?></th>
                      </tr>
                    </thead>
                    <tbody>

  <?php
    foreach($twitch as $twitch_plugin)
    {
                print "
                    <tr>
                      <td>". $twitch_plugin["command"] ."</td>
                      <td>". $twitch_plugin["name"] ."</td>
                      <td>". $twitch_plugin["author"] ."</td>
                      <td>". $twitch_plugin["date"] ."</td>
                      <td>". $twitch_plugin["file"] ."</td>
                      <td>
                ";

                if ($twitch_plugin["active"] == 0) {
                  print "<a href=\"$gfw[site_url]/index.php?p=plugins&a=funcs&v=status&platform=twitch&status=1&id=$twitch_plugin[command]\" class=\"btn btn-success btn-sm\">Activate</a>";
                } else {
                  print "<a href=\"$gfw[site_url]/index.php?p=plugins&a=funcs&v=status&platform=twitch&status=0&id=$twitch_plugin[command]\" class=\"btn btn-warning btn-sm\">Deactivate</a>";
                }
                      
                      print "
                        <a onclick=\"return confirm('". _DELETE_MSG_FILES ."');\" href=\"$gfw[site_url]/index.php?p=plugins&a=funcs&v=delete&platform=twitch&id=$twitch_plugin[command]\" class=\"btn btn-danger btn-sm\">". _DELETE_PLUGIN ."</a>
                      </td>
                    </tr>
                    ";
    }
  ?>

                    </tfoot>
                  </table>

                  </div>

                  <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">

                  <table id="gb_datatable" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                      <th><?= _CMD ?></th>
                        <th><?= _NAME ?></th>
                        <th><?= _AUTHOR ?></th>
                        <th><?= _DATE ?></th>
                        <th><?= _FILE ?></th>
                        <th><?= _ACTIONS ?></th>
                      </tr>
                    </thead>
                    <tbody>

  <?php
    foreach($discord as $discord_plugin)
    {
                print "
                    <tr>
                      <td>". $discord_plugin["command"] ."</td>
                      <td>". $discord_plugin["name"] ."</td>
                      <td>". $discord_plugin["author"] ."</td>
                      <td>". $discord_plugin["date"] ."</td>
                      <td>". $discord_plugin["file"] ."</td>
                      <td>
                ";

                      if ($discord_plugin["active"] == 0) {
                        print "<a href=\"$gfw[site_url]/index.php?p=plugins&a=funcs&v=status&platform=discord&status=1&id=$discord_plugin[command]\" class=\"btn btn-success btn-sm\">Activate</a>";
                      } else {
                        print "<a href=\"$gfw[site_url]/index.php?p=plugins&a=funcs&v=status&platform=discord&status=0&id=$discord_plugin[command]\" class=\"btn btn-warning btn-sm\">Deactivate</a>";
                      }
                      
                      print "
                        <a onclick=\"return confirm('". _DELETE_MSG_FILES ."');\" href=\"$gfw[site_url]/index.php?p=plugins&a=funcs&v=delete&platform=discord&id=$discord_plugin[command]\" class=\"btn btn-danger btn-sm\">". _DELETE_PLUGIN ."</a>
                      </td>
                    </tr>
                    ";
    }
  ?>

                    </tfoot>
                  </table>

                  </div>
                </div>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
 
    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->