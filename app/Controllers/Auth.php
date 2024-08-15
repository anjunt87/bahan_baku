<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CartModel;
use App\Models\ListItemsModel;
use App\Models\PreOrderCartModel;
use App\Models\OutboundModel;
use App\Models\OutboundItemModel;


class Auth extends BaseController
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

    // public function login()
    // {
    //     return view('auth');
    // }

    // public function doLogin()
    // {
    //     $username = $this->request->getPost('username');
    //     $password = $this->request->getPost('password');

    //     $userModel = new UserModel();
    //     $user = $userModel->verifyPassword($username, md5($password)); // Gunakan md5 untuk hashing password

    //     if ($user) {
    //         $session = session();
    //         $session->set([
    //             'username' => $user['username'],
    //             'role'     => $user['role'],
    //             'logged_in' => true
    //         ]);
    //         return redirect()->to('/dashboard');
    //     } else {
    //         return redirect()->back()->with('error', 'Username atau password salah');
    //     }
    // }

    // public function logout()
    // {
    //     session()->destroy();
    //     return redirect()->to('/login');
    // }

    public function index()
    {
        helper(['form']);
        echo view('login');
    }

    public function auth()
    {
        $session = session();
        $model = new UserModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $data = $model->getUserByUsername($username);
        if ($data) {
            $pass = $data['user_password'];
            $verify_pass = password_verify($password, $pass);
            if ($verify_pass) {
                $role = $model->getUserRole($data['user_id']);
                $ses_data = [
                    'user_id'       => $data['user_id'],
                    'user_name'     => $data['user_name'],
                    'user_email'    => $data['user_email'],
                    'role_id'       => $data['role_id'],
                    'role_name'     => $role['role_name'],
                    'logged_in'     => TRUE
                ];
                $session->set($ses_data);

                // Arahkan berdasarkan peran
                switch ($role['role_name']) {
                    case 'admin':
                        return redirect()->to('/admin');
                    case 'manager':
                        return redirect()->to('/manager');
                    case 'staff':
                        return redirect()->to('/staff');
                    default:
                        return redirect()->to('/login');
                }
            } else {
                $session->setFlashdata('msg', 'Wrong Password');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('msg', 'Username not Found');
            return redirect()->to('/login');
        }
    }

    public function changePassword()
    {
        // Pastikan pengguna sudah login
        if (!session()->has('user_id')) {
            return redirect()->to('/login');
        }

        $cartModel = new CartModel();
        $itemsModel = new ListItemsModel();
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
        // $outbound = $this->outboundModel->getOutboundById($outboundId);
        // $outboundItems = $this->outboundItemModel->getItemsByOutboundId($outboundId);

        // Mendapatkan username dari ID pengguna
        // $notedByUsername = $this->usersModel->getUsernameById($outbound['user_id']);
        // $receivedByUsername = $this->usersModel->getUsernameById($outbound['recipient_id']);

        $data = [
            'title' => 'Change Password',
            'subtitle' => '',
            'username' => $session->get('user_name'), // Mengambil username dari session
            'user_email' => $session->get('user_email'), // Mengambil useremail dari session
            'pocount' => $PreOrderCartCount,
            'cartcount' => $cartItemCount
        ];
        return view('change_password', $data); // Nama view untuk form perubahan password
    }

    public function doChangePassword()
    {
        $session = session();
        $userModel = new UserModel();

        // Ambil data dari form
        $oldPassword = $this->request->getPost('old_password');
        $newPassword = $this->request->getPost('new_password');
        $confirmPassword = $this->request->getPost('confirm_password');

        // Ambil username dari session
        $username = $session->get('user_name');

        // Verifikasi password lama
        $user = $userModel->where('user_name', $username)->first();

        if ($user && password_verify($oldPassword, $user['user_password'])) {
            if ($newPassword === $confirmPassword) {
                $userModel->update($user['user_id'], [
                    'user_password' => password_hash($newPassword, PASSWORD_DEFAULT)
                ]);

                $session->setFlashdata('success', 'Password berhasil diubah.');
            } else {
                $session->setFlashdata('error', 'Password baru dan konfirmasi password tidak cocok.');
            }
        } else {
            $session->setFlashdata('error', 'Password lama tidak sesuai.');
        }
        return redirect()->back();
    }


    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }

}
