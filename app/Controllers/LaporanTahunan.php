<?php namespace App\Controllers;

use App\Models\SiswaModel;
use CodeIgniter\Controller;

class LaporanTahunan extends Controller
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
            'title' => 'Laporan Tahunan',
        ];

        return view('laporantahunan', $data);
    }

}