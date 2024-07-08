<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $data = array(
            "gogo"  => "go"
        );
        return view('auth', $data);
    }
}
