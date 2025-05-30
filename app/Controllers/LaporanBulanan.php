<?php namespace App\Controllers;

use App\Models\SiswaModel;
use CodeIgniter\Controller;

class LaporanBulanan extends Controller
{
    protected $siswaModel;

    public function __construct()
    {
        $this->siswaModel = new SiswaModel();
    }

    public function index()
    {
        $data = [
            'menu' => 'Pelaporan',
            'title' => 'Laporan Bulanan',
        ];

        return view('laporanbulanan', $data);
    }

}