<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
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

class Suppliers extends BaseController
{
    protected $cartModel;
    protected $cartItems;
    protected $itemModel;
    protected $inventoryModel;
    protected $listitemsModel;
    protected $suppliersModel;
    protected $orderModel;
    protected $orderitemModel;
    protected $outboundModel;
    protected $outboundItemModel;
    protected $usersModel;
    protected $preOrderModel;
    protected $preOrderCartModel;

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
        $itemsModel = new ListItemsModel();

        // Ambil data user dari session
        $session = session();
        $user_id = $session->get('user_id');
        $username = $session->get('user_name');
        $user_email = $session->get('user_email');

        // Hitungan di navigasi bar
        $cartItemCount = $cartModel->getCartItemCount();
        $PreOrderCartCount = $preOrderCartModel->getPreorderCartCount();

        // data inti per controller
        $listitems = $this->listitemsModel->findAll();
        $suppliers = $this->suppliersModel->findAll();


        $data = [
            'title' => 'Data Suppliers',
            'subtitle' => '',
            'listitems' => $listitems,
            'username' => $session->get('user_name'), // Mengambil username dari session
            'user_email' => $session->get('user_email'), // Mengambil useremail dari session
            'pocount' => $PreOrderCartCount,
            'cartcount' => $cartItemCount,
            'suppliers' => $suppliers
        ];
        return view('admin/suppliers', $data);
    }

    public function save()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'name_suppliers' => $this->request->getPost('nameSuppliersInput'),
                'production_suppliers' => $this->request->getPost('productionInput'),
                'contact_suppliers' => $this->request->getPost('contactInput')
            ];

            if ($this->suppliersModel->saveSuppliers($data)) {
                return $this->response->setJSON(['success' => true, 'message' => 'Supplier added successfully.']);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Failed to add supplier.']);
            }
        }
    }

    public function edit($id)
    {
        if ($this->request->isAJAX()) {
            $suppliers = $this->suppliersModel->find($id);
            if ($suppliers) {
                return $this->response->setJSON(['success' => true, 'data' => $suppliers]);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Supplier not found.']);
            }
        }
    }


    public function update()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id_suppliers');
            $data = [
                'name_suppliers' => $this->request->getPost('nameSuppliersEdit'),
                'production_suppliers' => $this->request->getPost('productionEdit'),
                'contact_suppliers' => $this->request->getPost('contactEdit')
            ];

            if ($this->suppliersModel->update($id, $data)) {
                return $this->response->setJSON(['success' => true, 'message' => 'Supplier updated successfully.']);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Failed to update supplier.']);
            }
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id_suppliers');
            if ($this->suppliersModel->delete($id)) {
                return $this->response->setJSON(['success' => true, 'message' => 'Supplier deleted successfully.']);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Failed to delete supplier.']);
            }
        }
    }
}
