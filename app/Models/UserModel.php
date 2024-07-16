<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $allowedFields = ['user_name', 'user_email', 'user_password', 'user_created_at', 'role_id'];
    protected $returnType = 'array';
    protected $useTimestamps = false;

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
}
