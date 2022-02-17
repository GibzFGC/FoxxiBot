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

$result = $PDO->query("SELECT * FROM gb_discord_options");
foreach($result as $row)
{
  $options[$row["parameter"]] = $row["value"];
}
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Discord Settings</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Discord Commands</li>
              <li class="breadcrumb-item active">Add</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <form method="post" enctype="multipart/form-data" action="<?php print $gfw["site_url"]; ?>/index.php?p=discord&a=funcs&v=save">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <!-- first column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Main Discord Bot Settings</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">

                  <div class="form-group">
                  <label>Set Bot Channel</label>
                  <select class="form-control select2" id="" name="discord_setbotchannel" style="width: 100%;">

                  <?php
                  $result = $PDO->query("SELECT * FROM gb_discord_channels WHERE channel_type='Text' ORDER BY channel_name ASC");
                  foreach($result as $row)
                  {
                    if ($row["channel_id"] == $options["BotChannel"]) {
                      print '<option value="'. $row['channel_id'] .'" SELECTED>'. $row['channel_name'] .'</option>';
                    } else {
                      print '<option value="'. $row['channel_id'] .'">'. $row['channel_name'] .'</option>';
                    }
                  }
                  ?>
                  </select>
                </div>

                <div class="form-group">
                <label>Lock Bot to the Bot Channel? (Not recommended if you intend to use plugins!)</label>
                  <div style="float: right;">
                  <?php
                  if ($options["BotChannel_Status"] == "off") {
                   print '<input type="checkbox" name="botchannel_status" data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                  } else {
                    print '<input type="checkbox" name="botchannel_status" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                  }
                  ?>
                  </div>
                </div>

                <div class="form-group">
                  <label>Set Join/Leave Greeting Channel</label>
                  <select class="form-control select2" id="" name="discord_setgreetingchannel" style="width: 100%;">

                  <?php
                  $result = $PDO->query("SELECT * FROM gb_discord_channels WHERE channel_type='Text' ORDER BY channel_name ASC");
                  foreach($result as $row)
                  {
                    if ($row["channel_id"] == $options["GreetingChannel"]) {
                      print '<option value="'. $row['channel_id'] .'" SELECTED>'. $row['channel_name'] .'</option>';
                    } else {
                      print '<option value="'. $row['channel_id'] .'">'. $row['channel_name'] .'</option>';
                    }
                  }
                  ?>
                  </select>
                </div>


                <div class="form-group">
                <label>Use the Greeting / Leaving System?</label>
                  <div style="float: right;">
                  <?php
                  if ($options["GreetingChannel_Status"] == "off") {
                   print '<input type="checkbox" name="setgreeting_status" data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                  } else {
                    print '<input type="checkbox" name="setgreeting_status" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                  }
                  ?>
                  </div>
                </div>                

                <div class="form-group">
                  <label>Set Join Auto-Role</label>
                  <select class="form-control select2" id="" name="discord_setautoroll" style="width: 100%;">

                  <?php
                  $result = $PDO->query("SELECT * FROM gb_discord_roles WHERE NOT role_name='@everyone' ORDER BY role_name ASC");
                  foreach($result as $row)
                  {
                    if ($row["role_id"] == $options["AutoRole"]) {
                      print '<option value="'. $row['role_id'] .'" SELECTED>'. $row['role_name'] .'</option>';
                    } else {
                      print '<option value="'. $row['role_id'] .'">'. $row['role_name'] .'</option>';
                    }
                  }
                  ?>
                  </select>
                </div>

                <div class="form-group">
                <label>Use the Join Auto-Role?</label>
                  <div style="float: right;">
                  <?php
                  if ($options["AutoRole_Status"] == "off") {
                   print '<input type="checkbox" name="autorole_status" data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                  } else {
                    print '<input type="checkbox" name="autorole_status" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                  }
                  ?>
                  </div>
                </div>

              </div>
              <!-- /.card-body -->

            <!-- /.card -->

          </div>
          <!--/.col (first) -->
          
          <!-- second column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Streaming Settings</h3>
              </div>

              <!-- /.card-header -->
              <div class="card-body">

                <div class="form-group">
                <label>Set the Notification Channel</label>
                <select class="form-control select2" id="" name="discord_setstreamchannel" style="width: 100%;">

                <?php
                  $result = $PDO->query("SELECT * FROM gb_discord_channels WHERE channel_type='Text' ORDER BY channel_name ASC");
                  foreach($result as $row)
                  {
                    if ($row["channel_id"] == $options["StreamChannel"]) {
                      print '<option value="'. $row['channel_id'] .'" SELECTED>'. $row['channel_name'] .'</option>';
                    } else {
                      print '<option value="'. $row['channel_id'] .'">'. $row['channel_name'] .'</option>';
                    }
                  }
                  ?>
                </select>
                </div>

                <div class="form-group">
                <label>Use the Stream Notification System?</label>
                  <div style="float: right;">
                  <?php
                  if ($options["StreamChannel_Status"] == "off") {
                  print '<input type="checkbox" name="streamchannel_status" data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                  } else {
                    print '<input type="checkbox" name="streamchannel_status" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                  }
                  ?>
                  </div>
                </div>

              </div>
              <!-- /.card-body -->

            </div>
            <!-- /.card -->

          </div>
          <!--/.col (second) -->

          <!-- second column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <!-- /.card-header -->
              
                <div class="card-footer">
                  <input type="hidden" id="submit" name="submit" value="submit">
                    <p style="float: left; margin-top:15px;">Optional settings for Discord if you plan to use that side of the bot.</p>
                    <button style="float: right; margin-top:9px;" type="submit" class="btn btn-primary">Save Settings</button>
                  </div>
                </div>

            </div>
            <!-- /.card -->

    </section>
    <!-- /.content -->

  </form>
  <!-- /.form -->

</div>
<!-- /.content-wrapper -->