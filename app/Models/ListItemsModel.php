<?php

namespace App\Models;

use CodeIgniter\Model;

class ListItemsModel extends Model
{
    protected $table = 'items';
    protected $primaryKey = 'id_items';
    protected $allowedFields = ['name_items', 'description', 'stock_items', 'image'];

    public function saveItems($data)
    {
        return $this->save($data);
    }

    public function getTotalStock()
    {
        return $this->select('items.id_items, items.name_items, COALESCE(SUM(inventory.stock_items), 0) as total_stock')
            ->join('inventory', 'items.id_items = inventory.id_items', 'left')
            ->groupBy('items.id_items, items.name_items')
            ->orderBy('total_stock', 'DESC')
            ->findAll();
    }

    public function getTotalStockById($id_items)
    {
        return $this->select('items.id_items, items.name_items, COALESCE(SUM(inventory.stock_items), 0) as total_stock')
            ->join('inventory', 'items.id_items = inventory.id_items', 'left')
            ->where('items.id_items', $id_items)
            ->groupBy('items.id_items, items.name_items')
            ->first();
    }

    public function getLowStockItems($threshold = 20)
    {
        return $this->select('items.id_items, items.name_items, COALESCE(SUM(inventory.stock_items), 0) as total_stock')
            ->join('inventory', 'items.id_items = inventory.id_items', 'left')
            ->groupBy('items.id_items, items.name_items')
            ->having('total_stock <', $threshold)
            ->findAll();
    }

    public function getLowStockItemsNotif($threshold = 20)
    {
        return $this->where('stock_items <', $threshold)->findAll();
    }
}
