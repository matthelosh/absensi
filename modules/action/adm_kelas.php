<?php
include '../../conf/db.php';

$mode = isset($_GET['mod'])?$_GET['mod']:null;

switch($mode) {
    case "get_kelas":
        $mod = $_POST['mode'];
        
        
        if ($mod == 'add') {
            $get_kelas = mysqli_query($conn, "SELECT * FROM kelas ORDER BY kode_kelas DESC");
            echo "<option value=0>--Pilih Kelas--</option>";
            while($k = mysqli_fetch_assoc($get_kelas)) {
                echo "<option value=$k[kode_kelas]>$k[kelas]</option>";
            }
        } else if ($mod == 'edit') {
            $nis = $_POST['nis'];
            $kelas = $_POST['kelas'];
            $get_kelas = mysqli_query($conn, "SELECT * FROM kelas ORDER BY kode_kelas DESC");
            echo "<option value=0>--Pilih Kelas--</option>";
            while($k = mysqli_fetch_assoc($get_kelas)) {
                if($k['kode_kelas'] == $kelas ) {
                    $selected = "Selected";
                } else {
                    $selected = "";
                }
                echo '<option value = "'.$k['kode_kelas'].'" '.$selected.'>'.$k['kelas'].'</option>';

            }
        }
        
       
        print_r($kelas);
        
    break;
    case "deactivate":
        $kode_kelas = $_POST['kode_kelas'];
        $sql = "UPDATE kelas set isActive = '0' WHERE kode_kelas = '$kode_kelas'";
        $qry = mysqli_query($conn, $sql);
        if (!$qry) {
            echo 'error';
        } else {
            echo "Kelas ".$kode_kelas." berhasil dinon-aktifkan";
        }
    break;
    case "activate":
        $kode_kelas = $_POST['kode_kelas'];
        $sql = "UPDATE kelas set isActive = '1' WHERE kode_kelas = '$kode_kelas'";
        $qry = mysqli_query($conn, $sql);
        if (!$qry) {
            echo 'error';
        } else {
            echo "Kelas ".$kode_kelas." berhasil diaktifkan";
        }
    break;
    case "edit_kelas":
        $kode_kelas = $_POST['kode_kelas'];
        $sql = "SELECT * FROM kelas WHERE kode_kelas ='$kode_kelas'";
        $qry = mysqli_query($conn, $sql);
        $kelas = mysqli_fetch_assoc($qry);
        if ($kelas ) {
            print_r(json_encode($kelas));
        } else {
            $response = array("status"=>"error", "msg"=>"Tidak ditemukan data kelas");
            print_r(json_encode($response));
        }
        
    break;
    case "add_kelas":
        $kode_kelas = $_POST['kode_kelas'];
        $kelas = $_POST['nama_kelas'];
        $wali = $_POST['wali_kelas'];
        $qry_cek = mysqli_query($conn,"SELECT * FROM kelas WHERE kode_kelas = '$kode_kelas'");
        if ( mysqli_num_rows($qry_cek) > 0 ) {
            $response = array("status"=>"ko", "kode"=>"dbl_data", "msg"=>"Ditemukan data kelas ganda.");
            print_r(json_encode($response));
        } else {
            $sql = "INSERT INTO kelas(id, kode_kelas, kelas, wali_kelas) VALUES('', '$kode_kelas', '$kelas', '$wali')";
            $qry = mysqli_query($conn, $sql);
            if (!$qry) {
                $response = array("status"=>"ko", "msg"=>"Gagal menambah kelas");
                print_r(json_encode($response));
            } else {
                $response = array("status"=>"ok", "msg"=>"Sukses");
                print_r(json_encode($response));
            }
        }
    break;

    case "update_kelas":
        $idlama = $_POST['idkelas'];
        $kode_kelas = $_POST['kode_kelas'];
        $kelas = $_POST['nama_kelas'];
        $wali = $_POST['wali_kelas'];

        $qry_update = mysqli_query($conn, "UPDATE kelas SET kode_kelas = '$kode_kelas',
                                                            kelas = '$kelas',
                                                            wali_kelas = '$wali'
                    WHERE kode_kelas = '$idlama'");
        
        if (!$qry_update) {
            $response = array("status"=>"ko", "msg"=>"Gagal memperbarui Kelas");
                print_r(json_encode($response));
        } else {
            $response = array("status"=>"ok", "msg"=>"Kelas berhasil diperbarui");
                print_r(json_encode($response));
        }
    break;
}

?>