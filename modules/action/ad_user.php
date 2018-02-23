<?php
include '../../conf/db.php';

$mode = isset($_GET['mod'])?$_GET['mod']:null;

switch($mode) {
    default:
        echo "Module Administrasi User";
    break;

    case "add":
        $uname = $_POST['nip'];
        $password = md5($_POST['password']);
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $hp = $_POST['hp'];

        $sql = "INSERT INTO user(uname, password, nama, email, hp)
                            VALUES('$uname', '$password', '$nama', '$email', '$hp')";
        $qry = mysqli_query($conn, $sql);

        if(!$qry) {
            echo mysqli_connect_error();
        } else {
            echo 'User berhasil di smipan';
        }
    break;
    case "edit":
        $uname = $_POST['uname'];
        $sql = "SELECT * FROM user WHERE uname = '$uname'";
        $qry = mysqli_query($conn, $sql);
        $user = mysqli_fetch_assoc($qry);
        print_r(json_encode($user));
    break;
    case "update":
        $uname = $_POST['edit_uname'];
        $password = md5($_POST['edit_password']);
        $nama = $_POST['edit_nama'];
        $email = $_POST['edit_email'];
        $hp = $_POST['edit_hp'];

        // Update Password
        if(isset($password)) {
            $sql = "update user set uname = '$uname',
                                    password = '$password',
                                    nama = '$nama',
                                    email = '$email',
                                    hp = '$hp'
                    WHERE uname = '$uname'";
            $qry = mysqli_query($conn, $sql);

            if(!$qry) {
                echo mysqli_connect_error();
            } else {
                echo 'User berhasil di perbarui';
            }
        } else {
            $sql = "update user set uname = '$uname',
                                    nama = '$nama',
                                    email = '$email',
                                    hp = '$hp'
                    WHERE uname = '$uname'";
            $qry = mysqli_query($conn, $sql);

            if(!$qry) {
                echo mysqli_connect_error();
            } else {
                echo 'User berhasil diperbarui';
            }
        }
    break;
    case "deactivate":
        $uname = $_POST['uname'];
        $sql = "UPDATE user set isActive = 0 WHERE uname = '$uname'";
        $qry = mysqli_query($conn, $sql);

        if(!$qry) {
            echo mysqli_connect_error();
        } else {
            echo 'User berhasil dinon-aktifkan';
        }
    break;
    case "activate":
        $uname = $_POST['uname'];
        $sql = "UPDATE user set isActive = 1 WHERE uname = '$uname'";
        $qry = mysqli_query($conn, $sql);

        if(!$qry) {
            echo mysqli_connect_error();
        } else {
            echo 'User berhasil diaktifkan';
        }
    break;
}
?>