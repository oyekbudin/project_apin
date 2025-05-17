<?php namespace App\Controllers;

      use App\Models\InfaqModel;
      use App\Models\SiswaModel;
use App\Models\TagihanAktifModel;
use App\Models\TagihanModel;
use CodeIgniter\Controller;
use Midtrans\Config;
use Midtrans\Snap;

class MPembayaran extends Controller
{
    protected $tagihanAktifModel;
    protected $tagihanModel;

    public function __construct()
    {
        $this->tagihanAktifModel = new TagihanAktifModel();
        $this->tagihanModel = new TagihanModel();
    }
    /*public function index()
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
    }*/

    public function tagihan()
    {
        $session = session();
        $id = $session->get('nis');
        $tagihan_aktif = $this->tagihanAktifModel->orderBy('id','desc')->first();
        $request = $tagihan_aktif['id_tagihan'];
        //$nis = $id;

        /*midtrans
        Config::$serverKey = config('Midtrans')->serverKey;
        Config::$isProduction = config('Midtrans')->isProduction;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params =
        [
            'transaction_details' =>
            [
                'order_id' => uniqid(),
                'gross_amount' => 10000,
            ],
            'customer_details' =>
            [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john@example.com',
                'phone' => '08123456789',
            ],
        ];

        $snapToken = Snap::getSnapToken($params);*/

        $data = [
            'menu' => 'Pembayaran',
            'title' => 'Pembayaran',
            'tagihan' => $this->tagihanModel->getTagihanByRequestById($id, $request),
            //'snapToken' => $snapToken,
        ];
        //echo "Selamat datang. ".$session->get('name')." Sebagai :".$session->get('role');
        
        echo view('m-pembayaran', $data);
    }

    public function snap_token()
{
    Config::$serverKey = config('Midtrans')->serverKey;
    Config::$isProduction = config('Midtrans')->isProduction;
    Config::$isSanitized = true;
    Config::$is3ds = true;

    $total = $this->request->getPost('total_tagihan');
    $gross_amount = (int) $total;

    $params = [
        'transaction_details' => [
            'order_id' => 'ORDER-' . time(),
            'gross_amount' => 100000,
        ],
        'customer_details' => [
            'first_name' => 'Siswa',
            'email' => 'siswa@example.com',
            'phone' => '08123456789',
        ],
    ];

    $snapToken = Snap::getSnapToken($params);
    return $this->response->setJSON($snapToken);
    //print_r($total);
}

public function checkout()
    {
        $session = session();
        $id = $session->get('nis');
        $nama = $session->get('name');
        $kelas = $session->get('kelas');
        $phone = $session->get('phonenumber');
        //$tagihan_aktif = $this->tagihanAktifModel->orderBy('id','desc')->first();
        //$request = $tagihan_aktif['id_tagihan'];
        //$nis = $id;

        //midtrans
        Config::$serverKey = config('Midtrans')->serverKey;
        Config::$isProduction = config('Midtrans')->isProduction;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params =
        [
            'transaction_details' =>
            [
                'order_id' => uniqid(),
                'gross_amount' => $this->request->getVar('nilaiTotal'),
            ],
            'customer_details' =>
            [
                'first_name' => $nama,
                'last_name' => $kelas,
                'email' => 'john@example.com',
                'phone' => $phone,
            ],
            'locale' => 'id',
        ];

        $snapToken = Snap::getSnapToken($params);

        $data = [
            'menu' => 'Pembayaran',
            'title' => 'Checkout',
            'infaq_id' => $this->request->getVar('infaq_id[]'),
            'total_pembayaran' => $this->request->getVar('nilaiTotal'),
            'nama' => $nama,
            'kelas' => $kelas,
            //'tagihan' => $this->tagihanModel->getTagihanByRequestById($id, $request),
            'snapToken' => $snapToken,
        ];
        //echo "Selamat datang. ".$session->get('name')." Sebagai :".$session->get('role');
        //print_r($data);
        echo view('m-checkout', $data);
    }

}