<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class TransactionController extends Controller
{
    public function process()
    {
        // Logika untuk memproses transaksi
        // Misalnya, setelah transaksi berhasil, lakukan redirect ke halaman success
        return redirect()->to('/transaction/success');
    }

    public function outboundsuccess()
    {
        // Tampilkan halaman sukses
        return view('outbound/outboundsuccess');
    }

    public function inboundsuccess()
    {
        // Tampilkan halaman sukses
        return view('inbound/inboundsuccess');
    }
}
