<?php

namespace App\Controllers;

use App\Models\ListItemsModel;

class NotificationsController extends BaseController
{
    public function getLowStockNotifications()
    {
        $itemModel = new ListItemsModel();
        $lowStockItems = $itemModel->where('stock_items <', 10)->findAll(); // Contoh: Stok kurang dari 10

        return $this->response->setJSON($lowStockItems);
    }
}
