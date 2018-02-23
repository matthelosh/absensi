<?php
$action = isset($_GET['act'])?$_GET['act']:null;
switch($action) {
    
    case "add_kelas":
        echo "Tambah Kelas";
    break;
    
    default:
        echo "Kelas";
    break;
}
?>