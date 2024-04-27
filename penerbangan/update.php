<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Maskapai.php');
include('classes/Roles.php');
include('classes/Lisensi.php');
include('classes/Crew.php');
include('classes/Template.php');

// buat instance pengurus
$crew = new Crew($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$crew->open();

$maskapai = new Maskapai($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$maskapai->open();
$maskapai->getMaskapai();

$roles = new Roles($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$roles->open();
$roles->getRoles();

$lisensi = new Lisensi($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$lisensi->open();
$lisensi->getLisensi();

if (isset($_POST['btn-simpan'])) { 
    $data = [
        'fileNameFoto' => $_FILES['fileNameFoto']['name'],
        'nama' => $_POST['nama'],
        'maskapai_id' => $_POST['maskapai'],
        'roles_id' => $_POST['roles'],
        'lisensi_id' => $_POST['lisensi']
    ];

    $file = $_FILES['fotoToUpload'];

    $result = $crew->updateData($id, $data, $file);

    if ($result > 0) {
        echo "<script>
        alert('Data berhasil ditambahkan!');
        document.location.href = 'index.php';
        </script>";
    } else {
        echo '<script>alert("Data gagal ditambahkan!");</script>';
    }
}

$maskapaiData = null;
$rolesData = null;
$lisensiData = null;

while ($mskp = $maskapai->getResult()) {
    $maskapaiData .= '<option value="' . $mskp['maskapai_id'] . '">' . $mskp['maskapai_nama'] . '</option>';
}

while ($rls = $roles->getResult()) {
    $rolesData .= '<option value="' . $rls['roles_id'] . '">' . $rls['roles_nama'] . '</option>';
}

while ($lsns = $lisensi->getResult()) {
    $lisensiData .= '<option value="' . $lsns['lisensi_id'] . '">' . $lsns['lisensi_nama'] . '</option>';
}

$view = new Template('templates/skinformubah.html');

$view->replace('DATA_MASKAPAI', $maskapaiData);
$view->replace('DATA_ROLES', $rolesData);
$view->replace('DATA_LISENSI', $lisensiData);
$view->replace('DATA_BUTTON', "Ubah");

$view->write();