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

$result = $PDO->query("SELECT * FROM gb_twitch_options");
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
            <h1 class="m-0"><?= _TWITCH_SETTINGS ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><?= _HOME ?></a></li>
              <li class="breadcrumb-item active"><?= _TWITCH_SETTINGS ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <form method="post" enctype="multipart/form-data" action="<?php print $gfw["site_url"]; ?>/index.php?p=twitch&a=funcs&v=settings">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <!-- first column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><?= _TWITCH_SETTINGS_MAIN ?></h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">

                <div class="form-group">
                <label><?= _TWITCH_SETTINGS_PARTNER ?></label>
                  <div style="float: right;">
                  <?php
                  if ($options["Partner_Status"] == "off") {
                   print '<input type="checkbox" name="partner_status" data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                  } else {
                    print '<input type="checkbox" name="partner_status" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                  }
                  ?>
                  </div>
                </div>

                <div class="form-group">
                  <label><?= _TWITCH_SETTINGS_BOT_CHANNEL ?></label>
                  <input type="text" class="form-control" id="joined_channel" name="joined_channel" placeholder="<?= _TWITCH_SETTINGS_BOT_CHANNEL_MSG ?>" value="<?php print $options["Joined_Channel"]; ?>">
                </div>                

                <div class="form-group">
                  <label>Our Raid Message</label>
                  <input type="text" class="form-control" id="on_raid_message" name="on_raid_message" value="<?php print $options["On_Raid_Message"]; ?>">
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
                <h3 class="card-title"><?= _TWITCH_SETTINGS_STREAM ?></h3>
              </div>

              <!-- /.card-header -->
              <div class="card-body">

                <div class="form-group">
                  <label><?= _TWITCH_SETTINGS_STREAM_FOLLOW ?></label>
                  <input type="text" class="form-control" id="follow_message" name="follow_message" placeholder="<?= _TWITCH_SETTINGS_STREAM_FOLLOW_PLACE ?>" value="<?php print $options["Follow_Message"]; ?>">
                </div>

                <div class="form-group">
                  <label><?= _TWITCH_SETTINGS_STREAM_RAID ?></label>
                  <input type="text" class="form-control" id="raid_message" name="raid_message" placeholder="<?= _TWITCH_SETTINGS_STREAM_RAID_PLACE ?>" value="<?php print $options["Raid_Message"]; ?>">
                </div>

                <div class="form-group">
                  <label><?= _TWITCH_SETTINGS_STREAM_SUB ?></label>
                  <input type="text" class="form-control" id="subscriber_message" name="subscriber_message" placeholder="<?= _TWITCH_SETTINGS_STREAM_SUB_PLACE ?>" value="<?php print $options["Subscriber_Message"]; ?>">
                </div>

                <div class="form-group">
                  <label><?= _TWITCH_SETTINGS_STREAM_PRIMESUB ?></label>
                  <input type="text" class="form-control" id="prime_message" name="prime_message" placeholder="<?= _TWITCH_SETTINGS_STREAM_PRIMESUB_PLACE ?>" value="<?php print $options["Prime_Message"]; ?>">
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
                    <p style="float: left; margin-top:15px;"><?= _TWITCH_SETTINGS_INFO ?></p>
                    <button style="float: right; margin-top:9px;" type="submit" class="btn btn-primary"><?= _SAVE_SETTINGS ?></button>
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