<?php

namespace App\Models;

use CodeIgniter\Model;

class SuppliersModel extends Model
{
    protected $table = 'suppliers';
    protected $primaryKey = 'id_suppliers';
    protected $allowedFields = ['name_suppliers', 'production_suppliers', 'contact_suppliers'];

    public function saveSuppliers($data)
    {
        return $this->save($data);
    }

    public function getSuppliersnameById($supplierId)
    {
        return $this->where('id_suppliers', $supplierId)->first()['name_suppliers'] ?? 'Unknown'; // Mengambil username berdasarkan ID
    }
}
