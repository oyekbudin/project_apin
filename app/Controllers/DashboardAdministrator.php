<?php namespace App\Controllers;

      use App\Models\InfaqModel;
      use App\Models\PembayaranModel;
      use App\Models\SiswaModel;
      use App\Models\TagihanAktifModel;
      use App\Models\TagihanModel;
      use CodeIgniter\Controller;

class DashboardAdministrator extends Controller
{
    protected $pembayaranModel;
    protected $tagihanModel;
    protected $tagihanAktifModel;

    public function __construct()
    {
        $this->pembayaranModel = new PembayaranModel();
        $this->tagihanModel = new TagihanModel();
        $this->tagihanAktifModel = new TagihanAktifModel();
    }
    public function index()
    {
        $session = session();

        $siswaModel = new SiswaModel();
        $infaqModel = new InfaqModel();
        
        $bulan = date('m');    

        $total_pembayaran = 0;
        $all_pembayaran = $this->pembayaranModel->getTotalPembayaran();  
        if ($all_pembayaran) {
            $total_pembayaran += $all_pembayaran[0]['total_nominal'];
        }  

        $total_bulan_ini = 0;
        $kredit_bulan_ini = $this->pembayaranModel->getPembayaranBulanIni($bulan); 
        if ($kredit_bulan_ini) {
            $total_bulan_ini += $kredit_bulan_ini[0]['total_nominal'];
        }


        
        $total_sisa_tagihan = 0;
        $tagihan_aktif = $this->tagihanAktifModel->orderBy('id','desc')->first();
        if ($tagihan_aktif) {
            $request = $tagihan_aktif['id_tagihan'];
        $sisa_tagihan = $this->tagihanModel->getSisaTagihan($request);
        
        foreach ($sisa_tagihan as $s) {
            $total_sisa_tagihan += $s['sisa_tagihan'];
        };
        }

        $data = [
            'menu' => 'Dashboard',
            'title' => 'Dashboard',
            'totalsiswa' => $siswaModel->getTotalSiswa(),
            'totalinfaq' => $infaqModel->getTotalInfaq(),
            //'total_pembayaran' => $total_pembayaran[0]['total_nominal'],
            //'kredit_bulan_ini' => $kredit_bulan_ini[0]['total_nominal'],
            'total_pembayaran' => $total_pembayaran,
            'kredit_bulan_ini' => $total_bulan_ini,
            'sisa_tagihan' => $total_sisa_tagihan,
        ];
        //echo "Selamat datang. ".$session->get('name')." Sebagai :".$session->get('role');
        //echo '<pre>';
        //print_r($data);
        //echo '</pre>';
        echo view('rekapdata', $data);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('loginadministrator');
    }
}