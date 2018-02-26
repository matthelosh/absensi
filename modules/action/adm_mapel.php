<?php
include '../../conf/db.php';

$mode = isset($_GET['mod'])?$_GET['mod']:null;

switch($mode) {
    case "deactivate":
        $kode_mapel = $_POST['kode_mapel'];
        $sql = "UPDATE mapel set isActive = '0' WHERE kode_mapel = '$kode_mapel'";
        $qry = mysqli_query($conn, $sql);
        if (!$qry) {
            echo 'error';
        } else {
            echo "mapel ".$kode_mapel." berhasil dinon-aktifkan";
        }
    break;
    case "activate":
        $kode_mapel = $_POST['kode_mapel'];
        $sql = "UPDATE mapel set isActive = '1' WHERE kode_mapel = '$kode_mapel'";
        $qry = mysqli_query($conn, $sql);
        if (!$qry) {
            echo 'error';
        } else {
            echo "mapel ".$kode_mapel." berhasil diaktifkan";
        }
    break;
    case "edit_mapel":
        $kode_mapel = $_POST['kode_mapel'];
        $sql = "SELECT * FROM mapel WHERE kode_mapel ='$kode_mapel'";
        $qry = mysqli_query($conn, $sql);
        $mapel = mysqli_fetch_assoc($qry);
        if ($mapel ) {
            print_r(json_encode($mapel));
        } else {
            $response = array("status"=>"error", "msg"=>"Tidak ditemukan data mapel");
            print_r(json_encode($response));
        }
        
    break;
    case "add_mapel":
        $kode_mapel = $_POST['kode_mapel'];
        $mapel = $_POST['nama_mapel'];
        $qry_cek = mysqli_query($conn,"SELECT * FROM mapel WHERE kode_mapel = '$kode_mapel'");
        if ( mysqli_num_rows($qry_cek) > 0 ) {
            $response = array("status"=>"ko", "kode"=>"dbl_data", "msg"=>"Ditemukan data mapel ganda.");
            print_r(json_encode($response));
        } else {
            $sql = "INSERT INTO mapel(id_mapel, kode_mapel, mapel) VALUES('', '$kode_mapel', '$mapel')";
            $qry = mysqli_query($conn, $sql);
            if (!$qry) {
                $response = array("status"=>"ko", "kode"=>"db_error", "msg"=>"Gagal menambah mapel");
                print_r(json_encode($response));
            } else {
                $response = array("status"=>"ok", "kode"=>"sip", "msg"=>"Sukses");
                print_r(json_encode($response));
            }
        }
    break;

    case "update_mapel":
        $idlama = $_POST['idmapel'];
        $kode_mapel = $_POST['kode_mapel'];
        $mapel = $_POST['nama_mapel'];

        $qry_update = mysqli_query($conn, "UPDATE mapel SET kode_mapel = '$kode_mapel',
                                                            mapel = '$mapel'
                    WHERE kode_mapel = '$idlama'");
        
        if (!$qry_update) {
            $response = array("status"=>"ko", "kode"=>"db_error", "msg"=>"Gagal memperbarui mapel");
                print_r(json_encode($response));
        } else {
            $response = array("status"=>"ok", "kode"=>"sip", "msg"=>"mapel berhasil diperbarui");
                print_r(json_encode($response));
        }
    break;
}

?>