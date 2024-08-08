<?php

namespace App\Controllers;
use App\Models\NeedItemsModel;
use App\Models\ItemsBundleModel;
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

class NeedItemsController extends BaseController
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
    protected $itemBundleModel;
    protected $needItemsModel;


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

        // Ambil data user dari session
        $session = session();
        $user_id = $session->get('user_id');
        $username = $session->get('user_name');
        $user_email = $session->get('user_email');

        // Hitungan di navigasi bar
        $cartItemCount = $cartModel->getCartItemCount();
        $PreOrderCartCount = $preOrderCartModel->getPreorderCartCount();

        // data inti per controller
        $needitems = $this->needItemsModel->getItemNeeds();
        $cartItemCount = $this->cartModel->getCartItemCount();
        // Mengambil data bundling dan kebutuhan item
        $bundles = $this->itemBundleModel->where('items_bundles.status', 'pending')->findAll();

        $bundledItems = [];

        foreach ($bundles as $bundle) {
            $items = $this->needItemsModel->where('bundle_id', $bundle['id'])->findAll();
            $bundledItems[] = [
                'bundle' => $bundle,
                'items' => $items,
            ];
        }

        $data = [
            'title' => 'Items Need Bundle',
            'subtitle' => '',
            'username' => $session->get('user_name'), // Mengambil username dari session
            'user_email' => $session->get('user_email'), // Mengambil useremail dari session
            'pocount' => $PreOrderCartCount,
            'cartcount' => $cartItemCount,
            'needItems' => $needitems,
            'bundledItems' => $bundles // Menambahkan data bundling ke view
        ];

        return view('needitems/index', $data);
    }

    public function detail($id)
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

        // data inti per controllers
        $needitems = $this->needItemsModel->getItemNeeds();
        $bundle = $this->itemBundleModel->find($id);

        if (!$bundle) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Bundle not found');
        }

        $bundledItems = $this->itemBundleModel->getBundleByBundleId($id);

        $data = [
            'title' => 'Items Need Bundle Detail',
            'subtitle' => '',
            'username' => $session->get('user_name'), // Mengambil username dari session
            'user_email' => $session->get('user_email'), // Mengambil useremail dari session
            'pocount' => $PreOrderCartCount,
            'cartcount' => $cartItemCount,
            'needItems' => $needitems,
            'bundle' => $bundle,
            'bundledItems' => $bundledItems // Menambahkan data bundling ke view
        ];

        return view('needitems/detail', $data);
    }

    public function updateStatus()
    {
    if ($this->request->isAJAX()) {
        $id = $this->request->getPost('id');
        $status = $this->request->getPost('status');

        // Update status in the database
        $needItemsModel = new \App\Models\NeedItemsModel();
        $needItemsModel->update($id, ['status' => $status]);

            // Jika status menjadi 'stock_not_available', pindahkan ke menu cart pre-order
        if ($status === 'stock_not_available') {
            $needItem = $needItemsModel->find($id);
            $user_id = session()->get('user_id');
            
            // Buat instance model untuk cart pre-order
            $preOrderCartModel = new \App\Models\PreOrderCartModel();
            
            // Pindahkan data ke cart pre-order
            $preOrderCartModel->insert([
                'user_id' => $user_id,
                'item_id' => $needItem['item_id'],
                'quantity' => $needItem['quantity'],
                'status' => 'pending'
            ]);
        }

        return $this->response->setJSON(['success' => true]);
    }

    return $this->response->setJSON(['error' => 'Invalid request'], 400);
    }

    public function updateStatusBundles()
    {
        $id = $this->request->getJSON()->id;
        $status = $this->request->getJSON()->status;

        // Validasi status jika diperlukan
        if (!in_array($status, ['approve', 'pending', 'rejected'])) {
            return $this->response->setStatusCode(400, 'Invalid status');
        }

        // Update status di database
        $bundleModel = new ItemsBundleModel();
        if ($bundleModel->update($id, ['status' => $status])) {
            // Kirim respons sukses
            return $this->response->setJSON(['status' => 'success']);
        } else {
            // Kirim respons gagal
            return $this->response->setStatusCode(500, 'Failed to update status');
        }
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

        // Ambil data user dari session
        $session = session();
        $user_id = $session->get('user_id');
        $username = $session->get('user_name');
        $user_email = $session->get('user_email');

        // Hitungan di navigasi bar
        $cartItemCount = $cartModel->getCartItemCount();
        $PreOrderCartCount = $preOrderCartModel->getPreorderCartCount();

        // data inti per controller
        $needitems = $this->needItemsModel->getItemNeeds();
        $cartItemCount = $this->cartModel->getCartItemCount();
        // Mengambil data bundling dan kebutuhan item
        $bundlesApprove = $this-> itemBundleModel->where('items_bundles.status', 'approve')->findAll();
        $bundlesRejected = $this->itemBundleModel->where('items_bundles.status', 'rejected')->findAll();
        
        $Itemsbundles = $this->itemBundleModel->getBundledItems();
        $bundledItems = [];

        // foreach ($bundles as $bundle) {
        //     $items = $this->needItemsModel->where('bundle_id', $bundle['id'])->findAll();
        //     $bundledItems[] = [
        //         'bundle' => $bundle,
        //         'items' => $items,
        //     ];
        // }

        $data = [
            'title' => 'Items Need Bundle History',
            'subtitle' => '',
            'username' => $session->get('user_name'), // Mengambil username dari session
            'user_email' => $session->get('user_email'), // Mengambil useremail dari session
            'pocount' => $PreOrderCartCount,
            'cartcount' => $cartItemCount,
            'needItems' => $needitems,
            'bundledItemsApprove' => $bundlesApprove, // Menambahkan data bundling ke view
            'bundledItemsRejected' => $bundlesRejected // Menambahkan data bundling ke view

        ];

        return view('needitems/history', $data);
    }


    public function create()
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/login');
        }

        $session = session();
        $cartItemCount = $this->cartModel->getCartItemCount();
        $PreOrderCartCount = $this->preOrderCartModel->getPreorderCartCount();

        $items = $this->itemModel->findAll();

        $data = [
            'title' => 'Create Need Items',
            'subtitle' => '',
            'username' => $session->get('user_name'),
            'user_email' => $session->get('user_email'),
            'pocount' => $PreOrderCartCount,
            'cartcount' => $cartItemCount,
            'items' => $items
        ];

        return view('needitems/create', $data);
    }

    public function store()
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/login');
        }

        $session = session();
        $bundleName = $this->request->getPost('bundle_name');
        $items = $this->request->getPost('items');

        // Validasi input
        if (empty($bundleName) || empty($items)) {
            return redirect()->back()->with('errors', ['Bundle name and items are required']);
        }

        // Simpan data bundle
        $bundleData = [
            'bundle_name' => $bundleName,
            'status' => 'pending'
        ];

        $this->itemBundleModel->insert($bundleData);
        $bundleId = $this->itemBundleModel->getInsertID();

        // Simpan data item
        foreach ($items as $item) {
            // Pastikan item memiliki item_id dan quantity
            if (!isset($item['item_id']) || !isset($item['quantity']) || empty($item['item_id']) || empty($item['quantity'])) {
                continue; // Skip jika data item tidak valid
            }

            $itemData = [
                'item_id' => $item['item_id'],
                'bundle_id' => $bundleId,
                'item_name' => $this->itemModel->find($item['item_id'])['name_items'] ?? 'Unknown', // Ambil nama item
                'quantity' => $item['quantity'],
                'status' => 'stock_needed'
            ];

            $this->needItemsModel->insert($itemData);
        }

        return redirect()->to('/needitems')->with('success', 'Bundle created successfully');
    }

}
