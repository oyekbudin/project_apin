<?php namespace App\Controllers;

use App\Models\PembayaranModel;
use App\Models\SiswaModel;
use CodeIgniter\Controller;

class LaporanBulanan extends Controller
{
    protected $siswaModel;
    protected $pembayaranModel;

    public function __construct()
    {
        $this->siswaModel = new SiswaModel();
        $this->pembayaranModel = new PembayaranModel();
    }

    public function index()
    {
        $pembayaran = $this->pembayaranModel->getPembayaran();

        $data = [
            'menu' => 'Pelaporan',
            'title' => 'Laporan Bulanan',
            'pembayaran' => $pembayaran,
        ];

        return view('laporanbulanan', $data);
    }

}