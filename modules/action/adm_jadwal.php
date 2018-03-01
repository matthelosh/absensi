<?php
include '../../conf/db.php';

$mode = isset($_GET['mod'])?$_GET['mod']:null;
$hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        $jml_hari = count($hari);
switch($mode){
    case "get_hari":
        
        echo "<option value='0'>--Pilih Hari--</option>";
        for ($i=0; $i < $jml_hari; $i++) {
            echo "
                <option value=$hari[$i]>$hari[$i]</option>
            ";
        }
    break;

    case "edit_jadwal":
        $id = $_POST['id'];
        $get_jadwal = mysqli_query($conn, "SELECT * FROM jadwal WHERE id = '$id'");
        $jadwal = mysqli_fetch_assoc($get_jadwal);
        

    break;

    case "get_guru":
        $q = $_POST['q'];
        $g_guru = mysqli_query($conn, "SELECT * FROM user WHERE nama LIKE '%$q%'");
        echo "<ul class='ul_auto ul_guru'>";
        while($w = mysqli_fetch_assoc($g_guru)) {
            echo "
                <li><span class='value hidden'>$w[uname]</span> <span class='text'>$w[nama]</span></li>
            ";
        }
        echo "</ul>";
    break;
    case "get_mapel":
        $q = $_POST['q'];
        $g_mapel = mysqli_query($conn, "SELECT * FROM mapel WHERE mapel LIKE '%$q%'");
        echo "<ul class='ul_auto ul_mapel'>";
        while($m = mysqli_fetch_assoc($g_mapel)) {
            echo "
                <li><span class='value'>$m[kode_mapel]</span> | <span class='text'>$m[mapel]</span></li>
            ";
        }
        echo "</ul>";
    break;
    case "get_rombel":
        $q = $_POST['q'];
        $g_rombel = mysqli_query($conn, "SELECT * FROM rombel WHERE nama_rombel LIKE '%$q%'");
        echo "<ul class='ul_auto ul_rombel'>";
        while($r = mysqli_fetch_assoc($g_rombel)) {
            echo "
                <li><span class='value hidden'>$r[id]</span> <span class='text'>$r[nama_rombel]</span></li>
            ";
        }
        echo "</ul>";
    break;
    case "add_jadwal": 
        $hari = $_POST['hari'];
        $nip_guru = $_POST['nip_guru'];
        $kode_mapel = $_POST['kode_mapel'];
        $kode_rombel = $_POST['kode_rombel'];
        $jamke = $_POST['jamke'];
        $ad_jadwal = mysqli_query($conn, "INSERT INTO jadwal(id, hari, kode_guru, kode_mapel, kode_kelas, jamke) VALUES('', '$hari', '$nip_guru', '$kode_mapel', '$kode_rombel', '$jamke')");
        if ($ad_jadwal) {
            $res = array("sukses"=>true, "kode"=>"ok", "msg"=>"Jadwal berhasil disimpan.");
            print_r(json_encode($res));
        }
    break;
    case "deactivate":
        $id = $_POST['id'];
        $sql = "UPDATE jadwal set isActive = '0' WHERE id = '$id'";
        $qry = mysqli_query($conn, $sql);
        if (!$qry) {
            echo 'error';
        } else {
            echo "Jadwal ".$id." berhasil dinon-aktifkan";
        }
    break;
    case "activate":
        $id = $_POST['id'];
        $sql = "UPDATE jadwal set isActive = '1' WHERE id = '$id'";
        $qry = mysqli_query($conn, $sql);
        if (!$qry) {
            echo 'error';
        } else {
            echo "Jadwal ".$id." berhasil diaktifkan";
        }
    break;
    case "get_al_jadwal":
    $qry = mysqli_query($conn, "SELECT * FROM jadwal");
    while($jadwal = mysqli_fetch_assoc($qry)) {
        echo "
            <tr>
                <td class='kode_jadwal hidden-xs'>$jadwal[id] &nbsp; | "; 
                echo $jadwal['isActive'] == 0? "<i class='fa fa-close' style='color: red'></i>" : "<i class='fa fa-check' style='color:green'></i>";
                echo "
                </td><td>$jadwal[hari]</td>
                <td class=''>";
                    $get_guru = mysqli_query($conn, "SELECT nama FROM user WHERE uname='$jadwal[kode_guru]'");
                    $guru = mysqli_fetch_assoc($get_guru);
                    echo $guru['nama'];
                echo "
                </td><td>";
                
                    $get_mapel = mysqli_query($conn, "SELECT mapel FROM mapel WHERE kode_mapel='$jadwal[kode_mapel]'");
                    $mapel = mysqli_fetch_assoc($get_mapel);
                    echo $mapel['mapel'];
                echo "
                </td><td>";
                    $get_kelas = mysqli_query($conn, "SELECT kelas FROM kelas WHERE kode_kelas='$jadwal[kode_kelas]'");
                    $kelas = mysqli_fetch_assoc($get_kelas);
                    echo $kelas['kelas'];
                
                echo "</td><td>$jadwal[jamke]</td>
                    <td>";
                    echo $jadwal['isActive'] == 0? "<a href='#' class='activate_jadwal btn btn-success btn-small' title='Aktifkan Jadwal'><i class='fa fa-check'></i></a>" : "<a href='#' class='deactivate_jadwal btn btn-danger btn-small' title='Non-aktifkan Jadwal'><i class='fa fa-close active'></i></a>";
                    echo "&nbsp;<a href='#' class='btn btn_edit_jadwal btn btn-warning' title='Edit Jadwal'><i class=\"fa fa-pencil\"></i></a>

                    </td>
                
                </tr>";
    }

    break;
}

?>