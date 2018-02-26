<?php
    $action = isset($_GET['act'])?$_GET['act']:null;

    switch($action) {
        default:
        ?>
            <div class="box">
                    <div class="box-header">
                        <h1>Data Mapel </h1>
                        <div class="btn-group">
                            <a href="#" class="btn btn-danger btn-small" id="btn_add_mapel">
                                <i class="fa fa-plus"></i>
                                Tambah Mapel
                            </a>
                            <a href="#" class="btn btn-success btn-small">
                                <i class="fa fa-download"></i>
                                Download XLS
                            </a>
                        </div>
                        
                    </div>
        <?php
        $sql = "SELECT * FROM mapel";
        $qry = mysqli_query($conn, $sql);
        if (mysqli_num_rows($qry) < 1) {
            echo 'Belum ada data Mapel';
        } else {
            ?>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="tbl_mapel" class="table table-bordered dataTable" role="grid">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0">No</th>
                                        <th class="sorting_asc hidden-xs" tabindex="1">Kode Mapel</th>
                                        <th class="sorting_asc" tabindex="2">Mapel</th>
                                        <th class="sorting_asc hidden-xs" tabindex="3">Status</th>
                                        <th class="sorting_asc" tabindex="4">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
            <?php
            $no = 1;
            while($mapel = mysqli_fetch_assoc($qry)) {
                echo "
                    <tr>
                        <td >$no </td>
                        <td class='kode_mapel'>$mapel[kode_mapel]</td>
                        <td>$mapel[mapel]</td>
                        <td class='hidden-xs'>Status</td>
                        <td>";
                        echo $mapel['isActive'] == 0? "<a href='#' class='activate_mapel btn btn-default' title='Aktifkan Mapel'><i class='fa fa-check'></i></a>" : "<a href='#' class='deactivate_mapel btn btn-default' title='Non-aktifkan Mapel'><i class='fa fa-close active'></i></a>";
                        echo "&nbsp;<a href='#' class='btn btn-primary btn_edit_mapel btn btn-warning' title='Edit Mapel'><i class=\"fa fa-pencil\"></i></a></td>

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


<div id="mdal_frm_mapel" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Form <span id='mode_form'></span></h4>
      </div>
      <div class="modal-body">
        <form class="form" id="frm_mapel">
            <span class="hidden" id="mode_aksi"></span>
            <input type="hidden" id="idmapel" name="idmapel">
            <div class="form-group">
                <input type="text" id="kode_mapel" name='kode_mapel' class='form-control flat' placeholder='Masukkan Kode Mapel'>
            </div>
            <div class="form-group">
                <input type="text" id="nama_mapel" name='nama_mapel' class='form-control' placeholder='Nama Mapel'>
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