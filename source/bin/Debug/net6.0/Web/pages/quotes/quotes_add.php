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
            <h1 class="m-0"><?= _QUOTES_ADDING ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><?= _HOME ?></a></li>
              <li class="breadcrumb-item"><?= _QUOTES ?></li>
              <li class="breadcrumb-item active"><?= _ADD ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <form onsubmit="return validityCheck(this)" method="post" enctype="multipart/form-data" action="<?php print $gfw["site_url"]; ?>/index.php?p=quotes&a=funcs&v=save">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><?= _QUOTE_INFORMATION ?></h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">

                  <div class="form-group">
                    <label for="quoteName"><?= _NAME ?></label>
                    <input type="text" class="form-control" id="quoteName" name="quoteName" placeholder="<?= _QUOTE_NAME_PLACE ?>" required>
                  </div>

                  <div class="form-group">
                    <label for="quoteText">Text</label>
                    <textarea class="form-control" rows="3" id="quoteText" name="quoteText" placeholder="<?= _QUOTE_TEXT_PLACE ?>" required></textarea>
                  </div>

                  <div class="form-group">
                    <label for="quoteSource"><?= _QUOTE_SOURCE ?></label>
                    <input type="text" class="form-control" id="quoteSource" name="quoteSource" placeholder="<?= _QUOTE_SOURCE_PLACE ?>">
                  </div>

              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <input type="hidden" id="submit" name="submit" value="submit">
                <button style="float: right;" type="submit" class="btn btn-primary"><?= _QUOTE_CREATE ?></button>
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
                <h3 class="card-title"><?= _QUOTE_SYSTEM ?></h3>
              </div>
              <!-- /.card-header -->
              
                <div class="card-body">

                  <div class="form-group">
                    <?= _QUOTE_SYSTEM_INFO ?>
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