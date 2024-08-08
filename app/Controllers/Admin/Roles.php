<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RolesModel;
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

class Roles extends BaseController
{
    protected $rolesModel;
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

    public function __construct()
    {
        $this->rolesModel = new RolesModel();
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
        // Ensure user is logged in
        if (!session()->has('user_id')) {
            return redirect()->to('/login');
        }

        // Get roles data
        $roles = $this->rolesModel->getRoles();
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
            'title' => 'Roles List',
            'subtitle' => '',
            'listitems' => $listitems,
            'username' => $session->get('user_name'), // Mengambil username dari session
            'user_email' => $session->get('user_email'), // Mengambil useremail dari session
            'pocount' => $PreOrderCartCount,
            'cartcount' => $cartItemCount,
            'roles' => $roles
        ];
        return view('admin/roles', $data);
    }

    public function save()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'role_name' => $this->request->getPost('roleNameInput')
            ];

            if ($this->rolesModel->save($data)) {
                return $this->response->setJSON(['success' => true, 'message' => 'Role added successfully.']);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Failed to add role.']);
            }
        }
    }

    public function edit($id)
    {
        if ($this->request->isAJAX()) {
            $role = $this->rolesModel->find($id);
            if ($role) {
                return $this->response->setJSON(['success' => true, 'data' => $role]);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Role not found.']);
            }
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('role_id');
            $data = [
                'role_name' => $this->request->getPost('roleNameEdit'),
            ];

            if ($this->rolesModel->update($id, $data)) {
                return $this->response->setJSON(['success' => true, 'message' => 'Role updated successfully.']);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Failed to update role.']);
            }
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('role_id');
            if ($this->rolesModel->delete($id)) {
                return $this->response->setJSON(['success' => true, 'message' => 'Role deleted successfully.']);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Failed to delete role.']);
            }
        }
    }
}
