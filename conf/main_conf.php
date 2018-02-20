<?php
include 'db.php';

$username;
$foto;

$level = $_SESSION['level'];
$user = $_SESSION['user'];
$qry_table;
$qry_user;

if ($level == '1') {
	$qry_table = 'user';
	$qry_user = 'uname';
} else if ($level = '2') {
	$qry_table = 'guru';
	$qry_user = 'nip';
}

$sql = "SELECT * FROM `$qry_table` WHERE $qry_user = '$user'";
$result = mysqli_query($conn, $sql);

if ( mysqli_num_rows($result) > 0 ){
	$r=mysqli_fetch_assoc($result);
    $username = $r['nama'];
}
$site_name = 'Absensi SMKN 10 Malang';
$page_title = 'Judul Halaman';


?>