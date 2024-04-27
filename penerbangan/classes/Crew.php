<?php

class Crew extends DB
{
    public $db;
    function getCrewJoin()
    {
        $query = "SELECT * FROM crew JOIN maskapai ON crew.maskapai_id=maskapai.maskapai_id JOIN roles ON crew.roles_id=roles.roles_id JOIN lisensi ON crew.lisensi_id=lisensi.lisensi_id ORDER BY crew.crew_id";

        return $this->execute($query);
    }

    function getCrew()
    {
        $query = "SELECT * FROM crew";
        return $this->execute($query);
    }

    function getCrewById($id)
    {
        $query = "SELECT * FROM crew JOIN maskapai ON crew.maskapai_id=maskapai.maskapai_id JOIN roles ON crew.roles_id=roles.roles_id JOIN lisensi ON crew.lisensi_id=lisensi.lisensi_id WHERE crew_id=$id";
        return $this->execute($query);
    }

    function searchCrew($keyword)
    {
        $query = "SELECT * FROM crew JOIN maskapai ON crew.maskapai_id=maskapai.maskapai_id JOIN roles ON crew.roles_id=roles.roles_id JOIN lisensi ON crew.lisensi_id=lisensi.lisensi_id WHERE crew_nama LIKE '%$keyword%' OR maskapai_nama LIKE '%$keyword%' OR roles_nama LIKE '%$keyword%' OR lisensi_nama LIKE '%$keyword%' ORDER BY crew.crew_id;";
        return $this->execute($query);
    }

    function addCrew($data, $file)
    {
        // ...
        $foto = $file['foto']['name'];
        $crew_foto = $file['foto']['tmp_name'];

        $dir = 'assets/images/' . $foto;

        move_uploaded_file($crew_foto, $dir);
        $crew_nama = $data['nama'];
        $maskapai_id = $data['maskapai'];
        $roles_id = $data['roles'];
        $lisensi_id = $data['lisensi'];

        $query = "INSERT INTO crew VALUES('', '$foto', '$crew_nama' , '$maskapai_id', '$roles_id', '$lisensi_id')";

        return $this->executeAffected($query);
    }

    function updateCrew($id, $data, $file)
    {
        $foto = $file['foto']['name'];
        $crew_foto = $file['foto']['tmp_name'];

        $dir = 'assets/images/' . $foto;

        move_uploaded_file($crew_foto, $dir);
        $crew_nama = $data['nama'];
        $maskapai_id = $data['maskapai'];
        $roles_id = $data['roles'];
        $lisensi_id = $data['lisensi'];

        $query = "UPDATE crew SET 
        crew_foto = '$foto',
        crew_nama = '$crew_nama',
        maskapai_id = '$maskapai_id',
        roles_id = '$roles_id',
        lisensi_id = '$lisensi_id'
        WHERE crew_id = $id";

        return $this->executeAffected($query);
    }

    function deleteCrew($id)
    {
        $query = "DELETE FROM crew WHERE crew_id = $id";
        return $this->executeAffected($query);
    }
}
