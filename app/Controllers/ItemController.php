<?php

namespace App\Controllers;

use App\Models\CartModel;
use CodeIgniter\Controller;
use App\Models\ListItemsModel;


class ItemController extends Controller
{
    protected $cartItem;
    protected $inventoryModel;
    protected $listitemsModel;
    protected $supplierModel;
    protected $outboundModel;
    protected $outbounditemModel;
    protected $usersModel;

    public function index()
    {
        $cartModel = new CartModel();
        $itemsModel = new ListItemsModel();

        $session = session();
        $itemModel = new ListItemsModel();
        $cartItemCount = $cartModel->getCartItemCount();
        $lowStockItems = $itemsModel->getLowStockItemsNotif();
        $items = $itemModel->findAll();

        $data = [
            'title' => 'List Items',
            'username' => $session->get('user_name'), // Mengambil username dari session
            'user_email' => $session->get('user_email'),
            'cartcount' => $cartItemCount,
            'lowStockItems' => $lowStockItems,
            'items' => $items
        ];

        return view('items', $data);
    }
}
