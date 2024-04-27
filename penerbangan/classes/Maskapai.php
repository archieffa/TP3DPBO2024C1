<?php

class Maskapai extends DB
{
    function getMaskapai()
    {
        $query = "SELECT * FROM maskapai ORDER BY maskapai_nama ASC";
        return $this->execute($query);
    }

    function getMaskapaiById($id)
    {
        $query = "SELECT * FROM maskapai WHERE maskapai_id=$id";
        return $this->execute($query);
    }

    function addMaskapai($data)
    {
        $nama = $data['nama'];
        $query = "INSERT INTO maskapai VALUES('', '$nama')";
        return $this->executeAffected($query);
    }

    function updateMaskapai($id, $data)
    {
        $nama = $data['nama'];

        $query = "UPDATE maskapai SET
            maskapai_nama = '$nama'
            WHERE maskapai_id = $id";

        return $this->executeAffected($query);
    }

    function deleteMaskapai($id)
    {
        $query = "DELETE FROM maskapai WHERE maskapai_id=$id";
        return $this->executeAffected($query);
    }
}
