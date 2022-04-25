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
            <h1 class="m-0">Twitch Settings</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Twitch Settings</li>
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
                <h3 class="card-title">Main Twitch Bot Settings</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">

                <div class="form-group">
                <label>I'm an Affiliate / Partner</label>
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
                  <label>Bot Message on Join Channel</label>
                  <input type="text" class="form-control" id="joined_channel" name="joined_channel" placeholder="Enter your Bot Message used when it joins your channel" value="<?php print $options["Joined_Channel"]; ?>">
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
                <h3 class="card-title">Stream Messages</h3>
              </div>

              <!-- /.card-header -->
              <div class="card-body">

                <div class="form-group">
                  <label>Twitch Follow Message</label>
                  <input type="text" class="form-control" id="follow_message" name="follow_message" placeholder="Enter your Twitch Follow Message" value="<?php print $options["Follow_Message"]; ?>">
                </div>

                <div class="form-group">
                  <label>Twitch Raid Message</label>
                  <input type="text" class="form-control" id="raid_message" name="raid_message" placeholder="Enter your Twitch Raid Message" value="<?php print $options["Raid_Message"]; ?>">
                </div>

                <div class="form-group">
                  <label>Twitch Subscription Message</label>
                  <input type="text" class="form-control" id="subcriber_message" name="subcriber_message" placeholder="Enter your Twitch Subcriber Message" value="<?php print $options["Subcriber_Message"]; ?>">
                </div>

                <div class="form-group">
                  <label>Twitch Prime Subscription Message</label>
                  <input type="text" class="form-control" id="prime_message" name="prime_message" placeholder="Enter your Twitch Prime Subcriber Message" value="<?php print $options["Prime_Message"]; ?>">
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
                    <p style="float: left; margin-top:15px;">These settings make the bot more personal to your Twitch channel.</p>
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