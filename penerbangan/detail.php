<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Maskapai.php');
include('classes/Roles.php');
include('classes/Lisensi.php');
include('classes/Crew.php');
include('classes/Template.php');

$detail = new Template('templates/detail.html');
$crew = new Crew($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$crew->open();

$data = nulL;

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($crew->deleteCrew($id) > 0) {
            echo "
					<script>
						alert('Data berhasil dihapus!');
						document.location.href = 'index.php';
					</script>
				";
        } else {
            echo "
					<script>
						alert('Data gagal dihapus!');
						document.location.href = 'detail.php';
					</script>
				";
        }
    }
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $crew->getCrewById($id);
        $row = $crew->getResult();

        $data .= '<div class="card-header text-center">
        <h3 class="my-0">Detail ' . $row['crew_nama'] . '</h3>
        </div>
        <div class="card-body text-end">
            <div class="row mb-5">
                <div class="col-3">
                    <div class="row justify-content-center">
                        <img src="assets/images/' . $row['crew_foto'] . '" class="img-thumbnail" alt="' . $row['crew_foto'] . '" width="60">
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="card px-3">
                            <table border="0" class="text-start">
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>' . $row['crew_nama'] . '</td>
                                </tr>
                                <tr>
                                    <td>Maskapai</td>
                                    <td>:</td>
                                    <td>' . $row['maskapai_nama'] . '</td>
                                </tr>
                                <tr>
                                    <td>Jabatan</td>
                                    <td>:</td>
                                    <td>' . $row['roles_nama'] . '</td>
                                </tr>
                                <tr>
                                    <td>Lisensi</td>
                                    <td>:</td>
                                    <td>' . $row['lisensi_nama'] . '</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="add.php?id=' . $row['crew_id'] . '"><button type="button" class="btn btn-success text-white">Ubah Data</button></a>
                <a href="?hapus=' . $row['crew_id'] . '"><button type="button" class="btn btn-danger">Hapus Data</button></a>
            </div>';
    }
}

$crew->close();
$detail->replace('DATA_DETAIL_CREW', $data);
$detail->write();
