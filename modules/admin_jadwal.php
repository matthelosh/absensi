<?php
    $action = isset($_GET['act'])?$_GET['act']:null;

    switch($action) {
        default:
        ?>
            <div class="box box-jadwal">
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
                            <table id="tbl_jadwal" class="table table-bordered dataTable" role="grid">
                                <thead>
                                    <tr role="row">
                                        <th class="hidden"></th>
                                        <th class="sorting_asc hidden-xs" tabindex="1">No</th>
                                        <th class="sorting_asc" tabindex="2">Hari</th>
                                        <th class="sorting_asc " tabindex="3">Guru Pengajar</th>
                                        <th class="sorting_asc" tabindex="4">Mata Pelajaran</th>
                                        <th class="sorting_asc" tabindex="5">Kelas</th>
                                        <th class="sorting_asc" tabindex="6">Jam Ke</th>
                                        <th class="sorting_asc" tabindex="">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_jadwal">
            <?php
            $no = 1;
            while($jadwal = mysqli_fetch_assoc($qry)) {
                echo "
                    <tr>
                        <td class='kode_jadwal hidden'>$jadwal[id]</td>
                        <td class='hidden-xs'> ".$no; 
                        echo $jadwal['isActive'] == 0? "<i class='fa fa-close' style='color: red'></i>" : "<i class='fa fa-check' style='color:green'></i>";
                        echo "
                        </td><td>$jadwal[hari]</td>
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
                            $get_kelas = mysqli_query($conn, "SELECT nama_rombel FROM rombel WHERE id='$jadwal[kode_kelas]'");
                            $kelas = mysqli_fetch_assoc($get_kelas);
                            echo $kelas['nama_rombel'];
                        
                        echo "</td><td>$jadwal[jamke]</td>
                            <td>";
                            echo $jadwal['isActive'] == 0? "<a href='#' class='activate_jadwal btn btn-success btn-small' title='Aktifkan Jadwal'><i class='fa fa-check'></i></a>" : "<a href='#' class='deactivate_jadwal btn btn-danger btn-small' title='Non-aktifkan Jadwal'><i class='fa fa-close active'></i></a>";
                            echo "&nbsp;<a href='#' class='btn btn_edit_jadwal btn btn-warning' title='Edit Jadwal'><i class=\"fa fa-pencil\"></i></a>

                            </td>
                        
                        </tr>";
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


<div id="mdal_frm_jadwal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Form <span id='mode_form'></span></h4>
      </div>
      <div class="modal-body">
        <form class="form" id="frm_jadwal">
            <span class="hidden" id="mode_aksi"></span>
            <input type="hidden" id="idjadwal" name="idjadwal">
            <div class="form-group">
                <select name="hari" id="hari" class="form-control flat"></select>
            </div>
            <div class="form-group" data-id="guru">
                <input type="hidden" id="nip_guru" class="val_cont">
                <input type="text" id="nama_guru" name='nama_guru' class='form-control autocomplete' placeholder='Nama Guru' data-id="nama_guru" required>
                <span class="auto_list"></span>
            </div>
            <div class="form-group" data-id="mapel">
                <input type="hidden" id="kode_mapel" class="val_cont">
                <input type="text" id="nama_mapel" name='nama_mapel' class='form-control autocomplete' placeholder='Nama Mapel' data-id="nama_mapel" required>
                <span class="auto_list"></span>
            </div>
            <div class="form-group" data-id="rombel">
                <input type="hidden" id="kode_kelas" class="val_cont">
                <input type="text" id="nama_kelas" name='nama_kelas' class='form-control autocomplete' placeholder='Nama Rombel' data-id="nama_kelas" required>
                <span class="auto_list"></span>
            </div>
            <div class="form-group">
                <input type="text" id="jamke" name='jamke' class='form-control' placeholder='Jam Ke' required>
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