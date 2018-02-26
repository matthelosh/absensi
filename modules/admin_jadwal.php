<?php
    $action = isset($_GET['act'])?$_GET['act']:null;

    switch($action) {
        default:
        ?>
            <div class="box">
                    <div class="box-header">
                        <h1>Jadwal Pembelajaran </h1>
                        <div class="btn-group">
                            <a href="#" class="btn btn-danger btn-small" id="btn_add_jadwal">
                                <i class="fa fa-plus"></i>
                                Tambah Jadwal
                            </a>
                            <a href="#" class="btn btn-success btn-small">
                                <i class="fa fa-download"></i>
                                Download XLS
                            </a>
                        </div>
                        
                    </div>
        <?php
        $sql = "SELECT * FROM jadwal";
        $qry = mysqli_query($conn, $sql);
        if (mysqli_num_rows($qry) < 1) {
            echo 'Belum ada data Jadwal';
        } else {
            ?>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="tbl_jadwal" class="table table-bordered dataTable" role="grid">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc hidden-xs" tabindex="1">No</th>
                                        <th class="sorting_asc" tabindex="2">Hari</th>
                                        <th class="sorting_asc " tabindex="3">Guru Pengajar</th>
                                        <th class="sorting_asc" tabindex="4">Mata Pelajaran</th>
                                        <th class="sorting_asc" tabindex="5">Kelas</th>
                                        <th class="sorting_asc" tabindex="6">Jam Ke</th>
                                    </tr>
                                </thead>
                                <tbody>
            <?php
            while($jadwal = mysqli_fetch_assoc($qry)) {
                echo "
                    <tr>
                        <td class='kode_jadwal hidden-xs'>$jadwal[id]</td>
                        <td>$jadwal[hari]</td>
                        <td class=''>";
                            $get_guru = mysqli_query($conn, "SELECT nama FROM user WHERE uname='$jadwal[kode_guru]'");
                            $guru = mysqli_fetch_assoc($get_guru);
                            echo $guru['nama'];
                        echo "
                        </td><td>";
                        
                            $get_mapel = mysqli_query($conn, "SELECT mapel FROM mapel WHERE kode_mapel='$jadwal[kode_mapel]'");
                            $mapel = mysqli_fetch_assoc($get_mapel);
                            echo $mapel['mapel'];
                        echo "
                        </td><td>";
                            $get_kelas = mysqli_query($conn, "SELECT kelas FROM kelas WHERE kode_kelas='$jadwal[kode_kelas]'");
                            $kelas = mysqli_fetch_assoc($get_kelas);
                            echo $kelas['kelas'];
                        
                        echo "</td><td>$jadwal[jamke]</td></tr>";
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