<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class sa extends BaseController
{
    public function index()
    {
        if (!session()->has('id_pegawai')) {
            return redirect()->to('/login'); // Ganti '/login' dengan URL yang benar
        } elseif (session()->has('level') && session()->get('level') === 'admin') {
            return redirect()->to('/admin'); // Ganti '/admin' dengan URL yang benar
        } else {
            return redirect()->to('/dashboard'); // Ganti '/dashboard' dengan URL yang benar
        }
    }
}
