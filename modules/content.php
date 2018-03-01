<?php
    $page = isset($_GET['p'])?$_GET['p']:null;
    switch($page) {
      ## Tampilan Untuk Admin
      case "user":
        include 'user.php';
      break;
      case "adm_kelas":
        include 'admin_kelas.php';
      break;
      case "adm_mapel":
        include 'admin_mapel.php';
      break;
      case "adm_siswa":
        include 'admin_siswa.php';
      break;
      case "adm_rombel":
        include 'admin_rombel.php';
      break;
      case "adm_jadwal";
        include 'admin_jadwal.php';
      break;
      case "adm_absensi";
        include 'admin_absensi.php';
      break;



      ## Tampilan Default
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