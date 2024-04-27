<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Maskapai.php');
include('classes/Roles.php');
include('classes/Lisensi.php');
include('classes/Crew.php');
include('classes/Template.php');

$view = new Template('templates/add.html');
$crew = new Crew($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$crew->open();
$maskapai = new Maskapai($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$maskapai->open();
$roles = new Roles($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$roles->open();
$lisensi = new Lisensi($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$lisensi->open();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $crew->getCrewById($id);
        $data = $crew->getResult();
        $nama = $data['crew_nama'];
        $foto = $data['crew_foto'];
        $view->replace('DATA_NAMA', $nama);
        $view->replace('DATA_FOTO', $foto);
    }
    if (isset($_POST['btn-save'])) {
        if ($crew->updateCrew($id, $_POST, $_FILES) > 0) {
            echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'index.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'detail.php';
            </script>";
        }
    }
} else {
    if (isset($_POST['btn-save'])) {
        if ($crew->addCrew($_POST, $_FILES) > 0) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'index.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'add.php';
            </script>";
        }
    }
    
    $data['crew_nama'] = "";
    $data['maskapai_id'] = 0;
    $data['roles_id'] = 0;
    $data['lisensi_id'] = 0;
}

$maskapai->getMaskapai();
$roles->getRoles();
$lisensi->getLisensi();

$maskapaiData = null;
while ($mskp = $maskapai->getResult()) {
    $maskapaiData .= '<option value="' . $mskp['maskapai_id'] . '">' . $mskp['maskapai_nama'] . '</option>';
}
$rolesData = null;
while ($rls = $roles->getResult()) {
    $rolesData .= '<option value="' . $rls['roles_id'] . '">' . $rls['roles_nama'] . '</option>';
}
$lisensiData = null;
while ($lsns = $lisensi->getResult()) {
    $lisensiData .= '<option value="' . $lsns['lisensi_id'] . '">' . $lsns['lisensi_nama'] . '</option>';
}

$crew->close();
$maskapai->close();
$roles->close();
$lisensi->close();

$view->replace('DATA_MASKAPAI', $maskapaiData);
$view->replace('DATA_ROLES', $rolesData);
$view->replace('DATA_LISENSI', $lisensiData);
$view->replace('DATA_BUTTON', "Tambah");
$view->write();