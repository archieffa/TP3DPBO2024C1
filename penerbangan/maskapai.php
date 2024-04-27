<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Maskapai.php');
include('classes/Template.php');

$view = new Template('templates/tabel.html');
$maskapai = new Maskapai($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$maskapai->open();
$maskapai->getMaskapai();

if (!isset($_GET['id'])) {
    if (isset($_POST['submit'])) {
        if ($maskapai->addMaskapai($_POST) > 0) {
            echo "<script>
                alert('Data berhasil ditambahkan!');
                document.location.href = 'maskapai.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambahkan!');
                document.location.href = 'maskapai.php';
            </script>";
        }
    }

    $btn = 'Tambah';
    $title = 'Tambah';
}

$mainTitle = 'Maskapai';
$formLabel = 'maskapai';

$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Maskapai</th>
<th scope="row">Aksi</th>
</tr>';
$data = null;
$no = 1;

while ($mskp = $maskapai->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $mskp['maskapai_nama'] . '</td>
    <td style="font-size: 22px;">
        <a href="maskapai.php?id=' . $mskp['maskapai_id'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;<a href="maskapai.php?hapus=' . $mskp['maskapai_id'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            if ($maskapai->updateMaskapai($id, $_POST) > 0) {
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'maskapai.php';
            </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'maskapai.php';
            </script>";
            }
        }

        $maskapai->getMaskapaiById($id);
        $row = $maskapai->getResult();

        $dataUpdate = $row['maskapai_nama'];
        $btn = 'Simpan';
        $title = 'Ubah';

        $view->replace('DATA_VAL_UPDATE', $dataUpdate);
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($maskapai->deleteMaskapai($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'maskapai.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'maskapai.php';
            </script>";
        }
    }
}

$maskapai->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->write();