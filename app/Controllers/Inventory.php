<?php

namespace App\Controllers;

use App\Models\ListItemsModel;
use App\Models\InventoryModel;
use App\Models\SuppliersModel;
use App\Models\UserModel;
use CodeIgniter\Controller;

class Inventory extends Controller
{
    protected $listitemsModel;
    protected $inventoryModel;
    protected $supplierModel;
    protected $usersModel;



    public function __construct()
    {
        
        $this->listitemsModel = new ListItemsModel();
        $this->inventoryModel = new InventoryModel();
        $this->supplierModel = new SuppliersModel();
        $this->usersModel = new UserModel();

    }

    public function getItems()
    {
        $itemModel = new ListItemsModel();
        $items = $itemModel->findAll();
        return $this->response->setJSON($items);
    }

    public function getSuppliers()
    {
        $supplierModel = new SuppliersModel();
        $suppliers = $supplierModel->findAll();
        return $this->response->setJSON($suppliers);
    }

    public function getUsers()
    {
        $usersModel = new UserModel();
        $users = $usersModel->findAll();
        return $this->response->setJSON($users);
    }

    public function getQc()
    {
        $role_id = $this->request->getVar('role_id');
        $usersModel = new UserModel();

        if ($role_id) {
            $users = $usersModel->getUsersByRole($role_id);
        } else {
            $users = $usersModel->findAll();
        }

        return $this->response->setJSON($users);
    }


    public function index()
    {
        $session = session();
        $listitems = $this->listitemsModel->getTotalStock();
        $limitsitems = $this->listitemsModel->getLowStockItems();

        $data = [
            'title' => 'Inventory',
            'totalStock' => $listitems,
            'username' => $session->get('user_name'), // Mengambil username dari session
            'user_email' => $session->get('user_email'), // Mengambil useremail dari session
            'lowStockItems' => $limitsitems
        ];

        return view('inventory/index', $data);
    }

    public function stockIn()
    {
        $session = session();
        $stockIn = $this->inventoryModel->getInStock();
        $data = [
            'title' => 'Stock In',
            'username' => $session->get('user_name'), // Mengambil username dari session
            'user_email' => $session->get('user_email'), // Mengambil useremail dari session
            'stockIn' => $stockIn
        ];
        return view('inventory/stock_in', $data);
    }

    public function stockOut()
    {
        $session = session();
        $stockOut = $this->inventoryModel->getOutStock();
        $data = [
            'title' => 'Stock Out',
            'username' => $session->get('user_name'), // Mengambil username dari session
            'user_email' => $session->get('user_email'), // Mengambil useremail dari session
            'stockOut' => $stockOut
        ];
        return view('inventory/stock_out', $data);
    }

    // Barang Masuk
    public function InStock()
    {
        $session = session();
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nameItemsInput' => 'required|numeric',
            'nameSuppliersInput' => 'required|numeric',
            'nameQCInput' => 'required|numeric',
            'stockIn' => 'required|numeric',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON(['success' => false, 'errors' => $validation->getErrors()]);
        }

        $id_items = $this->request->getPost('nameItemsInput');
        $id_suppliers = $this->request->getPost('nameSuppliersInput');
        $id_QC = $this->request->getPost('nameQCInput');
        $name_QC = $this->usersModel->find($id_QC)['user_name'];
        $stock_items = $this->request->getPost('stockIn');
        $name_items = $this->listitemsModel->find($id_items)['name_items'];

        // Debugging: tampilkan nilai yang diterima
        // var_dump($id_items);
        // var_dump($id_suppliers);
        // var_dump($name_items);
        // var_dump($stock_items);

        $this->inventoryModel->insert([
            'id_items' => $id_items,
            'id_suppliers' => $id_suppliers,
            'name_items' => $name_items,
            'stock_items' => $stock_items,
            'taken_by' => $name_QC,
            'noted_by' => $session->get('user_name'), // Mengambil username dari session
            'date_update' => date('Y-m-d H:i:s')
        ]);

        return $this->response->setJSON(['success' => true]);
    }

    // Barang Keluar
    public function OutStock()
    {
        $session = session();
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nameItemsInput' => 'required|numeric',
            'nameSuppliersInput' => 'required|numeric',
            'nameUsersInput' => 'required|numeric',
            'stockOut' => 'required|numeric',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON(['success' => false, 'errors' => $validation->getErrors()]);
        }

        $id_items = $this->request->getPost('nameItemsInput');
        $id_suppliers = $this->request->getPost('nameSuppliersInput');
        $id_users = $this->request->getPost('nameUsersInput');
        $stock_items = $this->request->getPost('stockOut');
        $name_items = $this->listitemsModel->find($id_items)['name_items'];

        // Debugging: tampilkan nilai yang diterima
        // var_dump($id_items);
        // var_dump($id_suppliers);
        // var_dump($name_items);
        // var_dump($stock_items);

        $this->inventoryModel->insert([
            'id_items' => $id_items,
            'id_suppliers' => $id_suppliers,
            'name_items' => $name_items,
            'stock_items' => "-".$stock_items,
            'taken_by' => $id_users,
            'noted_by' => $session->get('user_name'), // Mengambil username dari session
            'date_update' => date('Y-m-d H:i:s')
        ]);

        return $this->response->setJSON(['success' => true]);
    }

}
