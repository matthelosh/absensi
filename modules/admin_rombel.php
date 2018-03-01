<?php
    $action = isset($_GET['act'])?$_GET['act']:null;

    switch($action) {
        default:
        ?>
            <div class="box">
                    <div class="box-header">
                        <h1>Data Rombel </h1>
                        <div class="btn-group">
                            <a href="#" class="btn btn-danger btn-small" id="btn_add_rombel">
                                <i class="fa fa-plus"></i>
                                Tambah Rombel
                            </a>
                            <a href="#" class="btn btn-success btn-small">
                                <i class="fa fa-download"></i>
                                Download XLS
                            </a>
                        </div>
                        
                    </div>
        <?php
        $sql = "SELECT * FROM rombel";
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
                            <table id="tbl_rombel" class="table table-bordered dataTable" role="grid">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0">No</th>
                                        <th class="sorting_asc hidden-xs" tabindex="1">Kode Rombel</th>
                                        <th class="sorting_asc" tabindex="2">Nama Rombel</th>
                                        <th class="sorting_asc" tabindex="3">Wali Kelas</th>
                                        <th class="sorting_asc" tabindex="4">Jml Siswa</th>
                                        <th class="sorting_asc hidden-xs" tabindex="5">Status</th>
                                        <th class="sorting_asc" tabindex="6">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
            <?php
            $no = 1;
            while($rombel = mysqli_fetch_assoc($qry)) {
                
                echo "
                    <tr>
                        <td >$no </td>
                        <td class='idRombel hidden-xs'>$rombel[id]</td>
                        <td>";
                            $get_kelas = mysqli_query($conn,"SELECT * FROM rombel WHERE id = '$rombel[id]'");
                            $kelas = mysqli_fetch_assoc($get_kelas);
                            echo $kelas['nama_rombel'];

                        echo "</td>
                        <td >";
                            $get_wali = mysqli_query($conn,"SELECT * FROM user WHERE uname = '$rombel[wali]'");
                            $wali = mysqli_fetch_assoc($get_wali);
                            echo $wali['nama'];
                        echo "</td>
                        <td >";
                            $get_jml_anggota = mysqli_query($conn, "SELECT * FROM siswa WHERE kelas = '$rombel[id]' AND isActive = '1'");
                            echo $jml_siswa = mysqli_num_rows($get_jml_anggota). ' Orang';
                            

                        echo
                        "<td class='hidden-xs'>";
                        echo $status = $rombel['isActive'] == '0'? 'Tidak Aktif' : 'Aktif';
                        echo "</td>
                        <td>";
                        echo $rombel['isActive'] == 0? "<a href='#' class='activate_rombel btn btn-success btn-small' title='Aktifkan Rombel'><i class='fa fa-check'></i></a>" : "<a href='#' class='deactivate_rombel btn btn-danger btn-small' title='Non-aktifkan Rombel'><i class='fa fa-close active'></i></a>";
                        echo "&nbsp;<a href='#' class='btn btn_edit_rombel btn btn-warning' title='Edit Rombel'><i class=\"fa fa-pencil\"></i></a>
                        <a href='#' class='btn btn-primary btn_mng_member btn-small' title='Tampilkan Anggota Rombel'><i class='fa fa-th-list'></i></td>

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


<div id="mdal_rombel" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">
                    Form <span id="mode_form"></span>
                </h4>
            </div>
            <div class="modal-body">
                <form class="form" id="form_rombel">
                    <span class="hidden" id="mode_aksi"></span>
                    <input type="hidden" id="koderombel" name="koderombel">
                    <div class="form-group">
                        <input type="text" id="idrombel" name="idrombel" class="form-control flat" placeholder="Kode Rombel" required>
                    </div>
                    <div class="form-group">
                        <input type="text" id="nama_rombel" name="nama_rombel" class="form-control flat" placeholder="Nama Rombel" required>
                    </div>
                    <div class="form-group">
                        <input type="hidden" id="nip_wali" name="nip_wali">
                        <input type="text" id="wali" name="wali" class="form-control flat auto_wali" placeholder="Wali Kelas" required>
                        <span id="list_wali"></span>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn flat btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn flat btn-danger" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<div id="mdal_mng_rombel" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Form <span id='mode_form'></span></h4>
      </div>
      <div class="modal-body">
        <div class="row">
            <span class="hidden" id="idRombel"></span>
            <div class="col-sm-6" id="col-anggota">
                <h4>Data Anggota Rombel <span class="member"></span></h4>
                <p class="">Siswa terpilih <span id="member_dipilih">0 Orang</span></p>
                <div class="row">
                    <div class="form-group col-sm-4 ">
                        <select class="form-control" name="get_rombel_mng" id="get_rombel_mng" disabled></select>
                    </div>
                    
                    <div class="btn-group flat  col-sm-8">
                        <button class="btn btn-warning flat" id="move_from_rombel">Pindahkan dari <span class="member"></span></button>
                        <button class="btn btn-danger flat" id="rem_from_rombel">Keluarkan dari <span class="member"></span></button>
                    </div>
                </div>
                
                
                <!-- <select class="form-control" name="get_rombel_mng" id="get_rombel_mng">

                </select> -->
                <!-- <hr> -->
                <table class="table table-bordered ">
                    <thead>
                        <th>NIS</th>
                        <th>Nama</th>
                        <th><label><input type="checkbox" id="pilih_al_members"> Pilih Semua</label></th>
                    </thead>
                    <tbody id="list_member">
                    </tbody>
                </table>
            </div>
            <div class="col-sm-6" id="col-all-siswa">
                <div class="tbl_header">
                    <h4>Siswa belum masuk rombel</h4>
                    <p class="pull-left">Siswa terpilih <span id="siswa_dipilih">0 Orang</span></p>
                    <button class="btn btn-success flat pull-right" id="add_to_rombel">Pindah ke Rombel <span class="member"></span></button>
                </div>
                
                <br>
                <div class="table">
                    <table class="table table-bordered3">
                        <thead>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th><label><input type="checkbox" id="pilih_al_siswas">Pilih Semua</label></th>
                        </thead>
                        <tbody id="list_siswas">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger flat" data-dismiss="modal">Batal</button>
      </div>
    </div>

  </div>