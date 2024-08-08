<?php

namespace App\Models;

use CodeIgniter\Model;

class InboundItemsModel extends Model
{
    protected $table = 'inbound_items'; // Nama tabel
    protected $primaryKey = 'id'; // Primary key
    // protected $allowedFields = ['actual', 'status', 'preorder_item_id', 'inbound_id']; // Field yang boleh diisi
    protected $allowedFields = ['inbound_id', 'item_id', 'quantity', 'actual', 'status', 'preorder_item_id' ]; // Field yang boleh diisi
    // Jika Anda ingin menambahkan fitur seperti timestamps, Anda bisa menambahkannya seperti ini:
    // protected $useTimestamps = true;
    // // protected $createdField  = 'created_at';
    // // protected $updatedField  = 'updated_at';
}
