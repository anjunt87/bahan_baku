<?php

namespace App\Controllers;

use App\Models\CartModel;
use CodeIgniter\Controller;
use App\Models\ListItemsModel;
use App\Models\SuppliersModel;
use App\Models\OutboundModel;
use App\Models\OutboundItemModel;
use App\Models\UserModel;
use App\Models\PreOrderModel;
use App\Models\PreOrderCartModel;

class OutboundController extends Controller
{
    protected $cartModel;
    protected $itemModel;
    protected $cartItems;
    protected $listitemsModel;
    protected $supplierModel;
    protected $outboundModel;
    protected $outboundItemModel;
    protected $usersModel;
    protected $preOrderModel;
    protected $preOrderCartModel;

    public function __construct()
    {
        $this->listitemsModel = new ListItemsModel();
        $this->supplierModel = new SuppliersModel();
        $this->usersModel = new UserModel();
        $this->cartModel = new CartModel();
        $this->itemModel = new ListItemsModel();
        $this->outboundModel = new OutboundModel();
        $this->outboundItemModel = new OutboundItemModel();
        $this->preOrderModel = new PreOrderModel();
        $this->preOrderCartModel = new PreOrderCartModel();
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
        $cartItemCount = $this->cartModel->getCartItemCount();
        $session = session();

        $userId = session()->get('user_id'); // Ambil user_id dari sesi pengguna
        // $outbounds = $this->outboundModel->getUserOutbounds($userId);
        $outbounds = $this->outboundModel->findAll();
        $data = [
            'title' => 'Outbound History',
            'subtitle' => '',
            'username' => $session->get('user_name'), // Mengambil username dari session
            'user_email' => $session->get('user_email'), // Mengambil useremail dari session
            'pocount' => $PreOrderCartCount,
            'cartcount' => $cartItemCount,
            'outbounds' => $outbounds
        ];

        // Kirim data outbound ke view
        return view('outbound/outbound_history', $data);
    }

    public function detail($outboundId)
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
            'title' => 'Outbound Details',
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
        return view('outbound/outbound_detail', $data);
    }

    public function success()
    {
        // Logika tambahan jika diperlukan, misalnya mengambil detail outbound dari database
        // atau menampilkan pesan sukses kepada pengguna

        return view('outbound/outbound_success'); // Pastikan Anda memiliki view bernama outbound_success
    }

    public function print($outboundId)
    {
        $session = session();
        $cartItemCount = $this->cartModel->getCartItemCount();
        $outbound = $this->outboundModel->getOutboundById($outboundId);
        $outboundItems = $this->outboundItemModel->getItemsByOutboundId($outboundId);

        // Mendapatkan username dari ID pengguna
        $notedByUsername = $this->usersModel->getUsernameById($outbound['user_id']);
        $receivedByUsername = $this->usersModel->getUsernameById($outbound['recipient_id']);

        $data = [
            'title' => 'Raw material retrieval information',
            'subtitle' => '',
            'username' => $session->get('user_name'), // Mengambil username dari session
            'user_email' => $session->get('user_email'), // Mengambil useremail dari session
            'cartcount' => $cartItemCount,
            'outbound' => $outbound,
            'outboundItems' => $outboundItems,
            'notedByUsername' => $notedByUsername, // Menyertakan username untuk noted by
            'receivedByUsername' => $receivedByUsername // Menyertakan username untuk received by
        ];

        // Kirim data outbound dan item outbound ke view
        return view('outbound/outbound_detail_print', $data);
    }
}
