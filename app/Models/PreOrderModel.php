<?php

namespace App\Models;

use CodeIgniter\Model;

class PreOrderModel extends Model
{
    protected $table = 'pre_order';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'supplier_id', 'delivery_note', 'status', 'noted_by', 'checked_by', 'pre_order_date', 'comment', 'check_date']; // Field yang diperbolehkan
    // protected $useTimestamps = false;

    public function getPreOrderWithSuppliers()
    {
        return $this->select('pre_order.*, suppliers.name_suppliers, COUNT(pre_order_items.id) as amount_item')
        ->join('suppliers', 'suppliers.id_suppliers = pre_order.supplier_id')
        ->join('pre_order_items', 'pre_order_items.preorder_id = pre_order.id')
        ->groupBy('pre_order.id')
        ->findAll();
    }
    
    public function getUserOutbounds($userId)
    {
        return $this->where('user_id', $userId)
            ->orderBy('pre_order_date', 'DESC')
            ->findAll();
    }

    // Fungsi untuk mendapatkan detail outbound berdasarkan ID
    public function getOutboundsById($preorderId)
    {
        return $this->find($preorderId);
    }

    public function getOutboundCount()
    {
        return $this->countAll();
    }

    public function getPreOrderCount()
    {
        return $this->countAll();
    }

    // Fungsi untuk mendapatkan detail preorder berdasarkan ID
    public function getPreOrderById($preorderId)
    {
        return $this->find($preorderId);
    }

    public function getPreOrderReport($startDate, $endDate)
    {
        if ($startDate && $endDate) {
            return $this->select('pre_order.*, suppliers.name_suppliers, COUNT(pre_order_items.id) as amount_item')
            ->join('suppliers', 'suppliers.id_suppliers = pre_order.supplier_id')
            ->join('pre_order_items', 'pre_order_items.preorder_id = pre_order.id', 'left')
                ->where('pre_order_date >=', $startDate)
                ->where('pre_order_date <=', $endDate)
                ->groupBy('pre_order.id')
                ->orderBy('pre_order_date', 'DESC')
                ->findAll();
        } else {
            return [];
        }
    }

    public function getInboundReport($startDate, $endDate)
    {
        if ($startDate && $endDate) {
            return $this->select('pre_order.*, suppliers.name_suppliers, 
                              COUNT(pre_order_items.id) as amount_item,
                              createdBy.user_name as created_by_username')
            ->join('suppliers', 'suppliers.id_suppliers = pre_order.supplier_id', 'left')
            ->join('pre_order_items', 'pre_order_items.preorder_id = pre_order.id', 'left')
            ->join('users as createdBy', 'pre_order.created_by = createdBy.user_id', 'left') // Assuming the user who created the pre-order is tracked
            ->where('pre_order_date >=', $startDate)
                ->where('pre_order_date <=', $endDate)
                ->where('pre_order.status', 'completed')
                ->groupBy('pre_order.id, createdBy.user_name') // Group by the necessary columns
                ->orderBy('pre_order_date', 'DESC')
                ->findAll();
        } else {
            return [];
        }
    }

    public function getTotalInboundItems()
    {
        return $this->where('status', 'completed')->countAllResults();
    }

}

