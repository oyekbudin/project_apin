<?php namespace App\Controllers;

      use App\Models\InfaqModel;
use App\Models\NotificationModel;
use App\Models\SiswaModel;
use App\Models\TagihanAktifModel;
use App\Models\TagihanModel;
use CodeIgniter\Controller;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction;
use Ramsey\Uuid\Uuid;

class MPembayaran extends Controller
{
    protected $tagihanAktifModel;
    protected $tagihanModel;
    protected $notificationModel;

    public function __construct()
    {
        $this->tagihanAktifModel = new TagihanAktifModel();
        $this->tagihanModel = new TagihanModel();
        $this->notificationModel = new NotificationModel();
    }

    public function tagihan()
    {
        $session = session();
        $id = $session->get('nis');
        $nama = $session->get('name');
        $kelas = $session->get('kelas');

        //$pendingNotif = $this->notificationModel->getPendingNotifById($id)->first();
        $pendingNotif = $this->notificationModel->where('id_siswa',$id)->where('transaction_status','pending')->first();
        if ($pendingNotif && $pendingNotif['transaction_status'] === 'pending') {
            $data = [
            'menu' => 'Pembayaran',
            'title' => 'Checkout',
            'total_pembayaran' => $pendingNotif['gross_amount'],
            'nama' => $nama,
            'kelas' => $kelas,
            'snaptoken' => $pendingNotif['snaptoken'],
            'order_id' => $pendingNotif['order_id'],
            ];

            //print_r($data);
            echo view('m-checkout', $data);
        } else {
            $tagihan_aktif = $this->tagihanAktifModel->orderBy('date','desc')->first();
            if ($tagihan_aktif) {
                $request = $tagihan_aktif['id_tagihan'];
                $tagihan = $this->tagihanModel->getTagihanByRequestById($id, $request);
            } else {
                $tagihan = [];
            }

            $data = [
                'menu' => 'Pembayaran',
                'title' => 'Pembayaran',
                'tagihan' => $tagihan,
            ];        
            echo view('m-pembayaran', $data);
        }        
    }

    public function checkout()
{
    $session = session();
    $id = $session->get('nis');
    $first_name = $session->get('name');
    $last_name = $session->get('kelas');
    $phone = $session->get('phonenumber');
    
    $gross_amount = $this->request->getVar('nilaiTotal');
    $date = date('md');
    $order_id = $date . $id . uniqid();

    // Ambil dari form
    $id_infaq = $this->request->getVar('infaq_id'); // array terpilih
    $nominal  = $this->request->getVar('nominal');  // array asosiatif

    //midtrans
    Config::$serverKey = config('Midtrans')->serverKey;
    Config::$isProduction = config('Midtrans')->isProduction;
    Config::$isSanitized = true;
    Config::$is3ds = true;

    $params = [
        'transaction_details' => [
            'order_id' => $order_id,
            'gross_amount' => $gross_amount,
        ],
        'customer_details' => [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => 'hakimarvinnoer@gmail.com',
            'phone' => $phone,
        ],
        'locale' => 'id',
        'callbacks' => [
            'finish' => base_url('payment/finish'),
            'unfinish' => base_url('payment/unfinish'),
            'error' => base_url('payment/error'),
        ]
    ];

    $snaptoken = Snap::getSnapToken($params);

    $data = [
        'menu' => 'Pembayaran',
        'title' => 'Checkout',
        'total_pembayaran' => $gross_amount,
        'nama' => $first_name,
        'kelas' => $last_name,
        'snaptoken' => $snaptoken,
        'id_siswa' => $id,
        'id_infaq' => $id_infaq,
        'nominal' => $nominal,
        'order_id' => $order_id,
        'transaction_status' => 'pending',
        'payment_method' => 'midtrans',
        'gross_amount' => $gross_amount,
    ];

    $this->notificationModel->saveNotification($data);
    echo view('m-checkout', $data);
}


