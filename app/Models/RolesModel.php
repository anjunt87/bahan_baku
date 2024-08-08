<?php

namespace App\Models;

use CodeIgniter\Model;

class RolesModel extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'role_id';
    protected $allowedFields = ['role_name'];

    // Method to get all roles
    public function getRoles()
    {
        return $this->findAll();
    }

    // Method to get role by id
    public function getRoleById($id)
    {
        return $this->find($id);
    }

    // Method to add a new role
    public function addRole($data)
    {
        return $this->insert($data);
    }

    // Method to update role
    public function updateRole($id, $data)
    {
        return $this->update($id, $data);
    }

    // Method to delete role
    public function deleteRole($id)
    {
        return $this->delete($id);
    }
}
