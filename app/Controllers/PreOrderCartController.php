<?php

namespace App\Controllers;

use App\Models\PreOrderCartModel;
use App\Models\PreOrderModel;
use App\Models\PreOrderItemsModel;
use App\Models\ListItemsModel;
use App\Models\SuppliersModel; // Assuming you have a SuppliersModel
use App\Models\CartModel;
use App\Models\UserModel;

class PreOrderCartController extends BaseController
{
    protected $cartModel;
    protected $itemModel;
    protected $cartItems;
    protected $inventoryModel;
    protected $listitemsModel;
    protected $supplierModel;
    protected $usersModel;
    protected $preOrderCartModel;

    public function __construct()
    { 

        $this->listitemsModel = new ListItemsModel();
        $this->supplierModel = new SuppliersModel();
        $this->usersModel = new UserModel();
        $this->cartModel = new CartModel();
        $this->itemModel = new ListItemsModel();
    }

    public function index()
    {
        // Pastikan pengguna sudah login
        if (!session()->has('user_id')) {
            return redirect()->to('/login');
        }

        $cartModel = new CartModel();
        $itemsModel = new ListItemsModel();
        $preOrderCartModel = new PreOrderCartModel();

        // Ambil data user dari session
        $session = session();
        $user_id = $session->get('user_id');
        $username = $session->get('user_name');
        $user_email = $session->get('user_email');

        // Hitungan di navigasi bar
        $cartItemCount = $cartModel->getCartItemCount();
        $PreOrderCartCount = $preOrderCartModel->getPreorderCartCount();

        // data inti per controller
        $preOrderCartItems = $preOrderCartModel->where('user_id', $user_id)->findAll();

        $data = [
            'title' => 'Cart Items Pre Order',
            'subtitle' => '',
            'username' => $session->get('user_name'), // Mengambil username dari session
            'user_email' => $session->get('user_email'), // Mengambil useremail dari session
            'pocount' => $PreOrderCartCount,
            'cartcount' => $cartItemCount,
            'preOrderCartItems' => []
        ];

        foreach ($preOrderCartItems as $preOrderCartItem) {
            $item = $itemsModel->find($preOrderCartItem['item_id']);
            $data['preOrderCartItems'][] = [
                'id' => $preOrderCartItem['id'],
                'item' => $item,
                'quantity' => $preOrderCartItem['quantity']
            ];
        }
        return view('pre_order/cart', $data);
    }

    public function add()
    {
        $cartModel = new CartModel();
        $preOrderCartModel = new PreOrderCartModel();
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
        $cartItem = $preOrderCartModel->where('user_id', $user_id)
            ->where('item_id', $item_id)
            ->first();

        if ($cartItem) {
            $cartItem['quantity'] += $quantity;
            $preOrderCartModel->save($cartItem);
        } else {
            $preOrderCartModel->insert([
                'user_id' => $user_id,
                'item_id' => $item_id,
                'cartcount' => $cartItemCount,
                'quantity' => $quantity
            ]);
        }

        return redirect()->to('/pre_order/cart')->with('success', 'Item added to cart');
    }

    public function checkout()
    {
        $preOrderCartModel = new PreOrderCartModel();
        $preOrderModel = new PreOrderModel();
        $preOrderItemsModel = new PreOrderItemsModel();
        $itemsModel = new ListItemsModel();
        $suppliersModel = new SuppliersModel();

        // Fetch all items in the cart
        $preOrderCart = $preOrderCartModel->findAll();

        if (empty($preOrderCart)) {
            return redirect()->to('/pre_order')->with('message', 'No items in cart for checkout');
        }

        // Create new pre-order
        $preOrderId = $preOrderModel->insert([
            'order_date' => date('Y-m-d'),
            'status' => 'pending',
            'supplier_id' => 1 // Assuming supplier_id is set to a default or selected supplier
        ]);

        foreach ($preOrderCart as $item) {
            $preOrderItemsModel->insert([
                'pre_order_id' => $preOrderId,
                'item_id' => $item['item_id'],
                'quantity' => $item['quantity']
            ]);
        }

        // Clear the cart after checkout
        $preOrderCartModel->truncate();

        // Redirect or notify about the checkout process
        return redirect()->to('/pre_order')->with('message', 'Checkout successful! Your order has been placed.');
    }


    public function remove($id)
    {
        $preOrderCartModel = new PreOrderCartModel();

        try {
            $isDeleted = $preOrderCartModel->removeItem($id);
            if ($isDeleted) {
                return $this->response->setJSON(['success' => true]);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Item not found or could not be deleted']);
            }
        } catch (\Exception $e) {
            // Log the exception
            log_message('error', $e->getMessage());

            return $this->response->setJSON(['success' => false, 'message' => 'An error occurred while deleting the item']);
        }
    }


    public function update_quantity()
    {
        $itemId = $this->request->getPost('id');
        $delta = $this->request->getPost('delta');

        // Ambil database pre_order_cart model
        $preOrderCartModel = new \App\Models\PreOrderCartModel();

        // Cari item di pre_order_cart berdasarkan item ID
        $item = $preOrderCartModel->where('id', $itemId)->first();

        if ($item) {
            // Update jumlah item
            $newQuantity = $item['quantity'] + $delta;

            // Pastikan jumlah item tidak kurang dari 1
            if ($newQuantity < 1) {
                $newQuantity = 1;
            }

            // Perbarui data di database
            $preOrderCartModel->update($itemId, ['quantity' => $newQuantity]);

            // Kirim respon sukses
            return $this->response->setJSON([
                'success' => true,
                'new_quantity' => $newQuantity
            ]);
        }

        // Jika item tidak ditemukan
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Item not found in cart'
        ]);
    }

}
