<?php namespace App\Controllers;

      use App\Models\InfaqModel;
use App\Models\PembayaranModel;
use App\Models\SiswaModel;
use App\Models\TagihanDetailModel;
use App\Models\TagihanModel;
      use CodeIgniter\Controller;

class Tagihan extends Controller
{
    protected $pembayaranModel;
    protected $siswaModel;
    protected $tagihanModel;
    protected $infaqModel;
    protected $tagihanDetailModel;
    public function __construct()
    {
        $this->pembayaranModel = new PembayaranModel();
        $this->siswaModel = new SiswaModel();
        $this->tagihanModel = new TagihanModel();
        $this->infaqModel = new InfaqModel();
        $this->tagihanDetailModel = new TagihanDetailModel();
    }

    public function index()
    {
        helper(['form']);
        $tagihan = $this->tagihanModel->getTagihan();
        $infaq = $this->infaqModel->findAll();
        $data = [
            'menu' => 'Pengelolaan',
            'title' => 'Tagihan',
            'tagihan' => $tagihan,
            'infaq' => $infaq
        ];

        echo view('tagihan', $data);
    }       

    public function lihatkartu()
    {
        $nis = $this->request->getGet('nis');
        $kelas = $this->request->getGet('kelas');
        $tagihan = $this->pembayaranModel->getTagihan($nis, $kelas);

        $data = [
            'menu' => 'Pengelolaan',
            'title' => 'Tagihan',
            'tagihan' => $tagihan,
            'on' => true,
        ];

        return view('kartuinfaq', $data);
    }

    public function buatTagihan()
    {
        $tagihanModel = new TagihanModel();
        $tagihanDetailModel = new TagihanDetailModel();
        $siswaModel = new SiswaModel();
        $infaqModel = new InfaqModel();
        $siswaList = $siswaModel->findAll();
        $selectedInfaq = $this->request->getPost('infaq'); 

        if (!$selectedInfaq) {
            return redirect()->back()->with('error', 'Pilih minimal satu infaq');
        }

        foreach ($siswaList as $siswa) {
            $idTagihan = $tagihanModel->insert([
                'idsiswa' => $siswa['nis'],
                'tanggal' => date('Y-m-d'),
                'total'   => 0
            ], true);

            $totalTagihan = 0;
            $dataDetail = [];

            foreach ($selectedInfaq as $idinfaq) {
                $infaq = $infaqModel->find($idinfaq);
                $nominal = $infaq['harga'];

                $totalTagihan += $nominal;

                $dataDetail[] = [
                    'idtagihan'   => $idTagihan,
                    'idinfaq'     => $idinfaq,
                    'nominal'     => $nominal,
                    'sudah_dibayar' => 0
                ];
            }

            // Simpan detail tagihan
            $tagihanDetailModel->insertBatch($dataDetail);

            // Update total tagihan
            $tagihanModel->update($idTagihan, ['total' => $totalTagihan]);
        }

        return redirect()->back()->with('success', 'Tagihan berhasil dibuat');
    }

    public function checkbox()
    {
        $checkbox = $this->request->getVar('checkbox') ?? [];
        echo "<pre>";
        print_r($checkbox);
        echo "</pre>";
    }

    public function detailTagihan($id)
    {
        $tagihan = $this->tagihanDetailModel->getDetailTagihan($id);

        $data = [
            'menu' => 'Pengelolaan',
            'title' => 'Tagihan',
            'tagihan' => $tagihan,
            'on' => true,
        ];

        return view('detailtagihan', $data);
    }

}