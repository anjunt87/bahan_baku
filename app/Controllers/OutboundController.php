<?php

namespace App\Controllers;

use App\Models\CartModel;
use CodeIgniter\Controller;
use App\Models\InventoryModel;
use App\Models\ListItemsModel;
use App\Models\SuppliersModel;
use App\Models\OutboundModel;
use App\Models\OutboundItemModel;
use App\Models\UserModel;

class OutboundController extends Controller
{
    protected $cartModel;
    protected $itemModel;
    protected $cartItems;
    protected $inventoryModel;
    protected $listitemsModel;
    protected $supplierModel;
    protected $outboundModel;
    protected $outboundItemModel;
    protected $usersModel;

    public function __construct()
    {
        $this->listitemsModel = new ListItemsModel();
        $this->inventoryModel = new InventoryModel();
        $this->supplierModel = new SuppliersModel();
        $this->usersModel = new UserModel();
        $this->cartModel = new CartModel();
        $this->itemModel = new ListItemsModel();
        $this->outboundModel = new OutboundModel();
        $this->outboundItemModel = new OutboundItemModel();
    }

    public function history()
    {
        $userId = session()->get('user_id'); // Ambil user_id dari sesi pengguna
        $outbounds = $this->outboundModel->getUserOutbounds($userId);

        $cartItemCount = $this->cartModel->getCartItemCount();
        $session = session();
        $listitems = $this->listitemsModel->getTotalStock();
        $limitsitems = $this->listitemsModel->getLowStockItems();
        $lowStockItems = $this->itemModel->getLowStockItemsNotif();

        $data = [
            'title' => 'Outbound History',
            'username' => $session->get('user_name'), // Mengambil username dari session
            'user_email' => $session->get('user_email'), // Mengambil useremail dari session
            'totalstock_items' => $listitems,
            'lowstock_itemsItems' => $limitsitems,
            'lowStockItems' => $lowStockItems,
            'cartcount' => $cartItemCount,
            'outbounds' => $outbounds
        ];

        // Kirim data outbound ke view
        return view('outbound/outbound_history', $data);
    }

    public function detail($outboundId)
    {
        $session = session();
        $cartItemCount = $this->cartModel->getCartItemCount();
        $listitems = $this->itemModel->getTotalStock();
        $limitsitems = $this->itemModel->getLowStockItems();
        $lowStockItems = $this->itemModel->getLowStockItemsNotif();
        $outbound = $this->outboundModel->getOutboundById($outboundId);
        $outboundItems = $this->outboundItemModel->getItemsByOutboundId($outboundId);

        // Mendapatkan username dari ID pengguna
        $notedByUsername = $this->usersModel->getUsernameById($outbound['user_id']);
        $receivedByUsername = $this->usersModel->getUsernameById($outbound['recipient_id']);

        $data = [
            'title' => 'Outbound Details',
            'username' => $session->get('user_name'), // Mengambil username dari session
            'user_email' => $session->get('user_email'), // Mengambil useremail dari session
            'totalstock_items' => $listitems,
            'lowstock_itemsItems' => $limitsitems,
            'lowStockItems' => $lowStockItems,
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
        $listitems = $this->itemModel->getTotalStock();
        $limitsitems = $this->itemModel->getLowStockItems();
        $lowStockItems = $this->itemModel->getLowStockItemsNotif();
        $outbound = $this->outboundModel->getOutboundById($outboundId);
        $outboundItems = $this->outboundItemModel->getItemsByOutboundId($outboundId);

        // Mendapatkan username dari ID pengguna
        $notedByUsername = $this->usersModel->getUsernameById($outbound['user_id']);
        $receivedByUsername = $this->usersModel->getUsernameById($outbound['recipient_id']);

        $data = [
            'title' => 'Raw material retrieval information',
            'username' => $session->get('user_name'), // Mengambil username dari session
            'user_email' => $session->get('user_email'), // Mengambil useremail dari session
            'totalstock_items' => $listitems,
            'lowstock_itemsItems' => $limitsitems,
            'lowStockItems' => $lowStockItems,
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
