<?php
    $menu;
    if ($level == '1' ) {
        $menu = '1';
    } else if( $level == '2') {
        $menu = '2';
    }

    $sql = "SELECT * FROM menu WHERE level = '$menu'";
    $res = mysqli_query($conn, $sql);

    while($m = mysqli_fetch_assoc($res)) {
        echo $m['menu'].'<br />';
    }
?>