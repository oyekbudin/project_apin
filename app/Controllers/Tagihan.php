<?php namespace App\Controllers;

      use App\Models\InfaqModel;
use App\Models\PembayaranModel;
use App\Models\SiswaModel;
      use CodeIgniter\Controller;

class Tagihan extends Controller
{
    public function index()
    {
        helper(['form']);
        $siswaModel = new SiswaModel();
        $perPage = 10;
        $page = (int) ($this->request->getGet('page') ?? 1);
        $total = $siswaModel->countAll();
        $offset = ($page - 1) * $perPage;
        $keyword = $this->request->getGet('keyword');

        if ($keyword) {
            $siswa = $siswaModel->search($keyword);
        } else {
            $siswa = $siswaModel->getPaginatedSiswa($perPage, $offset);
        }

        $infaqModel = new InfaqModel;
        $infaq = $infaqModel->getDataInfaq();

        $data = [
            'menu' => 'Pengelolaan',
            'title' => 'Tagihan',
            'siswa' => $siswa,
            'infaq' => $infaq,
            'total' => $total,
            'perpage' => $perPage,
            'currentPage' => $page,
            'totalPages' => ($total > 0) ? ceil($total / $perPage) : 1,
            'keyword' => $keyword,
        ];

        return view('tagihan', $data);
    }

    
    protected $pembayaranModel;
    public function __construct()
    {
        $this->pembayaranModel = new PembayaranModel();
    }

    public function daftartagihan($nis)
    {
        $tagihan = $this->pembayaranModel->getTagihan($nis);

        $data = [
            'menu' => 'Pengelolaan',
            'title' => 'Tagihan',
            'tagihan' => $tagihan,
            'on' => true,
        ];

        return view('daftartagihan', $data);
    }
}