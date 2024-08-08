<?php

namespace App\Controllers;

use App\Models\CartModel;
use CodeIgniter\Controller;
use App\Models\ListItemsModel;
use App\Models\SuppliersModel;
use App\Models\OrderModel;
use App\Models\OrderItemModel;
use App\Models\OutboundModel;
use App\Models\OutboundItemModel;
use App\Models\UserModel;
use App\Models\PreOrderModel;
use App\Models\PreOrderCartModel;

class CartController extends Controller
{
    protected $cartModel;
    protected $cartItems;
    protected $itemModel;
    protected $listitemsModel;
    protected $suppliersModel;
    protected $orderModel;
    protected $orderitemModel;
    protected $outboundModel;
    protected $outboundItemModel;
    protected $usersModel;
    protected $preOrderModel;
    protected $preOrderCartModel;

    public function __construct()
    {

        $this->listitemsModel = new ListItemsModel();
        $this->suppliersModel = new SuppliersModel();
        $this->outboundModel = new OutboundModel();
        $this->outboundItemModel = new OutboundItemModel();
        $this->usersModel = new UserModel();
        $this->cartModel = new CartModel();
        $this->itemModel = new ListItemsModel();
        $this->preOrderModel = new PreOrderModel();
        $this->preOrderCartModel = new PreOrderCartModel();

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

        $user_id = session()->get('user_id');
        $cartItems = $cartModel->where('user_id', $user_id)->findAll();

        // Ambil data user dari session
        $session = session();
        $user_id = $session->get('user_id');
        $username = $session->get('user_name');
        $user_email = $session->get('user_email');

        // Hitungan di dashboard
        $cartItemCount = $cartModel->getCartItemCount(); 
        $PreOrderCartCount = $preOrderCartModel->getPreorderCartCount();

        // Data untuk view
        $data = [
            'title' => 'Cart Items Outbound',
            'subtitle' => '',
            'username' => $username,
            'user_email' => $user_email,
            'pocount' => $PreOrderCartCount,
            'cartcount' => $cartItemCount,
            'cartItems' => []
        ];

        foreach ($cartItems as $cartItem) {
            $item = $itemsModel->find($cartItem['item_id']);
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

        try {
            $isDeleted = $cartModel->removeItem($id);
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
        $cartModel = new CartModel();
        $id = $this->request->getPost('id');
        $delta = $this->request->getPost('delta');

        $item = $cartModel->find($id);
        if ($item) {
            $newQuantity = $item['quantity'] + $delta;
            if ($newQuantity > 0) {
                $cartModel->update($id, ['quantity' => $newQuantity]);
                return $this->response->setJSON(['success' => true, 'new_quantity' => $newQuantity]);
            } else {
                $cartModel->delete($id);
                return $this->response->setJSON(['success' => true, 'new_quantity' => 0]);
            }
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Item not found']);
        }
    }
}
