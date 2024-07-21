<?php

namespace App\Models;

use CodeIgniter\Model;

class PreOrderItemModel extends Model
{
    protected $table = 'pre_order_items';
    protected $primaryKey = 'id';
    protected $allowedFields = ['pre_order_id', 'item_id', 'quantity'];

    public function getPreOrderItems($id)
    {
        $builder = $this->db->table('pre_order_items');
        $builder->join('items', 'pre_order_items.item_id = items.id');
        $builder->where('pre_order_items.pre_order_id', $id);
        return $builder->get()->getResultArray();
    }
}
