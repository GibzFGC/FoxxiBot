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

$result = $PDO->query("SELECT * FROM gb_commands");
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?= _TWITCH_CMD_MNGMNT ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><?= _HOME ?></a></li>
              <li class="breadcrumb-item active"><?= _TWITCH_CMD_MNGMNT ?></li>
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
                <h3 class="card-title"><?= _TWITCH_CMD_YOURS ?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="gb_datatable" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th><?= _CMD ?></th>
                    <th style="width: 50%;"><?= _RESPONSE ?></th>
                    <th><?= _POINTS ?></th>
                    <th><?= _PERMISSION ?></th>
                    <th><?= _ACTIVE ?></th>
                    <th><?= _ACTIONS ?></th>
                  </tr>
                  </thead>
                  <tbody>

                  <tr>
                    <td>!addcom</td>
                    <td>Lets the Broadcaster or a Moderator add a command via chat</td>
                    <td>0</td>
                    <td>Moderator</td>
                    <td>Active</td>
                    <td>
                      <a style="color: #fff;" href="#" class="btn btn-sm">Bot Controlled</a>
                    </td>
                  </tr>

                  <tr>
                    <td>!editcom</td>
                    <td>Lets the Broadcaster or a Moderator edit a command via chat</td>
                    <td>0</td>
                    <td>Moderator</td>
                    <td>Active</td>
                    <td>
                      <a style="color: #fff;" href="#" class="btn btn-sm">Bot Controlled</a>
                    </td>
                  </tr>
                  
                  <tr>
                    <td>!delcom</td>
                    <td>Lets the Broadcaster or a Moderator delete a command via chat</td>
                    <td>0</td>
                    <td>Moderator</td>
                    <td>Active</td>
                    <td>
                      <a style="color: #fff;" href="#" class="btn btn-sm">Bot Controlled</a>
                    </td>
                  </tr>

                  <tr>
                    <td>!accountage</td>
                    <td>{user}, your account was created {creation_date}</td>
                    <td>0</td>
                    <td>Viewer</td>
                    <td>Active</td>
                    <td>
                      <a style="color: #fff;" href="#" class="btn btn-sm">Bot Controlled</a>
                    </td>
                  </tr>

                  <tr>
                    <td>!deaths</td>
                    <td>Returns the amount of times the streamer has died (if being used)</td>
                    <td>0</td>
                    <td>Viewer</td>
                    <td>Active</td>
                    <td>
                      <a style="color: #fff;" href="#" class="btn btn-sm">Bot Controlled</a>
                    </td>
                  </tr>

                  <tr>
                    <td>!followage</td>
                    <td>{sender}, your account followed {follow_date} ago</td>
                    <td>0</td>
                    <td>Viewer</td>
                    <td>Active</td>
                    <td>
                      <a style="color: #fff;" href="#" class="btn btn-sm">Bot Controlled</a>
                    </td>
                  </tr>

                  <tr>
                    <td>!duel</td>
                    <td>Let's viewers duel each other</td>
                    <td>0</td>
                    <td>Viewer</td>
                    <td>Active</td>
                    <td>
                      <a style="color: #fff;" href="#" class="btn btn-sm">Bot Controlled</a>
                    </td>
                  </tr>

                  <tr>
                    <td>!gamble</td>
                    <td>Let's viewers gamble their bot points (if bot points active)</td>
                    <td>0</td>
                    <td>Viewer</td>
                    <td>Active</td>
                    <td>
                      <a style="color: #fff;" href="#" class="btn btn-sm">Bot Controlled</a>
                    </td>
                  </tr>

                  <tr>
                    <td>!giveaway [alias. gw]</td>
                    <td>Enters a viewer into the giveaway (if active)</td>
                    <td>0</td>
                    <td>Viewer</td>
                    <td>Active</td>
                    <td>
                      <a style="color: #fff;" href="#" class="btn btn-sm">Bot Controlled</a>
                    </td>
                  </tr>

                  <tr>
                    <td>!permit</td>
                    <td>Lets the Broadcaster or a Moderator permit someone to add a link in chat (if Twitch Moderation active)</td>
                    <td>0</td>
                    <td>Moderator</td>
                    <td>Active</td>
                    <td>
                      <a style="color: #fff;" href="#" class="btn btn-sm">Bot Controlled</a>
                    </td>
                  </tr>

                  <tr>
                    <td>!raid</td>
                    <td>This will return your custom raid message set in "Twitch Settings" and auto-raid the mentioned user</td>
                    <td>0</td>
                    <td>Moderator</td>
                    <td>Active</td>
                    <td>
                      <a style="color: #fff;" href="#" class="btn btn-sm">Bot Controlled</a>
                    </td>
                  </tr>

                  <tr>
                    <td>!so</td>
                    <td>Check out my friend, {user}! they've been playing: {game}</td>
                    <td>0</td>
                    <td>Moderator</td>
                    <td>Active</td>
                    <td>
                      <a style="color: #fff;" href="#" class="btn btn-sm">Bot Controlled</a>
                    </td>
                  </tr>

                  <tr>
                    <td>!sound [alias. !audio, !play]</td>
                    <td>Will play a sound from the vault if it exists~</td>
                    <td>0</td>
                    <td>Viewer</td>
                    <td>Active</td>
                    <td>
                      <a style="color: #fff;" href="#" class="btn btn-sm">Bot Controlled</a>
                    </td>
                  </tr>

                  <tr>
                    <td>!tweet</td>
                    <td>Allows the broadcaster to send a tweet from chat (if Twitter is active)</td>
                    <td>0</td>
                    <td>Viewer</td>
                    <td>Active</td>
                    <td>
                      <a style="color: #fff;" href="#" class="btn btn-sm">Bot Controlled</a>
                    </td>
                  </tr>                  

<?php
  foreach($result as $row)
  {
              print "
                  <tr>
                    <td>". $row["name"] ."</td>
                    <td>". $row["response"] ."</td>
                    <td>". $row["points"] ."</td>
                    <td>". twitchPerms($row["permission"]) ."</td>
                    <td>". boolean_return($row["active"]) ."</td>
                    <td>
                      <a href=\"$gfw[site_url]/index.php?p=twitch_commands&a=edit&id=$row[id]\" class=\"btn btn-warning btn-sm\">Edit</a>
                      <a onclick=\"return confirm('". _DELETE_MSG ."');\" href=\"$gfw[site_url]/index.php?p=twitch_commands&a=funcs&v=delete&id=$row[id]\" class=\"btn btn-danger btn-sm\">". _DELETE ."</a>
                    </td>
                  </tr>
              ";
  }
?>

                  </tfoot>
                </table>

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