    public function oldcheckout()
    {
        $session = session();
        $id = $session->get('nis');
        $first_name = $session->get('name');
        $last_name = $session->get('kelas');
        $phone = $session->get('phonenumber');
        $gross_amount = $this->request->getVar('nilaiTotal');
        $date = date('md');
        $order_id = $date . $id . uniqid();
        $id_infaq = $this->request->getVar('infaq_id');
        //$tagihan_aktif = $this->tagihanAktifModel->orderBy('id','desc')->first();
        //$request = $tagihan_aktif['id_tagihan'];
        //$nis = $id;

        
        
        $tagihan_aktif = $this->tagihanAktifModel->orderBy('id','desc')->first();
/*
        echo '<pre>';
        print_r($tagihan_aktif);
        echo '</pre>';
        */
        if ($tagihan_aktif) {
            $request = $tagihan_aktif['id_tagihan'];
            $tagihan = $this->tagihanModel->getNominalInfaq($id, $request, $id_infaq);
        } else {
            $tagihan = '';
        }

        //midtrans
        Config::$serverKey = config('Midtrans')->serverKey;
        Config::$isProduction = config('Midtrans')->isProduction;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params =
        [
            'transaction_details' =>
            [
                'order_id' => $order_id,
                'gross_amount' => $gross_amount,
            ],
            'customer_details' =>
            [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => 'hakimarvinnoer@gmail.com',
                'phone' => $phone,
            ],
            'locale' => 'id',
            'callbacks' => [
                'finish' => base_url('payment/finish'),
                'unfinish' => base_url('payment/unfinish'),
                'error' => base_url('payment/error'),
            ]
        ];

        $snaptoken = Snap::getSnapToken($params);         //aktifkan lagi nanti

        $data = [
            'menu' => 'Pembayaran',
            'title' => 'Checkout',
            //'infaq_id' => $id_infaq,
            'total_pembayaran' => $gross_amount,
            'nama' => $first_name,
            'kelas' => $last_name,
            //'tagihan' => $this->tagihanModel->getTagihanByRequestById($id, $request),
            'snaptoken' => $snaptoken,   //aktifkan lagi nanti
            //'snaptoken' => '123456',   //aktifkan lagi nanti
            //'tagihan' => $tagihan,   //ada nis, id_infaq, sisa_tagihan
            //'id_siswa' => array_column($tagihan, 'nis'),
            //'id' => Uuid::uuid4()->toString(),
            'id_siswa' => $id,
            'id_infaq' => array_column($tagihan, 'id_infaq'),
            'nominal' => array_column($tagihan, 'sisa_tagihan'),
            'order_id' => $order_id,
            'transaction_status' => 'pending',
            'payment_method' => 'midtrans',
            'gross_amount' => $gross_amount,
        ];
        
        //echo "Selamat datang. ".$session->get('name')." Sebagai :".$session->get('role');
        
        //$this->notificationModel->saveNotification($data['order_id'], $data['id_siswa'], $data['id_infaq'], $data['nominal'], $data['transaction_status'], $data['payment_method'], $data['gross_amount']);
        $this->notificationModel->saveNotification($data);
        //echo '<pre>';
        //print_r($data);
        //echo '</pre>';
        echo view('m-checkout', $data);
        
    }


    public function cancel($id)
    {
        // Konfigurasi Midtrans
        Config::$serverKey = config('Midtrans')->serverKey;
        Config::$isProduction = config('Midtrans')->isProduction;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Ambil semua data berdasarkan order_id
        $order_data = $this->notificationModel->where('order_id', $id)->findAll();

        if (!$order_data) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
        }

        $payment_type = array_column($order_data, 'payment_type');
        $row_ids = array_column($order_data, 'id');

        if (!empty($payment_type[0])) {
            try {
                $cancel = \Midtrans\Transaction::cancel($id);

                /*return $this->response->setJSON([
                    'message' => 'Transaksi dibatalkan',
                    'midtrans' => $cancel
                ]);*/
                return redirect()->to('/dashboard-walimurid')->with('success', 'Transaksi dibatalkan');

            } catch (\Exception $e) {
                /*return $this->response->setJSON([
                    'error' => 'Gagal membatalkan di Midtrans: ' . $e->getMessage()
                ]);*/
                return redirect()->to('/dashboard-walimurid')->with('error', 'Gagal membatalkan di Midtrans: ' . $e->getMessage());

            }
        } else {
            // Jika belum pernah dibayar atau snap_token belum ada
            foreach ($row_ids as $rid) {
                /*$this->notificationModel->update($rid, [
                    'transaction_status' => 'cancel'
                ]);*/
                $this->notificationModel->delete($rid);

            }

            return redirect()->to('/dashboard-walimurid')->with('success', 'Transaksi dibatalkan');
        }
    }


}