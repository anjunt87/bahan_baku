<?php

namespace App\Models;

use CodeIgniter\Model;

class CartModel extends Model
{
    protected $table = 'cart';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'item_id', 'quantity'];

    // public function getCartItemCount($user_id)
    // {
    //     return $this->where('user_id', $user_id)->countAllResults();
    // }

    // public function getCartItemCount()
    // {
    //     return $this->countAll();
    // }

    
    public function getCartItemCount()
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