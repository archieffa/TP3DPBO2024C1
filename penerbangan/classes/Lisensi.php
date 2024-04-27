<?php

class Lisensi extends DB
{
    function getLisensi()
    {
        $query = "SELECT * FROM lisensi ORDER BY lisensi_nama ASC";
        return $this->execute($query);
    }

    function getLisensiById($id)
    {
        $query = "SELECT * FROM lisensi WHERE lisensi_id=$id";
        return $this->execute($query);
    }

    function addLisensi($data)
    {
        $nama = $data['nama'];
        $query = "INSERT INTO lisensi VALUES('', '$nama')";
        return $this->executeAffected($query);
    }

    function updateLisensi($id, $data)
    {
        $nama = $data['nama'];
        $query = "UPDATE lisensi SET
            lisensi_nama = '$nama'
            WHERE lisensi_id = $id";

        return $this->executeAffected($query);
    }

    function deleteLisensi($id)
    {
        $query = "DELETE FROM lisensi WHERE lisensi_id=$id";
        return $this->executeAffected($query);
    }
}
