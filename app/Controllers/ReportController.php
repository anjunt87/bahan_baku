<?php

namespace App\Controllers;

use App\Models\CartModel;
use CodeIgniter\Controller;
use App\Models\SuppliersModel;
use App\Models\OrderModel;
use App\Models\OutboundItemModel;
use App\Models\UserModel;
use App\Models\PreOrderCartModel;
use App\Models\PreOrderItemsModel;
use App\Models\PreOrderModel;
use App\Models\OutboundModel;
use App\Models\InboundModel;
use App\Models\ListItemsModel;


class ReportController extends BaseController

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
    protected $preOrderItemsModel;

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
        $this->preOrderItemsModel = new PreOrderItemsModel();

    }

    public function stockReport()
    {
        // Pastikan pengguna sudah login
        if (!session()->has('user_id')) {
            return redirect()->to('/login');
        }

        $cartModel = new CartModel();
        $itemsModel = new ListItemsModel();
        $preOrderCartModel = new PreOrderCartModel();

        $startDate = $this->request->getPost('start_date');
        $endDate = $this->request->getPost('end_date');

        // Log debug
        log_message('debug', 'Start Date: ' . $startDate);
        log_message('debug', 'End Date: ' . $endDate);

        // Ambil data user dari session
        $session = session();

        // Hitungan di navigasi bar
        $cartItemCount = $cartModel->getCartItemCount();
        $PreOrderCartCount = $preOrderCartModel->getPreorderCartCount();

        // Fetch the reports based on the date range
        $report = $itemsModel->getStockReport($startDate, $endDate);

        // Log debug
        log_message('debug', 'Report Data: ' . json_encode($report));

        $data = [
            'title' => 'Stock Report',
            'titledate' => 'Stock Report from ',
            'startdate' => $startDate,
            'enddate' => $endDate,
            'subtitle' => '',
            'username' => $session->get('user_name'), // Mengambil username dari session
            'user_email' => $session->get('user_email'),
            'pocount' => $PreOrderCartCount,
            'cartcount' => $cartItemCount,
            'reports' => $report
        ];
        return view('reports/stock', $data);
    }


    public function preOrderReport()
    {
        // Pastikan pengguna sudah login
        if (!session()->has('user_id')) {
            return redirect()->to('/login');
        }

        $cartModel = new CartModel();
        $preOrderModel = new PreOrderModel();
        $preOrderCartModel = new PreOrderCartModel();

        $startDate = $this->request->getPost('start_date');
        $endDate = $this->request->getPost('end_date');

        // Log debug
        log_message('debug', 'Start Date: ' . $startDate);
        log_message('debug', 'End Date: ' . $endDate);

        // Ambil data user dari session
        $session = session();

        // Hitungan di navigasi bar
        $cartItemCount = $cartModel->getCartItemCount();
        $PreOrderCartCount = $preOrderCartModel->getPreorderCartCount();

        // Fetch the reports based on the date range
        $report = $preOrderModel->getPreOrderReport($startDate, $endDate);

        // Log debug
        log_message('debug', 'Report Data: ' . json_encode($report));

        $data = [
            'title' => 'Report Pre Order',
            'titledate' => 'Pre Order Report from ',
            'startdate' => $startDate,
            'enddate' => $endDate,
            'subtitle' => '',
            'username' => $session->get('user_name'), // Mengambil username dari session
            'user_email' => $session->get('user_email'),
            'pocount' => $PreOrderCartCount,
            'cartcount' => $cartItemCount,
            'reports' => $report
        ];
        return view('reports/pre_order', $data);
    }

    public function preOrderdetail($preorderId)
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
        $suppliersname = $this->suppliersModel->getSuppliersnameById($preorder['supplier_id']); //Seharusnya bukan di QC tapi ID Supplier dan informasi kontaknya

        $data = [
            'title' => 'Report Pre Order Details',
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
        return view('reports/pre_order_detail', $data);
    }

    public function outboundReport()
    {
        // Pastikan pengguna sudah login
        if (!session()->has('user_id')) {
            return redirect()->to('/login');
        }

        $cartModel = new CartModel();
        $preOrderModel = new PreOrderModel();
        $preOrderCartModel = new PreOrderCartModel();
        $model = new OutboundModel();

        $startDate = $this->request->getPost('start_date');
        $endDate = $this->request->getPost('end_date');

        // Log debug
        log_message('debug', 'Start Date: ' . $startDate);
        log_message('debug', 'End Date: ' . $endDate);

        // Ambil data user dari session
        $session = session();

        // Hitungan di navigasi bar
        $cartItemCount = $cartModel->getCartItemCount();
        $PreOrderCartCount = $preOrderCartModel->getPreorderCartCount();

        // Fetch the reports based on the date range
        $report = $model->getOutboundReport($startDate, $endDate);

        // Log debug
        log_message('debug', 'Report Data: ' . json_encode($report));

        $data = [
            'title' => 'Report Outbound',
            'titledate' => 'Outbound Report from ',
            'startdate' => $startDate,
            'enddate' => $endDate,
            'subtitle' => '',
            'username' => $session->get('user_name'), // Mengambil username dari session
            'user_email' => $session->get('user_email'),
            'pocount' => $PreOrderCartCount,
            'cartcount' => $cartItemCount,
            'reports' => $report
        ];
        return view('reports/outbound', $data);
    }

    public function outboundDetail($outboundId)
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
        $outbound = $this->outboundModel->getOutboundById($outboundId);
        $outboundItems = $this->outboundItemModel->getItemsByOutboundId($outboundId);

        // Mendapatkan username dari ID pengguna
        $notedByUsername = $this->usersModel->getUsernameById($outbound['user_id']);
        $receivedByUsername = $this->usersModel->getUsernameById($outbound['recipient_id']);

        $data = [
            'title' => 'Outbound Details Report',
            'subtitle' => '',
            'username' => $session->get('user_name'), // Mengambil username dari session
            'user_email' => $session->get('user_email'), // Mengambil useremail dari session
            'pocount' => $PreOrderCartCount,
            'cartcount' => $cartItemCount,
            'outbound' => $outbound,
            'outboundItems' => $outboundItems,
            'notedByUsername' => $notedByUsername, // Menyertakan username untuk noted by
            'receivedByUsername' => $receivedByUsername // Menyertakan username untuk received by
        ];

        // Kirim data outbound dan item outbound ke view
        return view('reports/outbound_detail', $data);
    }

    public function inboundReport()
    {
        // Pastikan pengguna sudah login
        if (!session()->has('user_id')) {
            return redirect()->to('/login');
        }

        $cartModel = new CartModel();
        $preOrderModel = new PreOrderModel();
        $preOrderCartModel = new PreOrderCartModel();

        $startDate = $this->request->getPost('start_date');
        $endDate = $this->request->getPost('end_date');

        // Log debug
        log_message('debug', 'Start Date: ' . $startDate);
        log_message('debug', 'End Date: ' . $endDate);

        // Ambil data user dari session
        $session = session();

        // Hitungan di navigasi bar
        $cartItemCount = $cartModel->getCartItemCount();
        $preOrderCartCount = $preOrderCartModel->getPreorderCartCount();

        // Fetch the reports based on the date range
        $report = $preOrderModel->getInboundReport($startDate, $endDate); // Ensure the method name matches

        // Log debug
        log_message('debug', 'Report Data: ' . json_encode($report));

        $data = [
            'title' => 'Report Inbound',
            'titledate' => 'Inbound Report from ',
            'startdate' => $startDate,
            'enddate' => $endDate,
            'subtitle' => '',
            'username' => $session->get('user_name'), // Mengambil username dari session
            'user_email' => $session->get('user_email'),
            'pocount' => $preOrderCartCount,
            'cartcount' => $cartItemCount,
            'reports' => $report
        ];

        return view('reports/inbound', $data);
    }

    public function inboundDetail($preorderId)
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
        $notedByUsername = $this->usersModel->getUsernameById($preorder['noted_by']);
        $checkedByUsername = $this->usersModel->getUsernameById($preorder['checked_by']);
        $suppliersname = $this->suppliersModel->getSuppliersnameById($preorder['supplier_id']); //Seharusnya bukan di QC tapi ID Supplier dan informasi kontaknya

        $data = [
            'title' => 'Report Inbound Details',
            'subtitle' => '',
            'username' => $session->get('user_name'), // Mengambil username dari session
            'user_email' => $session->get('user_email'), // Mengambil useremail dari session
            'pocount' => $PreOrderCartCount,
            'cartcount' => $cartItemCount,
            'preorder' => $preorder,
            'preorderItems' => $outboundItems,
            'notedByUsername' => $notedByUsername, // Menyertakan username untuk noted by
            'checkedByUsername' => $checkedByUsername, // Menyertakan username untuk checked by
            'suppliersname' => $suppliersname // Menyertakan username untuk received by
        ];

        // Kirim data outbound dan item outbound ke view
        return view('reports/inbound_detail', $data);
    }
}
