<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use CodeIgniter\Database\BaseConnection;

class DBTest extends Controller
{
    public function index()
    {
        $db = \Config\Database::connect();

        try {
            $db->connect();
            return "Koneksi Database Berhasil";
        } catch (\Exception $e) {
            return "Koneksi gagal: " . $e->getMessage();
        }
    }
}