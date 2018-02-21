<?php
    $menu;
    if ($level == '1' ) {
        $menu = '1';
    } else if( $level == '2') {
        $menu = '2';
    }
?>
    <ul class="sidebar-menu" data-widget="tree">
    <li class="header">MENU UTAMA:</li>
<?php
    $sql = "SELECT * FROM menu WHERE level = '$menu' AND parent='0'";
    $res = mysqli_query($conn, $sql);

    while($m = mysqli_fetch_assoc($res)) {
        $m_id = $m['id'];
        $smq = mysqli_query($conn, "SELECT * FROM menu WHERE parent = '$m_id'");
        if( mysqli_num_rows($smq) < 1 ) {
            echo "
                <li class=\"treeview\">
                    <a href=\"$m[link]\"><i class=\"$m[icon]\"></i> $m[menu]</a>
                </li>
            ";
        } else {
            echo "
            <li class=\"treeview\">
                
                <a href=\"$m[link]\"><i class=\"$m[icon]\"></i> <span>$m[menu]</span>
                <span class=\"pull-right-container\">
                  <i class=\"fa fa-angle-left pull-right\"></i>
                </span>
                </a>
                
                <ul class=\"treeview-menu\">";
                    while($sm = mysqli_fetch_assoc($smq)) {
                        echo "
                            <li>
                                <a href=\"$sm[link]\"><i class=\"$sm[icon]\"></i> $sm[menu]</a>
                            </li>
                        ";
                    }
            echo "
                </ul>
            </li>
            ";
        }
    }
?>
<!-- <li><a href="?p=xtkj1"><i class="fa fa-circle-o"></i> Absen Kelas X TKJ 1</a></li> -->
    
</ul>