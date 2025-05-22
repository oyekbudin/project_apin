<?php

namespace App\Controllers;

use App\Models\NotificationModel;
use App\Models\PembayaranModel;
use App\Models\PesanWaModel;
use App\Models\SiswaModel;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;

class MidtransController extends BaseController
{
    protected $notificationModel;
    protected $pembayaranModel;
    protected $siswaModel;
    protected $pesanWaModel;
    public function __construct()
    {
        $this->notificationModel = new NotificationModel();
        $this->pembayaranModel = new PembayaranModel();
        $this->siswaModel = new SiswaModel();
        $this->pesanWaModel = new PesanWaModel();
    }
    
    public function callback()
    {
        echo 'berhasil';
    }
    public function finish()
    {
        return redirect()->to('dashboard-walimurid')->with('success', 'Pembayaran berhasil!');
    }
    public function unfinish()
    {
        echo 'unfinish';
    }
    public function error()
    {
        echo 'error';
    }
    public function notification()
    {
        Config::$serverKey = config('Midtrans')->serverKey;
        Config::$isProduction = config('Midtrans')->isProduction;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $notif = new Notification();

        $transaction_status = $notif->transaction_status;
        $order_id = $notif->order_id;
        $status_code = $notif->status_code;
        $fraud_status = $notif->fraud_status;
        $payment_type = $notif->payment_type;
        $gross_amount = $notif->gross_amount;
        $transaction_time = date('Y-m-d H:i:s');

        $existingData = $this->notificationModel->where('order_id', $order_id)->findAll(); //ubah jadi semua order id (array)

        $data = [
                'gross_amount' => $gross_amount,
                'payment_type' => $payment_type,
                'transaction_status' => $transaction_status,                
                'transaction_time' => $transaction_time,
                'status_code' => $status_code,
                'fraud_status' => $fraud_status,
            ];

        if ($existingData) {
            foreach ($existingData as $ed) {
                $this->notificationModel->update($ed['id'], $data);
            }            
        }

        //Jika settlement input data ke tabel pembayaran
        if ($transaction_status === 'settlement') {
            $id_infaq = [];
            $nominal = [];
            foreach ($existingData as $ed) {                                 
                    $id_infaq[] = $ed['id_infaq'];
                    $nominal[] = $ed['nominal'];                
            };
            
             
            $order_id = $existingData[0]['order_id'];
            $id_siswa = $existingData[0]['id_siswa'];
            //$id_infaq = $dataInfaq['id_infaq'];
            //$nominal = $dataInfaq['nominal'];
            $status = $transaction_status;
            $payment_method = $existingData[0]['payment_method'];
            //$transaction_time = $existingData[0]['transaction_time'];

            $this->pembayaranModel->savePembayaran($order_id, $id_siswa, $id_infaq, $nominal, $status, $payment_method);
            
            //Api Saung WA Struk Pembayaran
            //$siswa_id = $this->request->getPost('siswa_id');
            //$header = $this->request->getPost('header');
            //$footer = $this->request->getPost('footer');          
            $siswa = $this->siswaModel->findSiswa($id_siswa);
                //$nis = $siswa['nis'];
                //$tagihan = $this->tagihanModel->getTagihanByRequestById($nis, $request);
            $nomor = preg_replace('/^0/', '62', $siswa['phonenumber']);
            //$id_infaq = 

            $body = '';
            $header = 'SMP Maarif NU 01 Wanareja' . "\n" . 'Jl. KH Hasyim Asyari No. 09, Wanareja' . "\n" . 'Telp. 08121475939' ;
            $body .= 'Nama : ' . $siswa[0]['name'] . "\n" . 'Waktu Transaksi : ' . $transaction_time . 'Nomor Transaksi : ' . $order_id . "\n\n";
            $body .= 'Deskripsi : Pembayaran Tagihan' . "\n" . 'Total pembayaran : Rp ' . number_format($gross_amount, 0, ',', '.') . "\n" . 'Metode Pembayaran : ' . $payment_type . "\n" . 'Status : Berhasil' . "\n\n" ;                
                
           // $body .= '----------' . "\n" . 'Jumlah --- Rp' . number_format($total_tagihan, 0, ',', '.') . "\n";
            
            $footer = 'Terima Kasih' . "\n" . 'Semoga Ilmu Berkah Manfaat' ;
            
            $pesan = $header . "\n\n" .  $body . "\n" . $footer;

            //Api SaungWA
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://app.saungwa.com/api/create-message',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => array(
                        'appkey' => '64dfa16d-cd35-4fa8-bf21-9e93d24ed5c5',
                        'authkey' => 'vu9aMiZvSaC5kblVBQtq3eE9q2XuxJaO1nUsROVrHHJYg5U5ru',
                        'to' => $nomor,
                        'message' => $pesan,
                        'sandbox' => 'false'
                    ),
                ));
                $response = curl_exec($curl);
                curl_close($curl);
                
                

                $this->pesanWaModel->insert([
                    'nomor_penerima' => $nomor,
                    'nama_penerima' => $siswa['name'],
                    'pesan' => $pesan,
                    'status' => 'Terkirim',
                    'response_json' => $response,
                ]);

        } //close settlement

        return $this->response->setStatusCode(200)->setBody('OK');        
    }
    public function logError()
    {
        $json = $this->request->getJSON(true); // ambil JSON sebagai array

        if ($json) {
            // Simpan ke log_error_pembayaran atau tabel log lainnya
            $this->db->table('log_error_pembayaran')->insert([
                'order_id' => $json['order_id'] ?? null,
                'status_message' => $json['status_message'] ?? null,
                'status_code' => $json['status_code'] ?? null,
                'transaction_status' => $json['transaction_status'] ?? null,
                'payment_type' => $json['payment_type'] ?? null,
                'raw_response' => json_encode($json),
                'created_at' => date('Y-m-d H:i:s')
            ]);

            return $this->response->setStatusCode(200)->setBody('Error berhasil disimpan');
        }

        return $this->response->setStatusCode(400)->setBody('Data kosong');
    }

}