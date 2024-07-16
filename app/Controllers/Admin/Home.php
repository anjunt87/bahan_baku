<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
<<<<<<< HEAD
        $session = session();
        $data = [
            'title' => 'Admin Dashboard',
            'users' => '100',
            'username' => $session->get('user_name'), // Mengambil username dari session
            'user_email' => $session->get('user_email') // Mengambil username dari session
=======
        $data = [
            'users' => '100'
>>>>>>> a1db0e873e44bc891e2523d379275f537bf08e83
        ];
        return view('admin/index', $data);
    }
}
