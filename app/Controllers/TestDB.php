<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use Config\Database;

class TestDB extends Controller
{
    public function index()
    {
            try {
        $db = Database::connect();
        // Coba query sederhana untuk memicu error jika koneksi gagal
        $db->query('SELECT 1');
        echo "Koneksi database berhasil!";
    } catch (\Throwable $e) {
        // Tampilkan pesan error asli
        echo "Error: " . $e->getMessage();
    }
    }
}
