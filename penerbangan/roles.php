<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Roles.php');
include('classes/Template.php');

$view = new Template('templates/tabel.html');
$roles = new Roles($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$roles->open();
$roles->getRoles();

if (!isset($_GET['id'])) {
    if (isset($_POST['submit'])) {
        if ($roles->addRoles($_POST) > 0) {
            echo "<script>
                alert('Data berhasil ditambahkan!');
                document.location.href = 'roles.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambahkan!');
                document.location.href = 'roles.php';
            </script>";
        }
    }

    $btn = 'Tambah';
    $title = 'Tambah';
}

$mainTitle = 'Roles';
$formLabel = 'roles';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Roles</th>
<th scope="row">Aksi</th>
</tr>';
$data = null;
$no = 1;

while ($rls = $roles->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $rls['roles_nama'] . '</td>
    <td style="font-size: 22px;">
        <a href="roles.php?id=' . $rls['roles_id'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;<a href="roles.php?hapus=' . $rls['roles_id'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            if ($roles->updateRoles($id, $_POST) > 0) {
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'roles.php';
            </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'roles.php';
            </script>";
            }
        }

        $roles->getRolesById($id);
        $row = $roles->getResult();

        $dataUpdate = $row['roles_nama'];
        $btn = 'Simpan';
        $title = 'Ubah';

        $view->replace('DATA_VAL_UPDATE', $dataUpdate);
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($roles->deleteRoles($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'roles.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'roles.php';
            </script>";
        }
    }
}

$roles->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->write();
