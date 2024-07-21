<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ListItemsModel;
use App\Models\CartModel;
use CodeIgniter\Controller;
use App\Models\InventoryModel;
use App\Models\SuppliersModel;
use App\Models\OutboundModel;
use App\Models\OutboundItemModel;
use App\Models\UserModel;

class Suppliers extends BaseController
{
    protected $suppliersModel;
    protected $cartModel;
    protected $itemModel;
    protected $cartItems;
    protected $inventoryModel;
    protected $listitemsModel;
    protected $supplierModel;
    protected $outboundModel;
    protected $outbounditemModel;
    protected $usersModel;

    public function __construct()
    {
        $this->listitemsModel = new ListItemsModel();
        $this->inventoryModel = new InventoryModel();
        $this->suppliersModel = new SuppliersModel();
        $this->usersModel = new UserModel();
        $this->cartModel = new CartModel();
        $this->itemModel = new ListItemsModel();
    }

    public function index()
    {
        $suppliers = $this->suppliersModel->findAll();
        $itemsModel = new ListItemsModel();

        $session = session();
        $cartModel = new CartModel();
        $cartItemCount = $cartModel->getCartItemCount();
        $lowStockItems = $itemsModel->getLowStockItemsNotif();
        $listitems = $this->listitemsModel->findAll();

        $data = [
            'title' => 'Data Suppliers',
            'listitems' => $listitems,
            'username' => $session->get('user_name'), // Mengambil username dari session
            'user_email' => $session->get('user_email'), // Mengambil useremail dari session
            'cartcount' => $cartItemCount,
            'lowStockItems' => $lowStockItems,
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
