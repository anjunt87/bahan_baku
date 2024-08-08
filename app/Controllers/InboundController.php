<?php

namespace App\Controllers;

use App\Controllers\Admin\ListItems;
use App\Models\InboundModel;
use CodeIgniter\Controller;
use App\Models\ListItemsModel;
use App\Models\CartModel;
use App\Models\SuppliersModel;
use App\Models\OutboundModel;
use App\Models\OutboundItemModel;
use App\Models\UserModel;
use App\Models\PreOrderCartModel;
use App\Models\PreOrderModel;
use App\Models\PreOrderItemsModel;
use App\Models\NeedItemsModel;
use App\Models\ItemsBundleModel;


class InboundController extends Controller
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
    protected $itemBundleModel;
    protected $needItemsModel;
    protected $inboundItemModel;


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
        $this->preOrderItemsModel = new PreOrderItemsModel();
        $this->preOrderCartModel = new PreOrderCartModel();
        $this->itemBundleModel = new ItemsBundleModel();
        $this->needItemsModel = new NeedItemsModel();

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

        // Hitungan di Navigasi
        $cartItemCount = $cartModel->getCartItemCount();
        $PreOrderCartCount = $preOrderCartModel->getPreorderCartCount();

        // data inti per controller
        // $preorder = $this->preOrderModel->findAll();
        $preorder = $this->preOrderModel->where('pre_order.status', 'process')
            ->orderBy('pre_order_date','DESC')
            ->findAll();
        $data = [
            'title' => 'Inbound',
            'subtitle' => 'Items that have been pre-ordered will be processed inbound',
            'username' => $username,
            'user_email' => $user_email,
            'pocount' => $PreOrderCartCount,
            'cartcount' => $cartItemCount,
            'inboundItems' => $preorder
        ];

        return view('inbound/index', $data);
    }

    public function history()
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

        // Hitungan di Navigasi
        $cartItemCount = $cartModel->getCartItemCount();
        $PreOrderCartCount = $preOrderCartModel->getPreorderCartCount();

        // data inti per controller
        // $preorder = $this->preOrderModel->findAll();
        $preorder = $this->preOrderModel->where('pre_order.status', 'completed')
            ->orderBy('pre_order_date', 'DESC')
            ->findAll();

        $data = [
            'title' => 'Details History Inbound',
            'subtitle' => '',
            'username' => $username,
            'user_email' => $user_email,
            'pocount' => $PreOrderCartCount,
            'cartcount' => $cartItemCount,
            'inboundItems' => $preorder
        ];

        return view('inbound/history', $data);
    }

    public function check($preorderId)
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/login');
        }

        $cartModel = new CartModel();
        $itemsModel = new ListItemsModel();
        $preOrderCartModel = new PreOrderCartModel();
        $preOrderItemsModel = new PreOrderItemsModel();
        $userModel = new UserModel();
        $preOrderModel = new PreOrderModel();

        $session = session();
        $user_id = $session->get('user_id');
        $username = $session->get('user_name');
        $user_email = $session->get('user_email');

        $cartItemCount = $cartModel->getCartItemCount();
        $PreOrderCartCount = $preOrderCartModel->getPreorderCartCount();

        $preorder = $preOrderModel->getPreOrderById($preorderId);
        $preorderitems = $preOrderItemsModel->getItemsByPreorderId($preorderId);

        $notedByUsername = $userModel->getUsernameById($preorder['noted_by']);
        $suppliersname = $this->suppliersModel->getSuppliersnameById($preorder['supplier_id']);

        $qualityControlUsers = $userModel->where('department_id', 8)->findAll();

        $data = [
            'title' => 'Inbound Details',
            'subtitle' => '',
            'username' => $username,
            'user_email' => $user_email,
            'pocount' => $PreOrderCartCount,
            'cartcount' => $cartItemCount,
            'preorder' => $preorder,
            'preorderItems' => $preorderitems,
            'notedByUsername' => $notedByUsername,
            'suppliersname' => $suppliersname,
            'qcusers' => $qualityControlUsers
        ];

        return view('inbound/check', $data);
    }

    public function detailcheck($preorderId)
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/login');
        }

        $cartModel = new CartModel();
        $itemsModel = new ListItemsModel();
        $preOrderCartModel = new PreOrderCartModel();
        $preOrderItemsModel = new PreOrderItemsModel();
        $userModel = new UserModel();
        $preOrderModel = new PreOrderModel();

        $session = session();
        $user_id = $session->get('user_id');
        $username = $session->get('user_name');
        $user_email = $session->get('user_email');

        $cartItemCount = $cartModel->getCartItemCount();
        $PreOrderCartCount = $preOrderCartModel->getPreorderCartCount();

        $preorder = $preOrderModel->getPreOrderById($preorderId);
        $preorderitems = $preOrderItemsModel->getItemsByPreorderId($preorderId);

        $notedByUsername = $userModel->getUsernameById($preorder['noted_by']);
        $checkByUsername = $userModel->getUsernameById($preorder['checked_by']);
        $suppliersname = $this->suppliersModel->getSuppliersnameById($preorder['supplier_id']);

        $qualityControlUsers = $userModel->where('department_id', 8)->findAll();

        $data = [
            'title' => 'Inbound Details',
            'subtitle' => '',
            'username' => $username,
            'user_email' => $user_email,
            'pocount' => $PreOrderCartCount,
            'cartcount' => $cartItemCount,
            'preorder' => $preorder,
            'preorderItems' => $preorderitems,
            'notedByUsername' => $notedByUsername,
            'checkByUsername' => $checkByUsername,
            'suppliersname' => $suppliersname,
            'qcusers' => $qualityControlUsers
        ];

        return view('inbound/detailcheck', $data);
    }

    public function detailhistory($preorderId)
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/login');
        }

        $cartModel = new CartModel();
        $itemsModel = new ListItemsModel();
        $preOrderCartModel = new PreOrderCartModel();
        $preOrderItemsModel = new PreOrderItemsModel();
        $userModel = new UserModel();
        $preOrderModel = new PreOrderModel();

        $session = session();
        $user_id = $session->get('user_id');
        $username = $session->get('user_name');
        $user_email = $session->get('user_email');

        $cartItemCount = $cartModel->getCartItemCount();
        $PreOrderCartCount = $preOrderCartModel->getPreorderCartCount();

        $preorder = $preOrderModel->getPreOrderById($preorderId);
        $preorderitems = $preOrderItemsModel->getItemsByPreorderId($preorderId);

        $notedByUsername = $userModel->getUsernameById($preorder['noted_by']);
        $checkByUsername = $userModel->getUsernameById($preorder['checked_by']);
        $suppliersname = $this->suppliersModel->getSuppliersnameById($preorder['supplier_id']);

        $qualityControlUsers = $userModel->where('department_id', 8)->findAll();

        $data = [
            'title' => 'Details History Inbound',
            'subtitle' => '',
            'username' => $username,
            'user_email' => $user_email,
            'pocount' => $PreOrderCartCount,
            'cartcount' => $cartItemCount,
            'preorder' => $preorder,
            'preorderItems' => $preorderitems,
            'notedByUsername' => $notedByUsername,
            'checkByUsername' => $checkByUsername,
            'suppliersname' => $suppliersname,
            'qcusers' => $qualityControlUsers
        ];

        return view('inbound/detailhistory', $data);
    }

    public function saveUpdatedPreOrder()
    {
        $preOrderModel = new PreOrderModel();

        $preorderId = $this->request->getPost('preorder_id');
        $checkedBy = $this->request->getPost('checked_by');

        $data = [
            'checked_by' => $checkedBy,
            'status' => 'checked' // atau status lainnya sesuai kebutuhan
        ];

        if ($preOrderModel->update($preorderId, $data)) {
            return redirect()->to('/inbound/detailcheck/' . $preorderId);
        } else {
            return redirect()->back()->with('error', 'Failed to save the data. Please try again.');
        }
    }

    public function checkitems()
    {
        $preOrderModel = new PreOrderModel();
        $preOrderItemsModel = new PreOrderItemsModel();
        $itemsModel = new ListItemsModel(); 

        // input
        $preorderItems = $this->request->getPost('preorderItems');
        $preorderId = $this->request->getPost('preorder_id');
        $comment = $this->request->getPost('comment');

        $errors = [];

        foreach ($preorderItems as $item) {
            $actual = $item['actual'];
            $quantity = $item['quantity'];

            if ($actual > $quantity) {
                $errors[] = "Actual value for item ID {$item['id']} cannot exceed Amount PO.";
            }
        }

        if (!empty($errors)) {
            session()->setFlashdata('errors', $errors);
            return redirect()->back()->withInput();
        }

        foreach ($preorderItems as $item) {
            // Update actual and status in preOrderItems table
            $data = [
                'actual' => $item['actual'],
                'status' => ($item['actual'] == $item['quantity']) ? 'suitable' : 'not_suitable'
            ];
            $preOrderItemsModel->update($item['id'], $data);

            // Update stock_items in items table
            $itemId = $item['item_id'];
            $actual = $item['actual'];

            // Get current stock of the item
            $currentStock = $itemsModel->find($itemId)['stock_items'];

            // Calculate new stock
            $newStock = $currentStock + $actual;

            // Update stock in items table
            $itemsModel->update($itemId, ['previous_stock' => $currentStock]);
            $itemsModel->update($itemId, ['stock_items' => $newStock]);
        }

        // Update data pre_oreder
        $data_items = [
            'delivery_note' => $comment
        ];

        $preOrderModel->update($preorderId, $data_items);

        // Update data pre_oreder_items
        $data = [
            'status' => 'completed' // atau status lainnya sesuai kebutuhan
        ];

        $preOrderModel->update($preorderId, $data);

        // return redirect()->to('inbound/detailcheck/' . $preorderID);
        return redirect()->to('/transaction/inboundsuccess');
    }

}

