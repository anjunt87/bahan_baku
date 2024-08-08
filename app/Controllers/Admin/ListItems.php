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

class ListItems extends BaseController
{
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
        $itemsModel = new ListItemsModel();  // This is the correct way to instantiate the model
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
        $listitems = $itemsModel->findAll();  // Use the correct variable for the model

        $data = [
            'title' => 'List Items',
            'subtitle' => '',
            'username' => $username,    // Mengambil username dari session
            'user_email' => $user_email, // Mengambil useremail dari session
            'pocount' => $PreOrderCartCount,
            'cartcount' => $cartItemCount,
            'listitems' => $listitems,  // Pass the data to the view
        ];

        return view('admin/listitems', $data);
    }

    public function save()
    {
        $itemModel = new ListItemsModel();
        $request = \Config\Services::request();

        $name = $request->getPost('nameItemsInput');
        $previousStock = $request->getPost('previousStockInput');
        $stock = $request->getPost('stockItemsInput');
        $description = $request->getPost('descriptionInput');
        $image = $request->getFile('imageInput');

        // Validate form inputs
        if (empty($name) || empty($previousStock) || empty($stock) || empty($description)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'All fields are required.',
            ]);
        }

        // Handle image upload
        $imagePath = '';
        if ($image->isValid() && !$image->hasMoved()) {
            // Save the file to the public/uploads directory
            $imagePath = $image->getName();
            $image->move(ROOTPATH . 'public/uploads', $image->getName());
        }

        // Prepare data for insertion
        $data = [
            'name_items' => $name,
            'previous_stock' => $previousStock,
            'stock_items' => $stock,
            'description' => $description,
            'image' => $imagePath,
        ];

        try {
            $itemModel->insert($data);
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Item saved successfully.',
            ]);
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return $this->response->setJSON([
                'success' => false,
                'message' => 'An error occurred while saving the item.',
            ]);
        }
    }

    public function edit($id)
    {
        if ($this->request->isAJAX()) {
            $item = $this->itemModel->find($id);
            if ($item) {
                return $this->response->setJSON(['success' => true, 'data' => $item]);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Item not found.']);
            }
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id_items');
            $data = [
                'name_items' => $this->request->getPost('nameItemsEdit'),
                'previous_stock' => $this->request->getPost('previousStockEdit'),
                'stock_items' => $this->request->getPost('stockItemsEdit'),
                'description' => $this->request->getPost('descriptionEdit')
            ];

            $file = $this->request->getFile('imageEdit');
            if ($file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move(ROOTPATH . 'public/uploads', $newName);
                $data['image'] = $newName;
            }

            if ($this->itemModel->update($id, $data)) {
                return $this->response->setJSON(['success' => true, 'message' => 'Item updated successfully.']);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Failed to update item.']);
            }
        }
    }

    
    public function delete()
    {
        if ($this->request->isAJAX()) {
            // $id = $this->request->getPost('id_items');
            $id = $this->request->getPost('id_items_delete');
            log_message('info', 'ID received for deletion: ' . $id);
            if ($this->itemModel->delete($id)) {
                return $this->response->setJSON(['success' => true, 'message' => 'Item deleted successfully.']);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Failed to delete item.']);
            }
        }
    }
}
