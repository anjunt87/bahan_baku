<?php

namespace App\Models;

use CodeIgniter\Model;

class PreOrderItemsModel extends Model
{
    protected $table = 'pre_order_items';
    protected $primaryKey = 'id';
    protected $allowedFields = ['preorder_id', 'item_id', 'quantity', 'actual', 'status']; // Field yang diperbolehkan
    // protected $useTimestamps = false;

    // Fungsi untuk mendapatkan item preorder berdasarkan ID preorder
    public function getItemsByPreorderId($preorderId)
    {
        return $this->select('pre_order_items.*, items.name_items, items.description, items.image')
        ->join('items', 'pre_order_items.item_id = items.id_items')
        ->where('pre_order_items.preorder_id', $preorderId)
            ->findAll();
    }

    
}
 