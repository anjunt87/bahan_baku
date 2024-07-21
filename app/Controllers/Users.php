<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\CartModel;
use CodeIgniter\Controller;
use App\Models\InventoryModel;
use App\Models\ListItemsModel;
use App\Models\SuppliersModel;
use App\Models\OrderModel;
use App\Models\OrderItemModel;
use App\Models\UserModel;

class Users extends BaseController
{

    public function getUsers()
    {
        $usersModel = new UserModel();
        $users = $usersModel->findAll();
        return $this->response->setJSON($users);
    }

    // public function index()
    // {
    //     $itemsModel = new ListItemsModel();

    //     $session = session();
    //     $cartModel = new CartModel();
    //     $cartItemCount = $cartModel->getCartItemCount();
    //     $lowStockItems = $itemsModel->getLowStockItemsNotif();

    //     $data = [
    //         'title' => 'Admin Dashboard',
    //         'users' => '100',
    //         'username' => $session->get('user_name'), // Mengambil username dari session
    //         'user_email' => $session->get('user_email'), // Mengambil username dari session
    //         'cartcount' => $cartItemCount,
    //         'lowStockItems' => $lowStockItems
    //     ];
    //     return view('admin/index', $data);
    // }
}
