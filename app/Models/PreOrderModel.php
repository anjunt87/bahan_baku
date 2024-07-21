<?php

namespace App\Models;

use CodeIgniter\Model;

class PreOrderModel extends Model
{
    protected $table = 'pre_orders';
    protected $primaryKey = 'id';
    protected $allowedFields = ['order_date', 'supplier_id', 'status', 'noted_by', 'received_by'];

    public function getPreOrder($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        }
        return $this->where(['id' => $id])->first();
    }
}
