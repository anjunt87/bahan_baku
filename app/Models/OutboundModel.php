<?php

namespace App\Models;

use CodeIgniter\Model;

class OutboundModel extends Model
{
    protected $table = 'outbounds'; // Nama tabel yang baru
    protected $primaryKey = 'id'; // Primary key tabel
    protected $allowedFields = ['user_id', 'recipient_id', 'outbound_date']; // Field yang diperbolehkan

    // Fungsi untuk mendapatkan semua outbound pengguna
    public function getUserOutbounds($userId)
    {
        return $this->where('user_id', $userId)
            ->orderBy('outbound_date', 'DESC')
            ->findAll();
    }

    // Fungsi untuk mendapatkan detail outbound berdasarkan ID
    public function getOutboundById($outboundId)
    {
        return $this->find($outboundId);
    }
}
