<?php

$action = isset($_GET['act'])?$_GET['act']:null;
switch($action) {
    
    default:
        ?>
            <div class="box">
                    <div class="box-header">
                        <h1>Data Kelas </h1>
                        <div class="btn-group">
                            <a href="#" class="btn btn-danger btn-small" id="btn_add_kelas">
                                <i class="fa fa-plus"></i>
                                Tambah Kelas
                            </a>
                            <a href="#" class="btn btn-success btn-small">
                                <i class="fa fa-download"></i>
                                Download XLS
                            </a>
                        </div>
                        
                    </div>
        <?php
        $sql = "SELECT * FROM kelas";
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
                            <table id="tbl_kelas" class="table table-bordered dataTable" role="grid">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0">No</th>
                                        <th class="sorting_asc hidden-xs" tabindex="1">Kode Kelas</th>
                                        <th class="sorting_asc" tabindex="2">Nama Kelas</th>
                                        <th class="sorting_asc" tabindex="2">Wali Kelas</th>
                                        <th class="sorting_asc hidden-xs" tabindex="3">Status</th>
                                        <th class="sorting_asc" tabindex="4">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
            <?php
            $no = 1;
            while($kelas = mysqli_fetch_assoc($qry)) {
                echo "
                    <tr>
                        <td>$no <span class='hidden id_kelas'>$kelas[id]</span></td>
                        <td class='kode_kelas hidden-xs'>$kelas[kode_kelas]</td>
                        <td>$kelas[kelas]</td>
                        <td>$kelas[wali_kelas]</td>
                        <td class='hidden-xs'>Status</td>
                        <td>";
                        echo $kelas['isActive'] == 0? "<a href='#' class='activate_kelas btn btn-default' title='Aktifkan Kelas'><i class='fa fa-check'></i></a>" : "<a href='#' class='deactivate_kelas btn btn-default' title='Non-aktifkan Kelas'><i class='fa fa-close active'></i></a>";
                        echo "&nbsp;<a href='#' class='btn btn-primary btn_edit_kelas btn btn-warning' title='Edit Kelas'><i class=\"fa fa-pencil\"></i></a></td>

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

<div id="mdal_frm_kelas" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Form <span id='mode_form'></span></h4>
      </div>
      <div class="modal-body">
        <form class="form" id="frm_kelas">
            <span class="hidden" id="mode_aksi"></span>
            <input type="hidden" id="idkelas" name="idkelas">
            <div class="form-group">
                <input type="text" id="kode_kelas" name='kode_kelas' class='form-control flat' placeholder='Masukkan Kode Kelas'>
            </div>
            <div class="form-group">
                <input type="text" id="nama_kelas" name='nama_kelas' class='form-control' placeholder='Nama Kelas'>
            </div>
            <div class="form-group">
                <input type="text" id="wali_kelas" name='wali_kelas' class='form-control' placeholder='Wali Kelas'>
            </div>
            <div class="form-group">
                <button class="btn btn-success center-block" type='submit' id='btn_kelas'>Simpan</button>
            </div>
            
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
      </div>
    </div>

  </div>