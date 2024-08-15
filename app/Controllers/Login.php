<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\CartModel;
use App\Models\ListItemsModel;
use App\Models\PreOrderCartModel;
use App\Models\OutboundModel;
use App\Models\OutboundItemModel;

class Login extends Controller
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
    protected $preOrderItemsModel;

    public function __construct()
    {

        $this->listitemsModel = new ListItemsModel();
        $this->outboundModel = new OutboundModel();
        $this->outboundItemModel = new OutboundItemModel();
        $this->usersModel = new UserModel();
        $this->cartModel = new CartModel();
        $this->itemModel = new ListItemsModel();
        $this->preOrderCartModel = new PreOrderCartModel();
    }

    // public function index()
    // {
    //     helper(['form']);
    //     echo view('login');
    // }

    // public function auth()
    // {
    //     $session = session();
    //     $model = new UserModel();
    //     $username = $this->request->getVar('username');
    //     $password = $this->request->getVar('password');
    //     $data = $model->getUserByUsername($username);
    //     if ($data) {
    //         $pass = $data['user_password'];
    //         $verify_pass = password_verify($password, $pass);
    //         if ($verify_pass) {
    //             $role = $model->getUserRole($data['user_id']);
    //             $ses_data = [
    //                 'user_id'       => $data['user_id'],
    //                 'user_name'     => $data['user_name'],
    //                 'user_email'    => $data['user_email'],
    //                 'role_id'       => $data['role_id'],
    //                 'role_name'     => $role['role_name'],
    //                 'logged_in'     => TRUE
    //             ];
    //             $session->set($ses_data);

    //             // Arahkan berdasarkan peran
    //             switch ($role['role_name']) {
    //                 case 'admin':
    //                     return redirect()->to('/admin');
    //                 case 'manager':
    //                     return redirect()->to('/manager');
    //                 case 'staff':
    //                     return redirect()->to('/staff');
    //                 default:
    //                     return redirect()->to('/login');
    //             }
    //         } else {
    //             $session->setFlashdata('msg', 'Wrong Password');
    //             return redirect()->to('/login');
    //         }
    //     } else {
    //         $session->setFlashdata('msg', 'Username not Found');
    //         return redirect()->to('/login');
    //     }
    // }

    // public function changePassword()
    // {
    //     // Pastikan pengguna sudah login
    //     if (!session()->has('user_id')) {
    //         return redirect()->to('/login');
    //     }

    //     $cartModel = new CartModel();
    //     $itemsModel = new ListItemsModel();
    //     $preOrderCartModel = new PreOrderCartModel();

    //     // Ambil data user dari session
    //     $session = session();
    //     $user_id = $session->get('user_id');
    //     $username = $session->get('user_name');
    //     $user_email = $session->get('user_email');

    //     // Hitungan di navigasi bar
    //     $cartItemCount = $cartModel->getCartItemCount();
    //     $PreOrderCartCount = $preOrderCartModel->getPreorderCartCount();

    //     // data inti per controller
    //     // $outbound = $this->outboundModel->getOutboundById($outboundId);
    //     // $outboundItems = $this->outboundItemModel->getItemsByOutboundId($outboundId);

    //     // Mendapatkan username dari ID pengguna
    //     // $notedByUsername = $this->usersModel->getUsernameById($outbound['user_id']);
    //     // $receivedByUsername = $this->usersModel->getUsernameById($outbound['recipient_id']);

    //     $data = [
    //         'title' => 'Change Password',
    //         'subtitle' => '',
    //         'username' => $session->get('user_name'), // Mengambil username dari session
    //         'user_email' => $session->get('user_email'), // Mengambil useremail dari session
    //         'pocount' => $PreOrderCartCount,
    //         'cartcount' => $cartItemCount
    //     ];
    //     return view('change_password', $data); // Nama view untuk form perubahan password
    // }

    // public function doChangePassword()
    // {
    //     $session = session();
    //     $username = $session->get('username');

    //     $oldPassword = $this->request->getPost('old_password');
    //     $newPassword = $this->request->getPost('new_password');
    //     $confirmPassword = $this->request->getPost('confirm_password');

    //     if ($newPassword !== $confirmPassword) {
    //         return redirect()->back()->with('error', 'Konfirmasi password tidak sesuai.');
    //     }

    //     $userModel = new UserModel();
    //     $user = $userModel->verifyPassword($username, md5($oldPassword)); // Verifikasi password lama

    //     if (!$user) {
    //         return redirect()->back()->with('error', 'Password lama salah.');
    //     }

    //     // Update password
    //     $userModel->update($user['id'], ['password' => md5($newPassword)]);

    //     return redirect()->to('/dashboard')->with('success', 'Password berhasil diubah.');
    // }


    // public function logout()
    // {
    //     $session = session();
    //     $session->destroy();
    //     return redirect()->to('/login');
    // }
}
