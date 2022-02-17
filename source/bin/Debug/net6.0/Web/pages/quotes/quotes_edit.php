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

$data = $PDO->query("SELECT * FROM gb_quotes WHERE id='$_REQUEST[id]' LIMIT 1");

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
            <h1 class="m-0">Editing a Quote</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Quotes</li>
              <li class="breadcrumb-item active">Edit</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <form method="post" enctype="multipart/form-data" action="<?php print $gfw["site_url"]; ?>/index.php?p=quotes&a=funcs&v=edit">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Quote Information</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">

                  <div class="form-group">
                    <label for="quoteName">Name</label>
                    <input type="text" class="form-control" id="quoteName" name="quoteName" placeholder="Enter Quote Name" value="<?php print $edit["name"]; ?>">
                  </div>

                  <div class="form-group">
                    <label for="quoteText">Text</label>
                    <textarea class="form-control" rows="3" id="quoteText" name="quoteText" placeholder="Enter the bot response here..."><?php print $edit["text"]; ?></textarea>
                  </div>

                  <div class="form-group">
                    <label for="quoteSource">Source</label>
                    <input type="text" class="form-control" id="quoteSource" name="quoteSource" placeholder="Enter Quote Source" value="<?php print $edit["source"]; ?>">
                  </div>

              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <input type="hidden" id="commandID" name="commandID" value="<?php print $_REQUEST["id"]; ?>">
                <input type="hidden" id="submit" name="submit" value="submit">
                <button style="float: right;" type="submit" class="btn btn-primary">Update Quote</button>
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
                <h3 class="card-title">Quote System</h3>
              </div>
              <!-- /.card-header -->
              
                <div class="card-body">

                  <div class="form-group">
                    The quote system lets you take some of your favourite media (game, movie, etc) quotes or even awesome stream moments and save them as quotes for
                    people to call upon and see<br /><br />
                    Viewers will be able to do "!quote" for a random one or if you have a name set, it will work like "!quote name".<br /><br />
                    This will work on both Discord and Twitch so make sure to add some awesome stuff!
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