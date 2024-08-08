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

    public function getOutboundCount()
    {
        return $this->countAll();
    }

    public function getOutboundReport($startDate, $endDate)
    {
        if ($startDate && $endDate) {
            return $this->select('outbounds.*, notedBy.user_name as noted_by_username, recipient.user_name as recipient_username, COUNT(outbounds_items.id) as amount_item')
                ->join('users as notedBy', 'outbounds.user_id = notedBy.user_id', 'left')
                ->join('users as recipient', 'outbounds.recipient_id = recipient.user_id', 'left')
                ->join('outbounds_items', 'outbounds_items.outbound_id = outbounds.id', 'left')
                ->where('outbounds.outbound_date >=', $startDate)
                ->where('outbounds.outbound_date <=', $endDate)
                ->groupBy('outbounds.id, notedBy.user_name, recipient.user_name')  // Tambahkan kolom-kolom lain yang digunakan dalam SELECT
                ->orderBy('outbounds.outbound_date', 'DESC')
                ->findAll();
        } else {
            return [];
        }
    }



}
