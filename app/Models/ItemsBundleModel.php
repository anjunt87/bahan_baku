<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemsBundleModel extends Model
{
    protected $table = 'items_bundles';
    protected $primaryKey = 'id';
    protected $allowedFields = ['bundle_name','status', 'created_at', 'updated_at'];

    // Set timestamps to true if you want the model to manage created_at and updated_at automatically
    protected $useTimestamps = true;

    public function getBundledItems()
    {
        // Menggabungkan tabel items_bundles, items_need, dan items
        return $this->select('items_bundles.*, items_need.*')
                    ->join('items_need', 'items_bundles.id = items_need.bundle_id')
                    ->findAll();
    }

    public function getBundledItemsCount()
    {
        return $this->db->table('items_need')
        ->select('bundle_id, COUNT(DISTINCT item_id) AS jumlah_item_berbeda')
        ->groupBy('bundle_id')
        ->get()
            ->getResultArray();
    }

    // ItemBundleModel.php
    public function getBundleByBundleId($id)
    {
        return $this->select('items_bundles.*, items_need.*, items.name_items')
        ->join('items_need', 'items_bundles.id = items_need.bundle_id')
        ->join('items', 'items_need.item_id = items.id_items')
        ->where('items_need.bundle_id', $id)
            // ->where('items_need.status', 'pending') // Tambahkan filter status
            ->findAll();
    }
    
}
