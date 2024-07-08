<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'users' => '100'
        ];
        return view('admin/index', $data);
    }
}
