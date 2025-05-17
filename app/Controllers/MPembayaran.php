<?php namespace App\Controllers;

      use App\Models\InfaqModel;
      use App\Models\SiswaModel;
use App\Models\TagihanAktifModel;
use App\Models\TagihanModel;
use CodeIgniter\Controller;

class MPembayaran extends Controller
{
    protected $tagihanAktifModel;
    protected $tagihanModel;

    public function __construct()
    {
        $this->tagihanAktifModel = new TagihanAktifModel();
        $this->tagihanModel = new TagihanModel();
    }
    public function index()
    {
        $session = session();

        $siswaModel = new SiswaModel();
        $infaqModel = new InfaqModel();
        $id_tagihan = $this->tagihanAktifModel->orderBy('id','desc')->first();

        $data = [
            'menu' => 'Pembayaran',
            'title' => 'Pembayaran',
            'totalsiswa' => $siswaModel->getTotalSiswa(),
            'totalinfaq' => $infaqModel->getTotalInfaq(),
            'id_tagihan' => $id_tagihan,
        ];
        //echo "Selamat datang. ".$session->get('name')." Sebagai :".$session->get('role');
        echo view('m-pembayaran', $data);
    }

    public function tagihan()
    {
        $session = session();
        $id = $session->get('nis');
        $tagihan_aktif = $this->tagihanAktifModel->orderBy('id','desc')->first();
        $request = $tagihan_aktif['id_tagihan'];
        //$nis = $id;

        $data = [
            'menu' => 'Pembayaran',
            'title' => 'Pembayaran',
            'tagihan' => $this->tagihanModel->getTagihanByRequestById($id, $request),
        ];
        //echo "Selamat datang. ".$session->get('name')." Sebagai :".$session->get('role');
        
        echo view('m-pembayaran', $data);
    }
}