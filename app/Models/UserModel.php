<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $allowedFields = ['role_id','department_id', 'division_id', 'user_name', 'user_email','user_password', 'user_created_at'];
    protected $returnType = 'array';
    protected $useTimestamps = false;

    public function addUser($data)
    {
        return $this->insert($data);
    }

    public function updateUser($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteUser($id)
    {
        return $this->db->table('users')->delete(['user_id' => $id]);
    }

    public function getUserByUsername($username)
    {
        return $this->where('user_name', $username)->first();
    }

    public function getUserRole($userId)
    {
        return $this->join('roles', 'roles.role_id = users.role_id')
            ->where('users.user_id', $userId)
            ->first();
    }

    public function getUsersByRole($role_id)
    {
        return $this->where('role_id', $role_id)->findAll();
    }

    public function getUsernameById($id)
    {
        return $this->where('user_id', $id)->first()['user_name'] ?? 'Unknown'; // Mengambil username berdasarkan ID
    }

    public function getUsersCount()
    {
        return $this->countAll();
    }
}
