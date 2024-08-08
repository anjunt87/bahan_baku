<?php

namespace App\Controllers;

use App\Models\PreOrderModel;
use App\Models\PreOrderItemsModel;
use App\Models\PreOrderCartModel;
use App\Models\ListItemsModel;
use App\Models\SuppliersModel; // Assuming you have a SuppliersModel
use App\Models\CartModel;
use CodeIgniter\Controller;
use App\Models\UserModel;

class PreOrderController extends BaseController
{
    protected $cartModel;
    protected $itemModel;
    protected $cartItems;
    protected $listitemsModel;
    protected $supplierModel;
    protected $usersModel;
    protected $preOrderModel;
    protected $preOrderItemsModel;

    public function __construct()
    {

        $this->listitemsModel = new ListItemsModel();
        $this->supplierModel = new SuppliersModel();
        $this->usersModel = new UserModel();
        $this->cartModel = new CartModel();
        $this->itemModel = new ListItemsModel();
        $this->preOrderModel = new PreOrderModel();
        $this->preOrderItemsModel = new PreOrderItemsModel();
        

    }

    public function index()
    {   // Pastikan pengguna sudah login
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
        $items = $itemsModel->findAll();

        $data = [
            'title' => 'List Items Pre Order',
            'subtitle' => '',
            'username' => $session->get('user_name'), // Mengambil username dari session
            'user_email' => $session->get('user_email'),
            'pocount' => $PreOrderCartCount,
            'cartcount' => $cartItemCount,
            'items' => $items
        ];

        return view('pre_order/index', $data);
    }

    // public function create()
    // {
    //     return view('pre_order/create');
    // }

    // public function store()
    // {
    //     $preOrderModel = new PreOrderModel();

    //     $data = [
    //         'order_date' => $this->request->getPost('order_date'),
    //         'status' => $this->request->getPost('status'),
    //         'supplier_id' => $this->request->getPost('supplier_id'),
    //     ];

    //     $preOrderModel->save($data);

    //     return redirect()->to('/pre_order');
    // }

    // public function edit($id)
    // {
    //     $preOrderModel = new PreOrderModel();
    //     $data['preOrder'] = $preOrderModel->find($id);

    //     return view('pre_order/edit', $data);
    // }

    // public function update($id)
    // {
    //     $preOrderModel = new PreOrderModel();

    //     $data = [
    //         'order_date' => $this->request->getPost('order_date'),
    //         'status' => $this->request->getPost('status'),
    //         'supplier_id' => $this->request->getPost('supplier_id'),
    //     ];

    //     $preOrderModel->update($id, $data);

    //     return redirect()->to('/pre_order');
    // }

    public function history()
    {
        // Pastikan pengguna sudah login
        if (!session()->has('user_id')) {
            return redirect()->to('/login');
        }

        $cartModel = new CartModel();
        $itemsModel = new ListItemsModel();
        $preOrderCartModel = new PreOrderCartModel();
        $preOrderModel = new PreOrderModel();

        // Ambil data user dari session
        $session = session();

        // Hitungan di navigasi bar
        $cartItemCount = $cartModel->getCartItemCount();
        $PreOrderCartCount = $preOrderCartModel->getPreorderCartCount();

        // data inti per controller
        $cartItemCount = $this->cartModel->getCartItemCount();
        $session = session();

        // Ambil data pre_order dengan join suppliers
        $preorder = $this->preOrderModel->getPreOrderWithSuppliers();

        $data = [
            'title' => 'Pre Order History',
            'subtitle' => '',
            'username' => $session->get('user_name'), // Mengambil username dari session
            'user_email' => $session->get('user_email'), // Mengambil useremail dari session
            'pocount' => $PreOrderCartCount,
            'cartcount' => $cartItemCount,
            'preorders' => $preorder
        ];

        // Kirim data outbound ke view
        return view('pre_order/history', $data);
    }

