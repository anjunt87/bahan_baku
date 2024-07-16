<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class Login extends Controller
{
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
                        return redirect()->to('/manager/dashboard');
                    case 'user':
                        return redirect()->to('/user/dashboard');
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

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}
