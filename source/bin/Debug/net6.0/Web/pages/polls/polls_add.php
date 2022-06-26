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
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Creating a Poll</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><?= _HOME ?></a></li>
              <li class="breadcrumb-item">Polls</li>
              <li class="breadcrumb-item active">Creating a Poll</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <form method="post" enctype="multipart/form-data" action="<?php print $gfw["site_url"]; ?>/index.php?p=polls&a=funcs&v=save">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Poll Settings</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">

                  <div class="form-group">
                    <label for="pollTitle">Poll Title</label>
                    <input type="text" class="form-control" id="pollTitle" name="pollTitle" placeholder="Give your poll a title" required>
                  </div>

                  <div class="form-group">
                    <label for="pollOption1">Option 1</label>
                    <input type="text" class="form-control" id="pollOption1" name="pollOption1" placeholder="Give First Option" required>
                  </div>

                  <div class="form-group">
                    <label for="pollOption2">Option 2</label>
                    <input type="text" class="form-control" id="pollOption2" name="pollOption2" placeholder="Give Second Option" required>
                  </div>
                  
                  <div class="form-group">
                    <label for="pollOption3">Option 3</label>
                    <input type="text" class="form-control" id="pollOption3" name="pollOption3" placeholder="Give Third Option">
                  </div>
                  
                  <div class="form-group">
                    <label for="pollOption4">Option 4</label>
                    <input type="text" class="form-control" id="pollOption4" name="pollOption4" placeholder="Give Fourth Option">
                  </div>                  

                  <div class="form-group">
                    <label for="datetime">Poll Completion Time</label>
                    <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                        <input type="text" id="commandDateTime" name="commandDateTime" class="form-control datetimepicker-input" data-target="#reservationdatetime" required>
                        <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                  </div>

              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <input type="hidden" id="submit" name="submit" value="submit">
                <button style="float: right;" type="submit" class="btn btn-primary">Create Poll</button>
              </div>
            </div>
            <!-- /.card -->

          </div>
          <!--/.col (left) -->
          
        </form>

    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->