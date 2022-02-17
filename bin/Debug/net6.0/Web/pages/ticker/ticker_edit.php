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

$data = $PDO->query("SELECT * FROM gb_ticker WHERE id='$_REQUEST[id]' LIMIT 1");

foreach($data as $edit)
{
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Editing a Ticker: </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Ticker</li>
              <li class="breadcrumb-item active">Edit</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <form method="post" enctype="multipart/form-data" action="<?php print $gfw["site_url"]; ?>/index.php?p=ticker&a=funcs&v=edit">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Ticker Information</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">

                  <div class="form-group">
                    <label for="tickerName">Name</label>
                    <input type="text" class="form-control" id="tickerName" name="tickerName" placeholder="Enter Ticker Name" value="<?php print $edit["name"]; ?>">
                  </div>

                  <div class="form-group">
                    <label for="tickerResponse">Response</label>
                    <textarea class="form-control" rows="3"  id="tickerResponse" name="tickerResponse" placeholder="Enter the response text here..."><?php print $edit["response"]; ?></textarea>
                  </div>

                  <div class="form-group">
                    <label>Active</label>
                    <select class="form-control select2" id="tickerActive" name="tickerActive" style="width: 100%;">
                    <?php if($edit["active"] == 0) {
                      print "<option value=\"0\" SELECTED>No</option>";
                      print "<option value=\"1\">Yes</option>";
                    } else {
                      print "<option value=\"1\" SELECTED>Yes</option>";
                      print "<option value=\"0\">No</option>";
                    }
                    ?>
                    </select>
                  </div>

              </div>
              <!-- /.card-body -->

              <div class="card-footer">
              <input type="hidden" id="ttickerID" name="tickerID" value="<?php print $_REQUEST["id"]; ?>">
                <input type="hidden" id="submit" name="submit" value="submit">
                <button style="float: right;" type="submit" class="btn btn-primary">Update Ticker</button>
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
                <h3 class="card-title">Useful Information</h3>
              </div>
              <!-- /.card-header -->
              
                <div class="card-body">

                  <div class="form-group">
                    <p>
                      Tickers are for showing information in a consice box that scrolls with information you set.
                      <br /><br />
                      This could be useful for showing social media info, events / meet-ups / game announcement, etc.
                      <br /><br />
                      You can also set which are active at any time, meaning they can be re-used or recycled (edited).
                    </p>
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
  <?php } ?>