<?php

namespace App\Controllers\Staff;

use App\Controllers\BaseController;
use App\Models\CartModel;
use App\Models\ListItemsModel;
use App\Models\SuppliersModel;
use App\Models\OutboundModel;
use App\Models\OutboundItemModel;
use App\Models\PreOrderModel;
use App\Models\UserModel;
use App\Models\PreOrderCartModel;
use App\Models\NeedItemsModel;
use App\Models\ItemsBundleModel;


class Index extends BaseController
{
    protected $cartModel;
    protected $listItemsModel;
    protected $supplierModel;
    protected $outboundModel;
    protected $outboundItemModel;
    protected $userModel;
    protected $preOrderModel;
    protected $preOrderCartModel;
    protected $itemBundleModel;
    protected $needItemsModel;


    public function __construct()
    {
        $this->cartModel = new CartModel();
        $this->listItemsModel = new ListItemsModel();
        $this->supplierModel = new SuppliersModel();
        $this->outboundModel = new OutboundModel();
        $this->outboundItemModel = new OutboundItemModel();
        $this->userModel = new UserModel();
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
        $preOrderModel = new PreOrderModel();
        $preOrderCartModel = new PreOrderCartModel();

        // Ambil data user dari session
        $session = session();
        $user_id = $session->get('user_id');
        $username = $session->get('user_name');
        $user_email = $session->get('user_email');

        // Ambil data dari model
        // $cartItemCount = $this->cartModel->getCartItemCount($user_id); // hitung cart sesuai dengan ID user
        // $countPreOrderCart = $this->preOrderModel->getPreOrderCountCart($user_id); // hitung cart sesuai dengan ID user
        // $cartItems = $this->cartModel->where('user_id', $user_id)->findAll(); 

        // Hitungan di dashboard
        $countUsers = $this->userModel->getUsersCount();
        $countOutbound = $this->outboundModel->getOutBoundCount();
        $countPreOrder = $this->preOrderModel->getPreOrderCount();
        $cartItemCount = $cartModel->getCartItemCount();
        $PreOrderCartCount = $preOrderCartModel->getPreorderCartCount();
        $totalInboundItems  = $preOrderModel->getTotalInboundItems();
        // Mengambil data bundling dan kebutuhan item
        $bundlesApprove = $this->itemBundleModel->where('items_bundles.status', 'approve')->findAll();
        $bundlesRejected = $this->itemBundleModel->where('items_bundles.status', 'rejected')->findAll();


        // Data untuk view
        $data = [
            'title' => 'Admin Dashboard',
            'subtitle' => '',
            'username' => $username,
            'user_email' => $user_email,
            'users' => $countUsers,
            'out' => $countOutbound,
            'in' => $countOutbound,
            'po' => $countPreOrder,
            'pocount' => $PreOrderCartCount,
            'cartcount' => $cartItemCount,
            'totalInboundItems' => $totalInboundItems,
            'bundledItemsApprove' => $bundlesApprove, // Menambahkan data bundling ke view
            'bundledItemsRejected' => $bundlesRejected // Menambahkan data bundling ke view
        ];

        return view('staff/index', $data);
    }
}
