<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
        $session = session();
        $data = [
            'title' => 'Admin Dashboard',
            'users' => '100',
            'username' => $session->get('user_name'), // Mengambil username dari session
            'user_email' => $session->get('user_email') // Mengambil username dari session
        ];
        return view('admin/index', $data);
    }
}
