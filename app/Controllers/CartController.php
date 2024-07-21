<?php

namespace App\Controllers;

use App\Models\CartModel;
use CodeIgniter\Controller;
use App\Models\InventoryModel;
use App\Models\ListItemsModel;
use App\Models\SuppliersModel;
use App\Models\OrderModel;
use App\Models\OrderItemModel;
use App\Models\UserModel;

class CartController extends Controller
{
    protected $cartModel;
    protected $itemModel;
    protected $cartItems;
    protected $inventoryModel;
    protected $listitemsModel;
    protected $supplierModel;
    protected $orderModel;
    protected $orderitemModel;
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

        $cartModel = new CartModel();
        $itemModel = new ListItemsModel();

        $cartItemCount = $cartModel->getCartItemCount();

        $user_id = session()->get('user_id');
        $cartItems = $cartModel->where('user_id', $user_id)->findAll();

        $session = session();
        $listitems = $this->listitemsModel->getTotalStock();
        $limitsitems = $this->listitemsModel->getLowStockItems();
        $lowStockItems = $itemModel->getLowStockItemsNotif();


        $data = [
            'title' => 'Cart Items',
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

        return view('cart', $data);
    }

    public function add()
    {
        $cartModel = new CartModel();
        $itemModel = new ListItemsModel();
        
        $cartItemCount = $cartModel->getCartItemCount();

        // Pastikan session sudah dimulai
        if (!session()->has('user_id')) {
            return redirect()->to('/login'); // Redirect ke halaman login jika user belum login
        }

        $user_id = session()->get('user_id');
        $item_id = $this->request->getPost('item_id');
        $quantity = $this->request->getPost('quantity');

        // Validasi input
        if (!$item_id || !$quantity || $quantity <= 0) {
            return redirect()->to('/items')->with('error', 'Invalid item or quantity');
        }

        // Cek ketersediaan item
        $item = $itemModel->find($item_id);
        if (!$item) {
            return redirect()->to('/items')->with('error', 'Item not found');
        }

        // Cek ketersediaan stok
        if ($item['stock_items'] < $quantity) {
            return redirect()->to('/items')->with('error', 'Not enough stock_items available');
        }

        // Cek apakah item sudah ada di keranjang
        $cartItem = $cartModel->where('user_id', $user_id)
            ->where('item_id', $item_id)
            ->first();

        if ($cartItem) {
            $cartItem['quantity'] += $quantity;
            $cartModel->save($cartItem);
        } else {
            $cartModel->insert([
                'user_id' => $user_id,
                'item_id' => $item_id,
                'cartcount' => $cartItemCount,
                'quantity' => $quantity
            ]);
        }

        return redirect()->to('/cart')->with('success', 'Item added to cart');
    }

    public function remove($id)
    {
        $cartModel = new CartModel();
        $cartModel->delete($id);

        return redirect()->to('/cart');
    }
}
