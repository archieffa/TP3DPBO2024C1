<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Maskapai.php');
include('classes/Roles.php');
include('classes/Lisensi.php');
include('classes/Crew.php');
include('classes/Template.php');

// buat instance crew
$listCrew = new Crew($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
// buka koneksi
$listCrew->open();
// tampilkan data Crew
$listCrew->getCrewJoin();

// cari Crew
if (isset($_POST['btn-cari'])) {
    // methode mencari data Crew
    $listCrew->searchCrew($_POST['cari']);
} else {
    // method menampilkan data Crew
    $listCrew->getCrewJoin();
}

$data = null;
$count = 0;

while ($row = $listCrew->getResult()) {
    // Jika sudah mencapai 3 crew per baris, tambahkan div row baru
    if ($count % 3 == 0) {
        $data .= '<div class="row justify-content-center">';
    }

    // Tambahkan card crew
    $data .= '<div class="col-sm-4 gx-2 gy-3 justify-content-center">' .
        '<div class="card pt-4 px-2 crew-thumbnail">
        <a href="detail.php?id=' . $row['crew_id'] . '">
            <div class="row justify-content-center">
                <img src="assets/images/' . $row['crew_foto'] . '" class="card-img-top" alt="' . $row['crew_foto'] . '">
            </div>
            <div class="card-body">
                <p class="card-text crew-nama my-0">' . $row['crew_nama'] . '</p>
                <p class="card-text maskapai-nama">' . $row['maskapai_nama'] . '</p>
                <p class="card-text roles-nama my-0">' . $row['roles_nama'] . '</p>
                <p class="card-text lisensi-nama my-0">' . $row['lisensi_nama'] . '</p>
            </div>
        </a>
    </div>    
    </div>';

    // Jika sudah mencapai 3 crew per baris, tutup div row
    if (($count + 1) % 3 == 0) {
        $data .= '</div>'; // Tutup div row
    }

    $count++;
}

// Tutup div row terakhir jika jumlah crew tidak habis dibagi 3
if ($count % 3 != 0) {
    $data .= '</div>'; // Tutup div row
}

// tutup koneksi
$listCrew->close();

// buat instance template
$home = new Template('templates/home.html');

// simpan data ke template
$home->replace('DATA_CREW', $data);
$home->write();
