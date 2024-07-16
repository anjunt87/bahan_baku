<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
<<<<<<< HEAD
        return view('auth');
=======
        $data = array(
            "gogo"  => "go"
        );
        return view('auth', $data);
>>>>>>> a1db0e873e44bc891e2523d379275f537bf08e83
    }
}
