<?php
    $action = isset($_GET['act'])?$_GET['act']:null;

    switch($action) {
        default:
        ?>
            <div class="box">
                    <div class="box-header">
                        <h1>Data Siswa </h1>
                        <div class="btn-group">
                            <a href="#" class="btn btn-danger btn-small" id="btn_add_siswa">
                                <i class="fa fa-plus"></i>
                                Tambah Siswa
                            </a>
                            <a href="#" class="btn btn-success btn-small">
                                <i class="fa fa-download"></i>
                                Download XLS
                            </a>
                        </div>
                        
                    </div>
        <?php
        $sql = "SELECT * FROM siswa";
        $qry = mysqli_query($conn, $sql);
        if (mysqli_num_rows($qry) < 1) {
            echo "
                <div class=\"box box-widget widget-user-2\">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class=\"widget-user-header bg-red\">
                        <div class=\"widget-user-image pull-left\">
                            <h1><i class=\"fa fa-calendar\"></i></h1>
                        </div>
                        <!-- /.widget-user-image -->
                        <h3 class=\"widget-user-username\">Belum Ada Data Jadwal</h3>
                        <h5 class=\"widget-user-desc\">Tambahkan Jadwal Pembelajaran Dulu</h5>
                    </div>
                    <div class=\"widget-user-footer\">
                    </div>
                </div>
            ";
        } else {
            ?>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="tbl_siswa" class="table table-bordered dataTable" role="grid">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0">No</th>
                                        <th class="sorting_asc hidden-xs" tabindex="1">NIS</th>
                                        <th class="sorting_asc" tabindex="2">Nama</th>
                                        <th class="sorting_asc" tabindex="3">Kelas</th>
                                        <th class="sorting_asc hidden-xs" tabindex="4">No. HP</th>
                                        <th class="sorting_asc hidden-xs" tabindex="5">Status</th>
                                        <th class="sorting_asc" tabindex="6">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
            <?php
            $no = 1;
            while($siswa = mysqli_fetch_assoc($qry)) {
                echo "
                    <tr>
                        <td >$no </td>
                        <td class='nis hidden-xs'>$siswa[nis]</td>
                        <td>$siswa[nama]</td>
                        <td>";
                            $get_kelas = mysqli_query($conn,"SELECT * FROM rombel WHERE id = '$siswa[kelas]'");
                            $kelas = mysqli_fetch_assoc($get_kelas);
                            echo $kelas['nama_rombel'];

                        echo "</td>
                        <td class='hidden-xs'>$siswa[hp]</td>
                        <td class='hidden-xs'>";
                        if ($siswa['isActive'] == '0') {
                            echo 'Tidak Aktif';
                        } else if ($siswa['isActive'] == '1') {
                            echo 'Aktif';
                        }
                        echo "</td>
                        <td>";
                        echo $siswa['isActive'] == 0? "<a href='#' class='activate_siswa btn btn-default' title='Aktifkan siswa'><i class='fa fa-check'></i></a>" : "<a href='#' class='deactivate_siswa btn btn-default' title='Non-aktifkan siswa'><i class='fa fa-close active'></i></a>";
                        echo "&nbsp;<a href='#' class='btn btn-primary btn_edit_siswa btn btn-warning' title='Edit siswa'><i class=\"fa fa-pencil\"></i></a></td>

                    </tr>
                ";
                $no++;
            }
            ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php
        }
        break;
    }
?>


<div id="mdal_frm_siswa" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Form <span id='mode_form'></span></h4>
      </div>
      <div class="modal-body">
        <form class="form" id="frm_siswa">
            <span class="hidden" id="mode_aksi"></span>
            <input type="hidden" id="idsiswa" name="idsiswa">
            <div class="form-group">
                <input type="text" id="nis" name='nis' class='form-control flat' placeholder='Masukkan NIS'>
            </div>
            <div class="form-group">
                <input type="text" id="nama_siswa" name='nama_siswa' class='form-control' placeholder='Nama siswa'>
            </div>
            <div class="form-group">
                <select class="form-control" id="kode_kelas" name="kode_kelas">
                </select>
            </div>
            <div class="form-group">
                <input type="text" id="hp" name='hp' class='form-control' placeholder='No. HP'>
            </div>
            <div class="form-group">
                <button class="btn btn-success center-block" type='submit' id='btn_siswa'>Simpan</button>
            </div>
            
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
      </div>
    </div>

  </div>