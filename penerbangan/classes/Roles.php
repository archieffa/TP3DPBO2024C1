<?php

class Roles extends DB
{
    function getRoles()
    {
        $query = "SELECT * FROM roles ORDER BY roles_nama ASC";
        return $this->execute($query);
    }

    function getRolesById($id)
    {
        $query = "SELECT * FROM roles WHERE roles_id=$id";
        return $this->execute($query);
    }

    function addRoles($data)
    {
        $nama = $data['nama'];
        $query = "INSERT INTO roles VALUES('', '$nama')";
        return $this->executeAffected($query);
    }

    function updateRoles($id, $data)
    {
        $nama = $data['nama'];
        $query = "UPDATE roles SET
            roles_nama = '$nama'
            WHERE roles_id = $id";
        return $this->executeAffected($query);
    }

    function deleteRoles($id)
    {
        $query = "DELETE FROM roles WHERE roles_id=$id";
        return $this->executeAffected($query);
    }
}