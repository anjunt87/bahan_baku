<?php

namespace App\Models;

use CodeIgniter\Model;

class PreOrderCartModel extends Model
{
    protected $table      = 'pre_order_cart';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'item_id', 'quantity'];

    // public function getPreOrderCount($userId)
    // {
    //     return $this->where('user_id', $userId)->countAllResults();
    // }

    public function getPreorderCartCount()
    {
        $user_id = session()->get('user_id');
        return $this->where('user_id', $user_id)->countAllResults();
    }
    // Fungsi untuk menghapus item dari keranjang berdasarkan ID
    public function removeItem($id)
    {
        // Pastikan $id adalah valid dan merupakan integer
        if (is_numeric($id)) {
            // Hapus item dari tabel pre_order_cart
            return $this->where('id', $id)->delete();
        }

        return false;
    }
    
}
