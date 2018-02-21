<?php
session_start();
include 'conf/db.php';
// nip=&password=&level=
$user = strip_tags($_POST['nip']);
$pass = md5(strip_tags($_POST['password']));
$level = strip_tags($_POST['level']);
// echo $_POST['password'];


// echo $qry_table;
$sql = "SELECT * FROM user WHERE uname = '$user'";
$result = mysqli_query($conn, $sql);

if ( mysqli_num_rows($result) > 0 ){
	$r=mysqli_fetch_assoc($result);
	if ($level !== $r['level']) {
		echo 'invalid_level';
		return false;
	}
	if ( $r['password'] == $pass) {
		$_SESSION['user'] = $user;
		$_SESSION['level'] = $level;
		echo 'valid';
	} else {
		echo 'invalid';
	}
} else {
	echo 'no_user';
}



?>