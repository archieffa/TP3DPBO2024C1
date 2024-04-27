<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Lisensi.php');
include('classes/Template.php');

$view = new Template('templates/tabel.html');
$lisensi = new Lisensi($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$lisensi->open();
$lisensi->getLisensi();

if (!isset($_GET['id'])) {
    if (isset($_POST['submit'])) {
        if ($lisensi->addLisensi($_POST) > 0) {
            echo "<script>
                alert('Data berhasil ditambahkan!');
                document.location.href = 'lisensi.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambahkan!');
                document.location.href = 'lisensi.php';
            </script>";
        }
    }

    $btn = 'Tambah';
    $title = 'Tambah';
}

$mainTitle = 'Lisensi';
$formLabel = 'lisensi';

$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Lisensi</th>
<th scope="row">Aksi</th>
</tr>';
$data = null;
$no = 1;

while ($lsns = $lisensi->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $lsns['lisensi_nama'] . '</td>
    <td style="font-size: 22px;">
        <a href="lisensi.php?id=' . $lsns['lisensi_id'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;<a href="lisensi.php?hapus=' . $lsns['lisensi_id'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            if ($lisensi->updateLisensi($id, $_POST) > 0) {
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'lisensi.php';
            </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'lisensi.php';
            </script>";
            }
        }

        $lisensi->getLisensiById($id);
        $row = $lisensi->getResult();

        $dataUpdate = $row['lisensi_nama'];
        $btn = 'Ubah';
        $title = 'Ubah';

        $view->replace('DATA_VAL_UPDATE', $dataUpdate);
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($lisensi->deleteLisensi($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'lisensi.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'lisensi.php';
            </script>";
        }
    }
}

$lisensi->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->write();