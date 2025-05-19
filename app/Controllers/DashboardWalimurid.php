<?php namespace App\Controllers;

      use App\Models\InfaqModel;
      use App\Models\PembayaranModel;
      use App\Models\SiswaModel;
use App\Models\TagihanAktifModel;
use App\Models\TagihanModel;
use CodeIgniter\Controller;

class DashboardWalimurid extends Controller
{
    protected $pembayaranModel;
    protected $tagihanModel;
    protected $tagihanAktifModel;
    public function __construct()
    {
        $this->pembayaranModel = new PembayaranModel();
        $this->tagihanModel = new TagihanModel();
        $this->tagihanAktifModel = new TagihanAktifModel;
    }
    public function index()
    {
        $session = session();
        $id = $session->get('nis');
        $tagihan_aktif = $this->tagihanAktifModel->orderBy('id','desc')->first();
        if ($tagihan_aktif) {
            $aktif = $tagihan_aktif['id_tagihan'];
            $tagihan = $this->tagihanModel->getTagihanByRequestById($id, $aktif);
        } else {
            $aktif = '';
            $tagihan = '';
        }
        //$request = $tagihan_aktif['id_tagihan'];
        $request = $aktif;

        $data = [
            'menu' => 'Home',
            'title' => 'Home',
            'pembayaran' => $this->pembayaranModel->getPembayaranBySiswa($id),
            //'tagihan' => $this->tagihanModel->getTagihanByRequestById($id, $request),
            'tagihan' => $tagihan,
        ];
        //echo "Selamat datang. ".$session->get('name')." Sebagai :".$session->get('role');
        //echo '<pre>';
        //print_r($data['pembayaran']);
        //echo '</pre>';
        echo view('riwayat-pembayaran', $data);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('loginadministrator');
    }

    
}