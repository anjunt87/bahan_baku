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

class ListItems extends BaseController
{
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
        $this->supplierModel = new SuppliersModel();
        $this->usersModel = new UserModel();
        $this->cartModel = new CartModel();
        $this->itemModel = new ListItemsModel();
    }
    
    public function index()
    {
        $itemsModel = new ListItemsModel();

        $session = session();
        $cartModel = new CartModel();
        $cartItemCount = $cartModel->getCartItemCount();
        $lowStockItems = $itemsModel->getLowStockItemsNotif();
        $listitems = $this->listitemsModel->findAll();
        
        $data = [
            'title' => 'List Items',
            'listitems' => $listitems,
            'username' => $session->get('user_name'), // Mengambil username dari session
            'user_email' => $session->get('user_email'), // Mengambil useremail dari session
            'cartcount' => $cartItemCount,
            'lowStockItems' => $lowStockItems
        ];
        return view('admin/listitems', $data);
    }

    public function save()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'name_items' => $this->request->getPost('nameItemsInput')
            ];

            if ($this->listitemsModel->saveItems($data)) {
                return $this->response->setJSON(['success' => true, 'message' => 'Items added successfully.']);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Failed to add supplier.']);
            }
        }
    }

    public function edit($id)
    {
        if ($this->request->isAJAX()) {
            $items = $this->listitemsModel->find($id);
            if ($items) {
                return $this->response->setJSON(['success' => true, 'data' => $items]);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Supplier not found.']);
            }
        }
    }


    public function update()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id_items');
            $data = [
                'name_items' => $this->request->getPost('nameItemsEdit')
            ];

            if ($this->listitemsModel->update($id, $data)) {
                return $this->response->setJSON(['success' => true, 'message' => 'Items updated successfully.']);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Failed to update supplier.']);
            }
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id_items');
            if ($this->listitemsModel->delete($id)) {
                return $this->response->setJSON(['success' => true, 'message' => 'Items deleted successfully.']);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Failed to delete supplier.']);
            }
        }
    }
}
