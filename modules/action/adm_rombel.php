<?php
include '../../conf/db.php';

$mode = isset($_GET['mod'])?$_GET['mod']:null;

switch($mode) {
    case "get_rombel":
        $id = $_POST['idRombel'];
        $qry = mysqli_query($conn, "SELECT * FROM rombel ORDER BY id DESC");
        echo "<option value='0'>--Pilih Rombel--</option>";
        while($r = mysqli_fetch_assoc($qry)) {
            if($r['id'] == $id ) {
                $selected = "Selected";
            } else {
                $selected = "";
            }

            echo '<option value = "'.$r['id'].'" '.$selected.'>'.$r['nama_rombel'].'</option>';
        }
    break;
    case "add_rombel":
        $id = $_POST['idrombel'];
        $nama_rombel = $_POST['nama_rombel'];
        $wali = $_POST['nip_wali'];
        $cek_rombel = mysqli_query($conn, "SELECT * FROM rombel WHERE id = '$id'");
        if ( mysqli_num_rows($cek_rombel) > 0 ) {
            $response = array("status"=>"ko", "kode"=>"dbl_data", "msg"=>"Data Rombel ".$nama_rombel." sudah ada");
            print_r(json_encode($response));
        } else {
            $simpan = mysqli_query($conn,"INSERT INTO rombel (id, nama_rombel, wali) VALUES ('$id', '$nama_rombel', '$wali')");
            if ($simpan) {
                $response = array("status"=>"ok", "kode"=>"saved", "msg"=>"Data Rombel ".$nama_rombel." berhasil disimpan");
                print_r(json_encode($response));
            } else {
                $response = array("status"=>"ko", "kode"=>"db_error", "msg"=>"Data Rombel ".$nama_rombel." Gagal disimpan");
                print_r(json_encode($response));
            }
        }
    break;
    case "edit_rombel":
        $id = $_POST['idRombel'] ;
        $get_rombel = mysqli_query($conn, "SELECT * FROM rombel WHERE id = '$id'");
        $rombel = mysqli_fetch_assoc($get_rombel);
        print_r(json_encode($rombel));
    break;

    case "upd_rombel":
        $idlama = $_POST['koderombel'];
        $id = $_POST['idrombel'];
        $nama_rombel = $_POST['nama_rombel'];
        $wali = $_POST['nip_wali'];
        
        $simpan = mysqli_query($conn,"UPDATE rombel set id = '$id',
                                               nama_rombel = '$nama_rombel',
                                                      wali = '$wali'
                  WHERE id = '$idlama'");
        if ($simpan) {
            $response = array("status"=>"ok", "kode"=>"saved", "msg"=>"Data Rombel ".$nama_rombel." berhasil disimpan");
            print_r(json_encode($response));
        } else {
            $response = array("status"=>"ko", "kode"=>"db_error", "msg"=>"Data Rombel ".$nama_rombel." Gagal disimpan");
            print_r(json_encode($response));
        }
        
    break;
    case "activate":
        $id = $_POST['id'];
        $act = mysqli_query($conn, "UPDATE rombel set isActive = '1' WHERE id = '$id'");
        if ($act) {
            echo 'Rombel '.$id. ' telah aktif';
        } else {
            echo 'Rombel '.$id.' gagal diaktifkan';
        }
    break;
    case "deactivate":
        $id = $_POST['id'];
        $act = mysqli_query($conn, "UPDATE rombel set isActive = '0' WHERE id = '$id'");
        if ($act) {
            echo 'Rombel '.$id. ' telah di-non-aktif';
        } else {
            echo 'Rombel '.$id.' gagal di-non-aktifkan';
        }
    break;
    case "get_member":
        $id = $_POST['idRombel'];
        $get_member = mysqli_query($conn, "SELECT * FROM siswa WHERE kelas = '$id' ORDER BY nis ASC");
        while($member = mysqli_fetch_assoc($get_member)) {
            echo "<tr><td>$member[nis]</td><td>$member[nama]</td><td><input type='checkbox' class='member_check' data-nis-member='$member[nis]'></td></tr>";
        }
    break;
    case "get_siswas":
        $get_siswas = mysqli_query($conn, "SELECT * FROM siswa WHERE kelas = null OR kelas = '' ORDER BY nis");
        if (mysqli_num_rows($get_siswas) > 0 ) {
            while($siswa = mysqli_fetch_assoc($get_siswas)) {
                echo "<tr><td class='$siswa[nis]'><span class='coba'>$siswa[nis]</span></td><td>$siswa[nama]</td><td><input type='checkbox' class='siswa_check' data-nis-siswa='$siswa[nis]'></td></tr>";
            }
        } else {
            echo '<h1>Tidak ada siswa di luar rombel</h1>';
        }
      
        // echo 'Siswa';
    break;
    case "insert_to_rombel":
        $idRombel = $_POST['idRombel'];
        $nis = $_POST['nis'];
        $nis_count = count($nis);
        foreach($nis as $key=>$nis) {
            $sql = "UPDATE siswa SET kelas = '$idRombel' WHERE nis = '$nis'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo 'sukses';
            }
        
        }
    break;
    case "rem_from_rombel":
        $idRombel = $_POST['idRombel'];
        $nis = $_POST['nis'];
        $nis_count = count($nis);
        foreach($nis as $key=>$nis) {
            $sql = "UPDATE siswa SET kelas = '' WHERE nis = '$nis'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo 'sukses';
            }
        
        }
    break;
    case "move_from_rombel":
        $idRombel = $_POST['idRombel'];
        $nis = $_POST['nis'];
        $nis_count = count($nis);
        foreach($nis as $key=>$nis) {
            $sql = "UPDATE siswa SET kelas = '$idRombel' WHERE nis = '$nis'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo 'sukses';
            }
        
        }
        // echo $nis_count;
        // print_r($nis);
    break;
}
?>