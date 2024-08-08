<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
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

class Department extends BaseController
{
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
            'title' => 'Data Department',
            'subtitle' => '',
            'listitems' => $listitems,
            'username' => $session->get('user_name'), // Mengambil username dari session
            'user_email' => $session->get('user_email'), // Mengambil useremail dari session
            'pocount' => $PreOrderCartCount,
            'cartcount' => $cartItemCount,
            'departments' => $this->departmentModel->findAll()
        ];
       
        return view('admin/department', $data);
    }

    public function save()
    {
        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description')
        ];

        if ($this->departmentModel->save($data)) {
            return redirect()->to('/admin/department')->with('success', 'Department added successfully.');
        } else {
            return redirect()->to('/admin/department')->with('error', 'Failed to add department.');
        }
    }

    public function edit($id)
    {
        $data = $this->departmentModel->find($id);
        return $this->response->setJSON($data);
    }

    public function update($id)
    {
        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description')
        ];

        if ($this->departmentModel->update($id, $data)) {
            return redirect()->to('/admin/department')->with('success', 'Department updated successfully.');
        } else {
            return redirect()->to('/admin/department')->with('error', 'Failed to update department.');
        }
    }

    public function delete($id)
    {
        if ($this->departmentModel->delete($id)) {
            return redirect()->to('/admin/department')->with('success', 'Department deleted successfully.');
        } else {
            return redirect()->to('/admin/department')->with('error', 'Failed to delete department.');
        }
    }
}
