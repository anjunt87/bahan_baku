<?php

namespace App\Models;

use CodeIgniter\Model;

class CartModel extends Model
{
    protected $table = 'cart';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'item_id', 'quantity'];
    
    public function getCartItemCount()
    {
        return $this->countAll();
    }
}
