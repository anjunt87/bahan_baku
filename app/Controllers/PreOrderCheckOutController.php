<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use App\Models\CartModel;
use CodeIgniter\Controller;
use App\Models\ListItemsModel;
use App\Models\SuppliersModel;
use App\Models\OutboundModel;
use App\Models\OutboundItemModel;
use App\Models\UserModel;
use App\Models\PreOrderModel;
use App\Models\PreOrderItemsModel;
use App\Models\PreOrderCartModel;

class PreOrderCheckOutController extends ResourceController
{
    protected $cartModel;
    protected $itemModel;
    protected $listitemsModel;
    protected $suppliersModel;
    protected $outboundModel;
    protected $outboundItemModel;
    protected $usersModel;
    protected $preOrderModel;
    protected $preOrderCartModel;

    public function __construct()
    {
        $this->cartModel = new CartModel();
        $this->itemModel = new ListItemsModel();
        $this->listitemsModel = new ListItemsModel();
        $this->suppliersModel = new SuppliersModel();
        // $this->orderModel = new OrderModel();
        // $this->orderitemModel = new OrderItemModel();
        $this->outboundModel = new OutboundModel();
        $this->outboundItemModel = new OutboundItemModel();
        $this->usersModel = new UserModel();
        $this->preOrderModel = new PreOrderModel();
        $this->preOrderCartModel = new PreOrderCartModel();
    }

    public function getUsers()
    {
        $users = $this->usersModel->findAll();
        return $this->response->setJSON($users);
    }

    public function getSuppliers()
    {
        $suppliers = $this->suppliersModel->findAll();
        return $this->response->setJSON($suppliers);
    }

    public function getSupplierContact()
    {
        $supplierId = $this->request->getVar('supplier_id');

        $supplierModel = new SuppliersModel();
        $supplier = $supplierModel->find($supplierId);

        return $this->response->setJSON($supplier);
    }


    public function index()
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/login');
        }

        $session = session();
        $user_id = $session->get('user_id');
        $username = $session->get('user_name');
        $user_email = $session->get('user_email');

        $cartItemCount = $this->cartModel->getCartItemCount();
        $preOrderCartCount = $this->preOrderCartModel->getPreorderCartCount();

        $cartItems = $this->preOrderCartModel->where('user_id', $user_id)->findAll();

        $data = [
            'title' => 'Pre-Order Checkout',
            'subtitle' => '',
            'username' => $username,
            'user_email' => $user_email,
            'pocount' => $preOrderCartCount,
            'cartcount' => $cartItemCount,
            'cartItems' => []
        ];

        foreach ($cartItems as $cartItem) {
            $item = $this->itemModel->find($cartItem['item_id']);
            $data['cartItems'][] = [
                'id' => $cartItem['id'],
                'item' => $item,
                'quantity' => $cartItem['quantity']
            ];
        }

        return view('pre_order/checkout', $data);
    }

    public function saveOrder()
    {
        $orderData = $this->request->getJSON(true);

        // Debugging: Lihat data yang diterima
        log_message('debug', 'Order Data: ' . json_encode($orderData));

        $orderModel = new PreOrderModel();
        $orderItemsModel = new PreOrderItemsModel();
        $orderCartModel = new PreOrderCartModel();

        // Ambil data user dari session
        $session = session();
        $user_id = $session->get('user_id');

        // Buat data order
        $order = [
            'user_id' => $user_id,
            'supplier_id' => $orderData['supplier_id'],
            'status' => 'process'
        ];

        // Simpan data order dan ambil ID yang baru saja diinsert
        $orderId = $orderModel->insert($order);

        // Debugging: Lihat ID pesanan yang baru saja diinsert
        log_message('debug', 'Order ID: ' . $orderId);

        if (!$orderId) {
            // Log error jika gagal menyimpan order
            log_message('error', 'Failed to save order: ' . json_encode($orderModel->errors()));
            return $this->response->setJSON(['success' => false]);
        }

        // Simpan item-item yang terkait dengan pesanan
        foreach ($orderData['items'] as $item) {
            $orderItemData = [
                'preorder_id' => $orderId,
                'item_id' => $item['id'],
                'quantity' => $item['amount']
            ];

            if (!$orderItemsModel->insert($orderItemData)) {
                // Log error jika gagal menyimpan
                log_message('error', 'Failed to save order item: ' . json_encode($orderItemsModel->errors()));
            } else {
                // Log data yang berhasil disimpan
                log_message('debug', 'Order item saved: ' . json_encode($orderItemData));
            }
        }

        // Clear cart jika diperlukan
        $orderCartModel->where('user_id', $user_id)->delete();

        return $this->response->setJSON(['success' => true]);
    }


}
