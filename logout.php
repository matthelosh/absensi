<?php
session_start();

$_SESSION['user'] = '';
$_SESSION['level'] = '';
unset($_SESSION['user']);
unset($_SESSION['level']);
session_unset();
session_destroy();
header("location: login.php");
?>