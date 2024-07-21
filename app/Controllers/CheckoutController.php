<?php

namespace App\Controllers;

use App\Models\CartModel;
use CodeIgniter\Controller;
use App\Models\InventoryModel;
use App\Models\ListItemsModel;
use App\Models\SuppliersModel;
use App\Models\OutboundModel;
use App\Models\OutboundItemModel;
use App\Models\UserModel;

class CheckoutController extends Controller
{
    protected $cartItem;
    protected $inventoryModel;
    protected $listitemsModel;
    protected $supplierModel;
    protected $outboundModel;
    protected $outboundItemModel;
    protected $usersModel;

    public function __construct()
    {

        $this->listitemsModel = new ListItemsModel();
        $this->inventoryModel = new InventoryModel();
        $this->supplierModel = new SuppliersModel();
        $this->usersModel = new UserModel();
        $this->outboundModel = new OutboundModel();
        $this->outboundItemModel = new OutboundItemModel();
    }

     public function getUsers()
    {
        $usersModel = new UserModel();
        $users = $usersModel->findAll();
        return $this->response->setJSON($users);
    }

    public function index()
    {

        $cartModel = new CartModel();
        $itemModel = new ListItemsModel();

        $user_id = session()->get('user_id');
        $cartItems = $cartModel->where('user_id', $user_id)->findAll();
        $cartItemCount = $cartModel->getCartItemCount();
        $session = session();
        $listitems = $this->listitemsModel->getTotalStock();
        $limitsitems = $this->listitemsModel->getLowStockItems();
        $lowStockItems = $itemModel->getLowStockItemsNotif();


        $data = [
            'title' => 'Checkout',
            'username' => $session->get('user_name'), // Mengambil username dari session
            'user_email' => $session->get('user_email'), // Mengambil useremail dari session
            'totalstock_items' => $listitems,
            'lowstock_itemsItems' => $limitsitems,
            'lowStockItems' => $lowStockItems,
            'cartcount' => $cartItemCount,
            'cartItems' => []
        ];

        foreach ($cartItems as $cartItem) {
            $item = $itemModel->find($cartItem['item_id']);
            $data['cartItems'][] = [
                'id' => $cartItem['id'],
                'item' => $item,
                'quantity' => $cartItem['quantity']
            ];
        }

        return view('checkout', $data);
    }

    public function process()
    {
        $session = session();
        $cartModel = new CartModel();
        $outboundModel = new OutboundModel();
        $outboundItemModel = new OutboundItemModel();
        $itemModel = new ListItemsModel();

        $user_id = session()->get('user_id');
        $cartItems = $cartModel->where('user_id', $user_id)->findAll();
        $id_users = $this->request->getPost('recipient_name'); // cari username dengan inputan id username
        // $name_users = $this->usersModel->find($id_users)['user_name']; // Hasil pencarian username dengan id users

        if (empty($cartItems)) {
            return redirect()->to('/cart');
        }

        $orderId = $outboundModel->insert([
            'user_id' => $user_id,
            'recipient_id' => $id_users,
        ]);

        foreach ($cartItems as $cartItem) {
            $item = $itemModel->find($cartItem['item_id']);
            $outboundItemModel->insert([
                'order_id' => $orderId,
                'item_id' => $cartItem['item_id'],
                'quantity' => $cartItem['quantity'],
            ]);

            // Update stock_items
            $item['stock_items'] -= $cartItem['quantity'];
            $itemModel->save($item);
        }

        // Clear cart
        $cartModel->where('user_id', $user_id)->delete();

        return redirect()->to('/order/success');
    }

}
