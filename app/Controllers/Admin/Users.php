<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\Controller;
use App\Models\ListItemsModel;
use App\Models\SuppliersModel;
use App\Models\OrderModel;
use App\Models\CartModel;
use App\Models\OutboundModel;
use App\Models\OutboundItemModel;
use App\Models\PreOrderModel;
use App\Models\PreOrderCartModel;
use App\Models\DivisionModel;

class Users extends BaseController
{
    protected $usersModel;
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
    protected $preOrderModel;
    protected $preOrderCartModel;
    protected $divisionModel;

    public function __construct()
    {
        $this->usersModel = new UserModel();
        $this->listitemsModel = new ListItemsModel();
        $this->suppliersModel = new SuppliersModel();
        $this->outboundModel = new OutboundModel();
        $this->outboundItemModel = new OutboundItemModel();
        $this->cartModel = new CartModel();
        $this->itemModel = new ListItemsModel();
        $this->preOrderModel = new PreOrderModel();
        $this->preOrderCartModel = new PreOrderCartModel();
        $this->divisionModel = new DivisionModel();

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

        $data = [
            'title' => 'User Management',
            'subtitle' => '',
            'listitems' => $listitems,
            'username' => $session->get('user_name'), // Mengambil username dari session
            'user_email' => $session->get('user_email'), // Mengambil useremail dari session
            'pocount' => $PreOrderCartCount,
            'cartcount' => $cartItemCount,
            'users' => $this->usersModel->findAll(),
            'username' => $session->get('user_name'),
            'user_email' => $session->get('user_email')
        ];

        return view('admin/users', $data);
    }

    public function save()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'user_name' => $this->request->getPost('userName'),
                'user_email' => $this->request->getPost('userEmail'),
                'user_password' => password_hash($this->request->getPost('userName'), PASSWORD_DEFAULT),
                // 'user_password' => password_hash($this->request->getPost('userPassword'), PASSWORD_DEFAULT),
                'role_id' => $this->request->getPost('roleId'),
                'department_id' => $this->request->getPost('departmentId'),
                'division_id' => $this->request->getPost('divisionId'),
            ];

            if ($this->usersModel->addUser($data)) {
                return $this->response->setJSON(['success' => true, 'message' => 'User added successfully.']);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Failed to add user.']);
            }
        }
    }

    public function edit($id)
    {
        if ($this->request->isAJAX()) {
            $user = $this->usersModel->find($id);
            if ($user) {
                return $this->response->setJSON(['success' => true, 'data' => $user]);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'User not found.']);
            }
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('userId');
            $data = [
                'user_name' => $this->request->getPost('userNameEdit'),
                'user_email' => $this->request->getPost('userEmailEdit'),
                'role_id' => $this->request->getPost('roleIdEdit'),
                'department_id' => $this->request->getPost('departmentIdEdit'),
                'division_id' => $this->request->getPost('divisionIdEdit'),
            ];

            if ($this->usersModel->updateUser($id, $data)) {
                return $this->response->setJSON(['success' => true, 'message' => 'User updated successfully.']);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Failed to update user.']);
            }
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('userId');
            if ($this->usersModel->deleteUser($id)) {
                return $this->response->setJSON(['success' => true, 'message' => 'User deleted successfully.']);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Failed to delete user.']);
            }
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid request.']);
        }
    }

}
