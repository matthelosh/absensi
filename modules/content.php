<?php
    $page = isset($_GET['p'])?$_GET['p']:null;
    switch($page) {
      default:
        echo '<section class="content-header">
            <h1>
              Absen Kelas
              <small>SMKN 10 Malang</small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Dashboard</li>
            </ol>
          </section>
          <section class="greet">
            <h1>ABSENSI KELAS <br><small>SMKN 10 Malang</small></h1>
          </section>
          ';
      break;
    }

?>