<?php

namespace App\Models;

use CodeIgniter\Model;

class InventoryModel extends Model
{
    protected $table = 'inventory';
    protected $primaryKey = 'id_inventory';
    protected $allowedFields = [
        'id_items',
        'name_items',
        'id_suppliers',
        'stock_items',
        'taken_by',
        'noted_by',
        'date_update'
    ];

    // Method untuk mendapatkan stok barang masuk
    public function getInStock()
    {
        // return $this->where('stock_items >', 0)->findAll();

        return $this->select('inventory.*, suppliers.name_suppliers')
        ->join('suppliers', 'inventory.id_suppliers = suppliers.id_suppliers', 'left')
        ->where('stock_items >', 0)
        ->findAll();
    }

    // Method untuk mendapatkan stok barang keluar
    public function getOutStock()
    {
        // return $this->where('stock_items <', 0)->findAll();
        return $this->select('inventory.*, suppliers.name_suppliers')
            ->join('suppliers', 'inventory.id_suppliers = suppliers.id_suppliers', 'left')
            ->where('stock_items <', 0)
            ->findAll();
    }

    public function totalStock()
    {
        $this->db->query('SELECT SUM(stock_items) as total FROM items')->getRowArray();
    }
}
