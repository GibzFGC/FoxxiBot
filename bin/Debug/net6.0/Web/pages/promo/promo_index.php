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

$result = $PDO->query("SELECT * FROM gb_discord_streamers");
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Discord Promo / Streamer Management</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Promo Management</li>
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
          <form method="post" enctype="multipart/form-data" action="<?php print $gfw["site_url"]; ?>/index.php?p=promo&a=funcs&v=save">

            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Quick Promo / Streamer Addition</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">

                  <div class="form-group">
                    <label for="commandName">Add a Streamers Twitch username</label>
                    <input type="text" class="form-control" id="twitchName" name="twitchName" placeholder="Enter a Streamers Username Here">
                  </div>
                </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <input type="hidden" id="submit" name="submit" value="submit">
                <button style="float: right;" type="submit" class="btn btn-primary">Add Streamer to Promo</button>
              </div>
            </div>
            <!-- /.card -->

            </form>
          </div>

          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Here are the registered Streamers for Promo.</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="gb_datatable" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Username</th>
                    <th>Live</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>

<?php
  foreach($result as $row)
  {
    if ($row["live"] == "0") {
      $live_status = "Currently Offline";
    } else {
      $live_status = "Currently streaming @ <a target='_blank' href='https://www.twitch.tv/" . $row["username"] . "'>https://www.twitch.tv/" . $row["username"] . "</a>";
    }


              print "
                  <tr>
                    <td>". $row["username"] ."</td>
                    <td>". $live_status ."</td>
                    <td><a onclick=\"return confirm('Are you sure you want to delete this item?');\" href=\"$gfw[site_url]/index.php?p=promo&a=funcs&v=delete&id=$row[username]\" class=\"btn btn-danger btn-sm\">Delete</a></td>
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