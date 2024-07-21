<?php

namespace App\Controllers;

use App\Models\PreOrderModel;
use App\Models\PreOrderItemModel;
use App\Models\CartModel;
use CodeIgniter\Controller;
use App\Models\InventoryModel;
use App\Models\ListItemsModel;
use App\Models\SuppliersModel;
use App\Models\OrderModel;
use App\Models\OrderItemModel;
use App\Models\UserModel;


class PreOrderController extends BaseController
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
        $preOrderModel = new PreOrderModel();
        $cartModel = new CartModel();
        $itemModel = new ListItemsModel();

        $session = session();
        $cartItemCount = $cartModel->getCartItemCount();
        $listitems = $this->listitemsModel->getTotalStock();
        $lowStockItems = $itemModel->getLowStockItemsNotif();
        $preorderlist = $preOrderModel->findAll();


        $data = [
            'title' => 'Pre-Order',
            'username' => $session->get('user_name'), // Mengambil username dari session
            'user_email' => $session->get('user_email'), // Mengambil useremail dari session
            'totalstock_items' => $listitems,
            'lowStockItems' => $lowStockItems,
            'cartcount' => $cartItemCount,
            'pre-order' => $preorderlist
        ];

        return view('pre-order/index', $data);
    }

    public function create()
    {
        $itemModel = new ListItemsModel();
        
        $preOrderModel = new PreOrderModel();
        $cartModel = new CartModel();
        $itemModel = new ListItemsModel();
        
        $session = session();
        $cartItemCount = $cartModel->getCartItemCount();
        $listitems = $this->listitemsModel->getTotalStock();
        $lowStockItems = $itemModel->getLowStockItemsNotif();
        $ItemspreOrder = $itemModel->findAll();

        $data = [
            'title' => 'Pre-Order',
            'username' => $session->get('user_name'), // Mengambil username dari session
            'user_email' => $session->get('user_email'), // Mengambil useremail dari session
            'totalstock_items' => $listitems,
            'lowStockItems' => $lowStockItems,
            'cartcount' => $cartItemCount,
            'items' => $ItemspreOrder
        ];

        return view('pre-order/create', $data);
    }

    public function store()
    {
        $model = new PreOrderModel();
        $preOrderData = [
            'customer_name' => $this->request->getPost('customer_name'),
            'contact_info' => $this->request->getPost('contact_info'),
            'status' => 'pending'
        ];
        $model->save($preOrderData);
        $preOrderId = $model->getInsertID();

        $itemModel = new PreOrderItemModel();
        foreach ($this->request->getPost('items') as $item) {
            $itemData = [
                'pre_order_id' => $preOrderId,
                'items_id' => $item['item_id'],
                'quantity' => $item['quantity']
            ];
            $itemModel->save($itemData);
        }

        return redirect()->to('/pre-order');
    }

    public function show($id)
    {
        $preOrderModel = new PreOrderModel();
        $itemModel = new PreOrderItemModel();
        $data['pre_order'] = $preOrderModel->find($id);
        $data['items'] = $itemModel->where('pre_order_id', $id)->findAll();
        return view('pre-order/show', $data);
    }
}
