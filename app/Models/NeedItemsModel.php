<?php

namespace App\Models;

use CodeIgniter\Model;

class NeedItemsModel extends Model
{
    protected $table = 'items_need';
    protected $primaryKey = 'id';

    protected $allowedFields = ['item_id', 'bundle_id', 'item_name', 'status', 'quantity'];

    protected $useTimestamps = true;

    public function getItemNeeds()
    {
        return $this->join('items', 'items_need.item_id = items.id_items', 'left')
        ->where('items_need.status', 'stock_needed') // Filter status
        ->get()
        ->getResultArray();
        
    }

    public function getItemNeedsHistory()
    {
        return $this->join('items', 'items_need.item_id = items.id_items', 'left')
            // ->where('items_need.status', 'not_checked') // Filter status
            ->get()
            ->getResultArray();
    }
}

