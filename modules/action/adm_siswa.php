<?php
include '../../conf/db.php';

$mode = isset($_GET['mod'])?$_GET['mod']:null;

switch($mode) {
    case "deactivate":
        $kode_siswa = $_POST['nis'];
        $sql = "UPDATE siswa set isActive = '0' WHERE nis = '$kode_siswa'";
        $qry = mysqli_query($conn, $sql);
        if (!$qry) {
            echo 'error';
        } else {
            echo "siswa ".$kode_siswa." berhasil dinon-aktifkan";
        }
    break;
    case "activate":
        $kode_siswa = $_POST['nis'];
        $sql = "UPDATE siswa set isActive = '1' WHERE nis = '$kode_siswa'";
        $qry = mysqli_query($conn, $sql);
        if (!$qry) {
            echo 'error';
        } else {
            echo "siswa ".$kode_siswa." berhasil diaktifkan";
        }
    break;
    case "edit_siswa":
        $nis = $_POST['nis'];
        $sql = "SELECT * FROM siswa WHERE nis ='$nis'";
        $qry = mysqli_query($conn, $sql);
        $siswa = mysqli_fetch_assoc($qry);
        if ($siswa ) {
            print_r(json_encode($siswa));
        } else {
            $response = array("status"=>"error", "msg"=>"Tidak ditemukan data siswa");
            print_r(json_encode($response));
        }
        
    break;
    case "add_siswa":
        $nis = $_POST['nis'];
        $nama = $_POST['nama_siswa'];
        $kelas = $_POST['kode_kelas'];
        $hp = $_POST['hp'];
        $qry_cek = mysqli_query($conn,"SELECT * FROM siswa WHERE nis = '$nis'");
        if ( mysqli_num_rows($qry_cek) > 0 ) {
            $response = array("status"=>"ko", "kode"=>"dbl_data", "msg"=>"Ditemukan data siswa ganda.");
            print_r(json_encode($response));
        } else {
            $sql = "INSERT INTO siswa (nis, nama, kelas, hp) VALUES('$nis', '$nama', '$kelas', '$hp')";
            $qry = mysqli_query($conn, $sql);
            if (!$qry) {
                $response = array("status"=>"ko", "kode"=>"db_error", "msg"=>"Gagal menambah siswa");
                print_r(json_encode($response));
            } else {
                $response = array("status"=>"ok", "kode"=>"sip", "msg"=>"Sukses");
                print_r(json_encode($response));
            }
        }
    break;

    case "update_siswa":
        $idlama = $_POST['idsiswa'];
        $kode_siswa = $_POST['nis'];
        $siswa = $_POST['nama_siswa'];
        $kelas = $_POST['kode_kelas'];
        $hp = $_POST['hp'];

        // $response = array("status"=>"tes", "kode"=>"testing", "msg"=>$siswa);
        //         print_r(json_encode($response));

        $qry_update = mysqli_query($conn, "UPDATE siswa SET nis = '$kode_siswa',
                                                            nama = '$siswa',
                                                            kelas = '$kelas',
                                                            hp = '$hp'
                    WHERE nis = '$idlama'");
        
        if (!$qry_update) {
            $response = array("status"=>"ko", "kode"=>"db_error", "msg"=>"Gagal memperbarui siswa");
                print_r(json_encode($response));
        } else {
            $response = array("status"=>"ok", "kode"=>"sip", "msg"=>"siswa berhasil diperbarui");
                print_r(json_encode($response));
        }
    break;
}

?>