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
            <h1 class="m-0">Twitch Moderation</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Twitch Moderation</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <form id="settings" method="post" enctype="multipart/form-data" action="<?php print $gfw["site_url"]; ?>/index.php?p=twitch&a=funcs&v=save">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <!-- first column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Below you can manage how the bot will handle Twitch Moderation</h3>
              </div>
              
              <!-- /.card-header -->
              <div class="card-body">

                <div class="row">
                  
                  <div class="col-md-3">
                    <div class="card">
                      <div class="card-header">
                        <h3 style="margin-top: 5px;" class="card-title">Blacklist Words / URLs</h3>
                        
                        <div class="card-tools">
                          <?php
                          if ($options["Blacklist_Status"] == "off") {
                          print '<input type="checkbox" name="blacklist_status" data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                          } else {
                            print '<input type="checkbox" name="blacklist_status" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                          }
                          ?>
                        </div>
                      </div>
                    
                      <div class="card-body">
                        This feature will take the words you've put into the blacklist and remove them from messages.
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                  </div>

                  <div class="col-md-3">
                    <div class="card">
                      <div class="card-header">
                        <h3 style="margin-top: 5px;" class="card-title">Whitelist Words / URLs</h3>

                        <div class="card-tools">
                          <?php
                          if ($options["Whitelist_Status"] == "off") {
                          print '<input type="checkbox" name="whitelist_status" data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                          } else {
                            print '<input type="checkbox" name="whitelist_status" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                          }
                          ?>
                        </div>
                      </div>
                    
                      <div class="card-body">
                        This feature will take the words or links you've put into the whitelist and make sure they're sent.
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                  </div>

                  <div class="col-md-3">
                    <div class="card">
                      <div class="card-header">
                        <h3 style="margin-top: 5px;" class="card-title">Link Filter</h3>
                        
                        <div class="card-tools">
                          <?php
                          if ($options["LinkFilter_Status"] == "off") {
                          print '<input type="checkbox" name="linkfilter_status" data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                          } else {
                            print '<input type="checkbox" name="linkfilter_status" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                          }
                          ?>
                        </div>

                      </div>
                    
                      <div class="card-body">
                        Link filtering will stop web links from being posted in your Twitch chat. (unless whitelisted)
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                  </div>

                  <div class="col-md-3">
                    <div class="card">
                      <div class="card-header">
                        <h3 style="margin-top: 5px;" class="card-title">Caps Filter</h3>

                        <div class="card-tools">
                          <?php
                          if ($options["CapsFilter_Status"] == "off") {
                          print '<input type="checkbox" name="capsfilter_status" data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                          } else {
                            print '<input type="checkbox" name="capsfilter_status" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                          }
                          ?>
                        </div>
                      </div>
                    
                      <div class="card-body">
                        Will prevent messages from being posted if they're mostly capital letters.
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                  </div>

                  <div class="col-md-3">
                    <div class="card">
                      <div class="card-header">
                        <h3 style="margin-top: 5px;" class="card-title">Symbols Filter</h3>

                        <div class="card-tools">
                          <?php
                          if ($options["SymbolsFilter_Status"] == "off") {
                          print '<input type="checkbox" name="symbolsfilter_status" data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                          } else {
                            print '<input type="checkbox" name="symbolsfilter_status" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                          }
                          ?>
                        </div>
                      </div>
                    
                      <div class="card-body">
                        Will prevent messages from being posted if they're mostly symbols.
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                  </div>

                  <div class="col-md-3">
                    <div class="card">
                      <div class="card-header">
                        <h3 style="margin-top: 5px;" class="card-title">Spam Filter</h3>

                        <div class="card-tools">
                          <?php
                          if ($options["SpamFilter_Status"] == "off") {
                          print '<input type="checkbox" name="spamfilter_status" data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                          } else {
                            print '<input type="checkbox" name="spamfilter_status" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                          }
                          ?>
                        </div>
                      </div>
                    
                      <div class="card-body">
                        Attempt to prevent messages that comtain a lot of spam.
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                  </div>

                  <div class="col-md-3">
                    <div class="card">
                      <div class="card-header">
                        <h3 style="margin-top: 5px;" class="card-title">/me Filter</h3>

                        <div class="card-tools">
                          <?php
                          if ($options["MeFilter_Status"] == "off") {
                          print '<input type="checkbox" name="mefilter_status" data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                          } else {
                            print '<input type="checkbox" name="mefilter_status" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                          }
                          ?>
                        </div>
                      </div>
                    
                      <div class="card-body">
                        Prevents use of the /me function on Twitch in chat messages.
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                  </div>

                  <div class="col-md-3">
                    <div class="card">
                      <div class="card-header">
                        <h3 style="margin-top: 5px;" class="card-title">Purge Fake System Messages</h3>

                        <div class="card-tools">
                          <?php
                          if ($options["SystemFilter_Status"] == "off") {
                          print '<input onChange="this.form.submit()" type="checkbox" name="systemfilter_status" data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                          } else {
                            print '<input type="checkbox" name="systemfilter_status" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                          }
                          ?>
                        </div>
                      </div>
                    
                      <div class="card-body">
                        This will prevent people from sending messages like <code>&lt;message deleted&gt;</code>.
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                  </div>

                </div>

                <div class="card-footer">
                  <input type="hidden" id="submit" name="submit" value="submit">
                    <p style="float: left; margin-top:15px;">Make sure to save your settings!</p>
                    <button style="float: right; margin-top:9px;" type="submit" class="btn btn-primary">Save Settings</button>
                  </div>
                </div>

              </div>
              <!-- /.card-body -->

          </div>
          <!--/.col (first) -->
          
          

    </section>
    <!-- /.content -->

    </form>
    <!-- /.form -->

</div>
<!-- /.content-wrapper -->