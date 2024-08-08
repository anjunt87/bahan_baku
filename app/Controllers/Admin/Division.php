<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DivisionModel;
use App\Models\DepartmentModel;
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

class Division extends BaseController
{
    protected $divisionModel;
    protected $departmentModel;
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
        $this->divisionModel = new DivisionModel();
        $this->departmentModel = new DepartmentModel();
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
            'title' => 'Data Division',
            'subtitle' => '',
            'listitems' => $listitems,
            'username' => $session->get('user_name'), // Mengambil username dari session
            'user_email' => $session->get('user_email'), // Mengambil useremail dari session
            'pocount' => $PreOrderCartCount,
            'cartcount' => $cartItemCount,
            'divisions' => $this->divisionModel->getDivisionsWithDepartment(),
            'departments' => $this->departmentModel->findAll()
        ];
        return view('admin/division', $data);
    }

    public function save()
    {
        $data = [
            'department_id' => $this->request->getPost('department_id'),
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description')
        ];

        if ($this->divisionModel->save($data)) {
            return redirect()->to('/admin/division')->with('success', 'Division added successfully.');
        } else {
            return redirect()->to('/admin/division')->with('error', 'Failed to add division.');
        }
    }

    public function edit($id)
    {
        $data = $this->divisionModel->find($id);
        return $this->response->setJSON($data);
    }

    public function update($id)
    {
        $data = [
            'department_id' => $this->request->getPost('department_id'),
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description')
        ];

        if ($this->divisionModel->update($id, $data)) {
            return redirect()->to('/admin/division')->with('success', 'Division updated successfully.');
        } else {
            return redirect()->to('/admin/division')->with('error', 'Failed to update division.');
        }
    }

    public function delete($id)
    {
        if ($this->divisionModel->delete($id)) {
            return redirect()->to('/admin/division')->with('success', 'Division deleted successfully.');
        } else {
            return redirect()->to('/admin/division')->with('error', 'Failed to delete division.');
        }
    }
}
