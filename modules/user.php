<?php

$action = isset($_GET['act'])?$_GET['act']:null;
switch($action) {
    case 'view_user':
        $show_user = mysqli_query($conn, "SELECT * FROM user");
        if (mysqli_num_rows($show_user) < 1 ) {
            echo "No Data";
        } else {
            ?>
            <div class="box">
                <div class="box-header">
                    <h1>Data Pengguna</h1>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="tbl_user" class="table table-bordered dataTable" role="grid">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0">No</th>
                                    <th class="sorting_asc" tabindex="1">User Name</th>
                                    <th class="sorting_asc" tabindex="2">Nama</th>
                                    <th class="sorting_asc hidden-xs" tabindex="3">Email</th>
                                    <th class="sorting_asc hidden-xs" tabindex="4">Telp/HP</th>
                                    <th class="sorting_asc hidden-xs" tabindex="5">Status</th>
                                    <th class="sorting_asc" tabindex="6">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
            <?php
            $no=1;
            while($user = mysqli_fetch_assoc($show_user)) {
                echo "
                    <tr>
                        <td>$no</td>
                        <td class='uname'><span >$user[uname]</span></td>
                        <td>$user[nama]</td>
                        <td class='hidden-xs'>$user[email]</td>
                        <td class='hidden-xs'>$user[hp]</td>
                        <td class='hidden-xs'>"; echo $user['isActive'] == 0? 'Tidak Aktif' : 'Aktif';
                  echo "</td>
                        <td>";
                        echo $user['isActive'] == 0? "<a href='#' class='activate_user' title='Aktifkan User'><i class='fa fa-check'></i></a>" : "<a href='#' class='deactivate_user' title='Non-aktifkan User'><i class='fa fa-close active'></i></a>";
                  echo " | <a href='#' class='edit_user' title='Edit User'><i class=\"fa fa-pencil\"></i></a></td>
                    </tr>
                ";
                $no++;
            } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php
        }
    break;

    ## Tambah User

    case "add_user":
        ?>
        <div class="box">
            <div class="box-header">
                <h4>Tambah User <i class="fa fa-user-plus"></i></h4>
            </div>
            <div class="box-body">
                <form id="frm_add_user">
                    <div class="form-group">
                        <input type="text" class="form-control flat" id="nip" name="nip" placeholder="Usernama / NIP" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control flat" id="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control flat" id="nama" name="nama" placeholder="Nama Lengkap" required>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control flat" id="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control flat" id="hp" name="hp" placeholder="No. HP" required>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary flat" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        <?php
    break;
    ## Default Action
    default:
        echo "Aksi Untuk User";
    break;
}

?>

<div id="mdal_edit_user" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit User <span id='username'></span></h4>
      </div>
      <div class="modal-body">
        <form action="" class="form" id="frm_edit_user">
            <div class="form-group">
                <input type="text" id="edit_uname" name='edit_uname' class='form-control flat' placeholder='Username/NIP'>
            </div>
            <div class="form-group">
                <input type="text" id="edit_password" name='edit_password' class='form-control' placeholder='Password'>
            </div>
            <div class="form-group">
                <input type="text" id="edit_nama" name='edit_nama' class='form-control' placeholder='Nama'>
            </div>
            <div class="form-group">
                <input type="email" id="edit_email" name='edit_email' class='form-control' placeholder='email'>
            </div>
            <div class="form-group">
                <input type="text" id="edit_hp" name='edit_hp' class='form-control' placeholder='No. HP'>
            </div>
            <div class="form-group">
                <button class="btn btn-success center-block" type='submit' id='btn_update_user'>Perbarui</button>
            </div>
            
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
      </div>
    </div>

  </div>
</div>