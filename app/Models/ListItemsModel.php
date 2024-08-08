<?php

namespace App\Models;

use CodeIgniter\Model;

class ListItemsModel extends Model 
{
    protected $table = 'items';
    protected $primaryKey = 'id_items';
    protected $allowedFields = ['name_items', 'previous_stock', 'stock_items','description', 'image', 'updated_at'];
    // protected $useTimestamps = true;

    public function saveItems($data)
    {
        return $this->save($data);
    }

    public function getStock($itemId)
    {
        return $this->where('id', $itemId)->first();
    }

    public function updateStock($itemId, $quantity)
    {
        $item = $this->find($itemId);
        if ($item) {
            $newStock = $item['stock_items'] + $quantity;
            $this->update($itemId, ['stock_items' => $newStock]);
        }
    }
    public function getStock2($item_id)
    {
        return $this->where('id_items', $item_id)->first()['stock_items'];
    }

    public function getStockReport($startDate, $endDate)
    {
        if ($startDate && $endDate) {
            return $this->where('updated_at >=', $startDate)
                ->where('updated_at <=', $endDate)
                ->orderBy('updated_at', 'DESC')
                ->findAll();
        } else {
            return [];
        }
    }
    
}   
