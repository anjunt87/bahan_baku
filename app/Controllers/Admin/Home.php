<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\CartModel;
use CodeIgniter\Controller;
use App\Models\InventoryModel;
use App\Models\ListItemsModel;
use App\Models\SuppliersModel;
use App\Models\OutboundModel;
use App\Models\OutboundItemModel;
use App\Models\UserModel;

class Home extends BaseController
{
    protected $cartModel;
    protected $itemModel;
    protected $cartItems;
    protected $inventoryModel;
    protected $listitemsModel;
    protected $supplierModel;
    protected $outboundModel;
    protected $outbounditemModel;
    protected $usersModel;

    public function __construct()
    {

        $this->listitemsModel = new ListItemsModel();
        $this->inventoryModel = new InventoryModel();
        $this->supplierModel = new SuppliersModel();
        $this->usersModel = new UserModel();
        $this->cartModel = new CartModel();
        $this->itemModel = new ListItemsModel();
    }

    public function index()
    {
        $itemsModel = new ListItemsModel();

        $session = session();
        $cartModel = new CartModel();
        $cartItemCount = $cartModel->getCartItemCount();
        $lowStockItems = $itemsModel->getLowStockItemsNotif();

        $data = [
            'title' => 'Admin Dashboard',
            'users' => '100',
            'username' => $session->get('user_name'), // Mengambil username dari session
            'user_email' => $session->get('user_email'), // Mengambil username dari session
            'cartcount' => $cartItemCount,
            'lowStockItems' => $lowStockItems
        ];
        return view('admin/index', $data);
    }
}
