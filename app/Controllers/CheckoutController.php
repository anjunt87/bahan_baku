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
use App\Models\DivisionModel;


class CheckoutController extends Controller
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
    protected $divisionModel;


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
        $this->divisionModel = new DivisionModel();

    }

    //  public function getUsers()
    // {
    //     $usersModel = new UserModel();
    //     $users = $usersModel->findAll();
    //     return $this->response->setJSON($users);
    // }


    // public function getDivisions()
    // {
    //     $divisions = $this->divisionModel->getDivisionsWithDepartment();
    //     return $this->response->setJSON($divisions);
    // }

    // public function getDivisionsByDepartment($departmentId)
    // {
    //     $divisions = $this->divisionModel->where('department_id', $departmentId)->findAll();
    //     return $this->response->setJSON($divisions);
    // }

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
        $user_id = session()->get('user_id');
        $cartItems = $cartModel->where('user_id',$user_id)->findAll();

        $data = [
            'title' => 'Checkout',
            'subtitle' => '',
            'username' => $session->get('user_name'), // Mengambil username dari session
            'user_email' => $session->get('user_email'), // Mengambil useremail dari session
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

        return view('checkout', $data);
    }

    public function process()
    {
        $session = session();
        $cartModel = new CartModel();
        $outboundModel = new OutboundModel();
        $outboundItemModel = new OutboundItemModel();
        $itemModel = new ListItemsModel();

        // data inti per controller
        $user_id = session()->get('user_id');
        $cartItems = $cartModel->where('user_id', $user_id)->findAll();
        $id_users = $this->request->getPost('recipient_name'); // cari username dengan inputan id username
        // $name_users = $this->usersModel->find($id_users)['user_name']; // Hasil pencarian username dengan id users

        if (empty($cartItems)) {
            return redirect()->to('/cart');
        }

        $outboundId = $outboundModel->insert([
            'user_id' => $user_id,
            'recipient_id' => $id_users,
        ]);

        foreach ($cartItems as $cartItem) {
            $item = $itemModel->find($cartItem['item_id']);
            $outboundItemModel->insert([
                'outbound_id' => $outboundId,
                'item_id' => $cartItem['item_id'],
                'quantity' => $cartItem['quantity'],
            ]);

            // Update stock_items
            $item['stock_items'] -= $cartItem['quantity'];
            $itemModel->save($item);
        }

        // Clear cart
        $cartModel->where('user_id', $user_id)->delete();

        return redirect()->to('/transaction/outboundsuccess');
    }

}