    public function detail($preorderId)
    {
        // Pastikan pengguna sudah login
        if (!session()->has('user_id')) {
            return redirect()->to('/login');
        }

        $cartModel = new CartModel();
        $itemsModel = new ListItemsModel();
        $preOrderCartModel = new PreOrderCartModel();
        $preOrderItemsModel = new PreOrderItemsModel();


        // Ambil data user dari session
        $session = session();
        $user_id = $session->get('user_id');
        $username = $session->get('user_name');
        $user_email = $session->get('user_email');

        // Hitungan di navigasi bar
        $cartItemCount = $cartModel->getCartItemCount();
        $PreOrderCartCount = $preOrderCartModel->getPreorderCartCount();

        // data inti per controller
        $preorder = $this->preOrderModel->getPreOrderById($preorderId);
        $outboundItems = $this->preOrderItemsModel->getItemsByPreorderId($preorderId);

        // Mendapatkan username dari ID pengguna
        $notedByUsername = $this->usersModel->getUsernameById($preorder['user_id']);
        $suppliersname = $this->supplierModel->getSuppliersnameById($preorder['supplier_id']); //Seharusnya bukan di QC tapi ID Supplier dan informasi kontaknya

        $data = [
            'title' => 'Pre Order Details',
            'subtitle' => '',
            'username' => $session->get('user_name'), // Mengambil username dari session
            'user_email' => $session->get('user_email'), // Mengambil useremail dari session
            'pocount' => $PreOrderCartCount,
            'cartcount' => $cartItemCount,
            'preorder' => $preorder,
            'preorderItems' => $outboundItems,
            'notedByUsername' => $notedByUsername, // Menyertakan username untuk noted by
            'suppliersname' => $suppliersname // Menyertakan username untuk received by
        ];

        // Kirim data outbound dan item outbound ke view
        return view('pre_order/detail', $data);
    }

    // public function print($preorderId)
    // {
    //     $cartModel = new CartModel();
    //     $itemsModel = new ListItemsModel();
    //     $preOrderCartModel = new PreOrderCartModel();
    //     $preOrderItemsModel = new PreOrderItemsModel();


    //     // Ambil data user dari session
    //     $session = session();
    //     $user_id = $session->get('user_id');
    //     $username = $session->get('user_name');
    //     $user_email = $session->get('user_email');

    //     // Hitungan di navigasi bar
    //     $cartItemCount = $cartModel->getCartItemCount();
    //     $PreOrderCartCount = $preOrderCartModel->getPreorderCartCount();

    //     // data inti per controller
    //     $preorder = $this->preOrderModel->getPreOrderById($preorderId);
    //     $outboundItems = $this->preOrderItemsModel->getItemsByPreorderId($preorderId);

    //     // Mendapatkan username dari ID pengguna
    //     $notedByUsername = $this->usersModel->getUsernameById($preorder['user_id']);
    //     $suppliersname = $this->supplierModel->getSuppliersnameById($preorder['supplier_id']); //Seharusnya bukan di QC tapi ID Supplier dan informasi kontaknya

    //     $data = [
    //         'title' => 'Outbound Details',
    //         'subtitle' => '',
    //         'username' => $session->get('user_name'), // Mengambil username dari session
    //         'user_email' => $session->get('user_email'), // Mengambil useremail dari session
    //         'pocount' => $PreOrderCartCount,
    //         'cartcount' => $cartItemCount,
    //         'preorder' => $preorder,
    //         'preorderItems' => $outboundItems,
    //         'notedByUsername' => $notedByUsername, // Menyertakan username untuk noted by
    //         'suppliersname' => $suppliersname // Menyertakan username untuk received by
    //     ];

    //     // Kirim data outbound dan item outbound ke view
    //     return view('pre_order/print', $data);
    // }

    public function delete($id)
    {
        $preOrderModel = new PreOrderModel();
        $preOrderModel->delete($id);

        return redirect()->to('/pre_order');
    }
}

