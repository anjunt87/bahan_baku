<?php

namespace App\Models;

use CodeIgniter\Model;

class DivisionModel extends Model
{
    protected $table = 'division';
    protected $primaryKey = 'id';
    protected $allowedFields = ['department_id', 'name', 'description', 'created_at', 'updated_at'];
    
    public function getDivisionsWithDepartment()
    {
        return $this->select('division.*, department.name as department_name')
            ->join('department', 'division.department_id = department.id')
            ->findAll();
    }
}
