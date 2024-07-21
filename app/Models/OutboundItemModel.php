<?php

namespace App\Models;

use CodeIgniter\Model;

class OutboundItemModel extends Model
{
    protected $table = 'outbounds_items'; // Nama tabel yang baru
    protected $primaryKey = 'id'; // Primary key tabel
    protected $allowedFields = ['outbound_id', 'item_id', 'quantity']; // Field yang diperbolehkan

    // Fungsi untuk mendapatkan item outbound berdasarkan ID outbound
    public function getItemsByOutboundId($outboundId)
    {
        return $this->select('outbounds_items.*, items.name_items, items.description, items.image')
            ->join('items', 'outbounds_items.item_id = items.id_items')
            ->where('outbounds_items.outbound_id', $outboundId)
            ->findAll();
    }
}
