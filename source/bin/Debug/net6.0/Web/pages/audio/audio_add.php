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

$result = $PDO->query("SELECT * FROM gb_points_options");
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
            <h1 class="m-0">Adding a Audio / Sound</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Audio / Sound</li>
              <li class="breadcrumb-item active">Add</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <form method="post" enctype="multipart/form-data" action="<?php print $gfw["site_url"]; ?>/index.php?p=audio&a=funcs&v=save">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Audio / Sound Information</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">

                  <div class="form-group">
                    <label for="commandName">Name</label>
                    <input type="text" class="form-control" id="soundName" name="soundName" placeholder="Enter Sound Name" required>
                  </div>

                  <div class="form-group">
                    <label for="soundUpload">File Upload (Supported: *.wav)</label><br />
                    <input type="file" name="soundUpload" required />
                  </div>

                  <?php if ($options["points_active"] == "on") { ?>
                  <div class="form-group">
                    <label for="soundPoints">Point Cost</label>
                    <input type="number" class="form-control" id="soundPoints" name="soundPoints" value="0">
                  </div>
                  <?php } ?>

                  <div class="form-group">
                    <label>Active</label>
                    <select class="form-control select2" id="soundActive" name="soundActive" style="width: 100%;">
                      <option value="1" SELECTED>Yes</option>';
                      <option value="0">No</option>';
                    </select>
                  </div>

              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <input type="hidden" id="submit" name="submit" value="submit">
                <button style="float: right;" type="submit" class="btn btn-primary">Create Sound</button>
              </div>
            </div>
            <!-- /.card -->

          </div>
          <!--/.col (left) -->
          
        </form>

          <!-- right column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Important Information</h3>
              </div>
              <!-- /.card-header -->
              
                <div class="card-body">

                  <div class="form-group">
                    You can add sounds, music or any other audio with the bot if you add a file. It can be accessed by using the "!sound name" function.<br /><br />
                    When using this fuction, please be aware of copyright and know that any files you use must either be owned by you, you have permission to use them or
                    some other agreement.<br /><br />
                    This is to prevent you from getting Twitch Copyright Claimed or worse from rights holders.<br /><br />
                    The only supported file format right now is *.wav (Wave).
                  </div>

                </div>
                <!-- /.card-body -->

            </div>
            <!-- /.card -->

          </div>
          <!--/.col (right) -->

    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->