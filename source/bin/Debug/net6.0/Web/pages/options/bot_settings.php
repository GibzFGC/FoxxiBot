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
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Bot Settings</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Bot Settings</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <form method="post" enctype="multipart/form-data" action="<?php print $gfw["site_url"]; ?>/index.php?p=options&a=funcs&v=save">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <!-- first column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Main Bot Settings</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">

                  <div class="form-group">
                    <label>Debug Mode <small>(requires a restart)</small></label>
                      <div style="float: right;">
                      <?php
                      if ($options["debug"] == "off") {
                      print '<input type="checkbox" name="debug_mode" data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                      } else {
                        print '<input type="checkbox" name="debug_mode" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">';
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
                <h3 class="card-title">Side Menu Settings</h3>
              </div>

              <!-- /.card-header -->
              <div class="card-body">

                <div class="form-group">
                  <label>Show Discord Menu</label>
                    <div style="float: right;">
                    <?php
                    if ($options["discord_features"] == "off") {
                    print '<input type="checkbox" name="discord_features" data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                    } else {
                      print '<input type="checkbox" name="discord_features" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                    }
                    ?>
                  </div>
                </div>

                <div class="form-group">
                  <label>Show Twitch Menu</label>
                    <div style="float: right;">
                    <?php
                    if ($options["twitch_features"] == "off") {
                    print '<input type="checkbox" name="twitch_features" data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                    } else {
                      print '<input type="checkbox" name="twitch_features" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                    }
                    ?>
                  </div>
                </div>

                <div class="form-group">
                  <label>Show Twitter Menu</label>
                    <div style="float: right;">
                    <?php
                    if ($options["twitter_features"] == "off") {
                    print '<input type="checkbox" name="twitter_features" data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                    } else {
                      print '<input type="checkbox" name="twitter_features" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                    }
                    ?>
                  </div>
                </div>

                <div class="form-group">
                  <label>Show Tournament Menu</label>
                    <div style="float: right;">
                    <?php
                    if ($options["tournament_features"] == "off") {
                    print '<input type="checkbox" name="tournament_features" data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                    } else {
                      print '<input type="checkbox" name="tournament_features" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">';
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