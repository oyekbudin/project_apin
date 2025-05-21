<?php

namespace App\Controllers;

use App\Models\NotificationModel;
use App\Models\PembayaranModel;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;

class MidtransController extends BaseController
{
    protected $notificationModel;
    protected $pembayaranModel;
    public function __construct()
    {
        $this->notificationModel = new NotificationModel();
        $this->pembayaranModel = new PembayaranModel();
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

            $this->pembayaranModel->savePembayaran($order_id, $id_siswa, $id_infaq, $nominal, $status, $payment_method);
            //return redirect()->to('dashboard-walimurid')->with('success', 'Pembayaran Berhasil');
        }

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