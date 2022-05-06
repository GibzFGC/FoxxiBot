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
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?= _VERSION_INFO ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><?= _HOME ?></a></li>
              <li class="breadcrumb-item active"><?= _VERSION_INFO ?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="container-fluid">
        <div class="row">

        <div class="col-sm-6">
            <!-- Widget: user widget style 2 -->
            <div class="card card-widget">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header">
                <!-- /.widget-user-image -->
                <h3 style="margin-top: 5px; margin-left: 5px; padding: 5px;" class="user-username">FoxxiBot Information</h3>
              </div>
              <div class="card-footer p-0">
                <ul class="nav flex-column">

                  <li class="nav-item">
                    <span class="nav-link">Bot Version:
                      <span class="float-right">1.0.2 Alpha - Revision 1</span>
                    </span>
                  </li>

                  <li class="nav-item">
                    <span class="nav-link">Operating Version:
                      <span class="float-right"><?php print getenv('OS_VERSION'); ?></span>
                    </span>
                  </li>

                  <li class="nav-item">
                    <span class="nav-link">.NET Framework Version:
                      <span class="float-right"><?php print getenv('DOTNET_VERSION'); ?></span>
                    </span>
                  </li>

                  <li class="nav-item">
                    <span class="nav-link">PHP Version:
                      <span class="float-right"><?php print phpversion(); ?></span>
                    </span>
                  </li>

                  <li class="nav-item">
                    <span class="nav-link">FoxxiBot License:
                      <span class="float-right"><a target="_blank" href="https://www.gnu.org/licenses/gpl-3.0.html">GNU Public License 3.0</a></span>
                    </span>
                  </li>

                </ul>
              </div>
            </div>
            <!-- /.widget-user -->
          </div>

          <div class="col-sm-6">
            <!-- Widget: user widget style 2 -->
            <div class="card card-widget">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header">
                <!-- /.widget-user-image -->
                <h3 style="margin-top: 5px; margin-left: 5px; padding: 5px;" class="user-username">Libaries &amp; Licenses</h3>
              </div>
              <div class="card-footer p-0">
                <ul class="nav flex-column">

                  <li class="nav-item">
                    <span class="nav-link">AdminLTE Version &amp; License:
                      <span class="float-right">3.2.0-rc | <a href="https://github.com/ColorlibHQ/AdminLTE/blob/master/LICENSE">MIT License</a> 
                      | <a target="_blank" href="https://adminlte.io">Website</a></span>
                    </span>
                  </li>

                  <li class="nav-item">
                    <span class="nav-link">CoreTweet Version &amp; License:
                      <span class="float-right">1.0.0.483 | <a target="_blank" href="https://github.com/CoreTweet/CoreTweet/blob/master/LICENSE">MIT License</a>
                       | <a target="_blank" href="https://github.com/CoreTweet/CoreTweet">Github</a></span>
                    </span>
                  </li>

                  <li class="nav-item">
                    <span class="nav-link">Discord .NET Version &amp; License:
                      <span class="float-right">3.6.1 | <a target="_blank" href="https://github.com/discord-net/Discord.Net/blob/dev/LICENSE">MIT License</a>
                       | <a target="_blank" href="https://github.com/discord-net/Discord.Net">Github</a></span>
                    </span>
                  </li>

                  <li class="nav-item">
                    <span class="nav-link">Jint Version &amp; License:
                      <span class="float-right">3.0.0-beta-2037 | <a target="_blank" href="https://github.com/sebastienros/jint/blob/main/LICENSE.txt">BSD 2-Clause License</a>
                       | <a target="_blank" href="https://github.com/JamesNK/Newtonsoft.Json">Github</a></span>
                    </span>
                  </li>

                  <li class="nav-item">
                    <span class="nav-link">Newtonsoft JSON Version &amp; License:
                      <span class="float-right">13.0.1 | <a target="_blank" href="https://github.com/JamesNK/Newtonsoft.Json/blob/master/LICENSE.md">MIT License</a>
                       | <a target="_blank" href="https://github.com/sebastienros/jint">Github</a></span>
                    </span>
                  </li>

                  <li class="nav-item">
                    <span class="nav-link">TwitchLib Version &amp; License:
                      <span class="float-right">3.3.0 | <a target="_blank" href="https://github.com/TwitchLib/TwitchLib/blob/master/LICENSE">MIT License</a>
                       | <a target="_blank" href="https://github.com/TwitchLib/TwitchLib">Github</a></span>
                    </span>
                  </li>

                  <li class="nav-item">
                    <span class="nav-link">Twitch-JS Version &amp; License:
                      <span class="float-right">2.0.0-beta.42 | <a target="_blank" href="https://github.com/twitch-js/twitch-js/blob/next/LICENSEE">MIT License</a>
                       | <a target="_blank" href="https://github.com/twitch-js/twitch-js">Github</a></span>
                    </span>
                  </li>
    
                </ul>
              </div>
            </div>
            <!-- /.widget-user -->
          </div>

          </div>
          <!-- /.col -->

          <div class="col-12">

            <!-- Widget: user widget style 2 -->
            <div class="card card-widget">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header">
                <!-- /.widget-user-image -->
                <h3 style="margin-top: 5px; margin-left: 5px; padding: 5px;" class="user-username">Software License (Simple Version)</h3>
              </div>
              <div class="card-footer p-0">

                <p style="padding:20px;">
                This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the 
                Free Software Foundation, version 3 of the License. (can be changed at any point later on by the original author)<br /><br />

                This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY 
                or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.<br /><br />

                There should be a copy of the GNU Public License along with this program. If not, see <a href="https://www.gnu.org/licenses">https://www.gnu.org/licenses</a>.
                </p>

              </div>
            </div>
            <!-- /.widget-user -->

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