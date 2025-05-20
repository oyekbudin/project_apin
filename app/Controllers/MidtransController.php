<?php

namespace App\Controllers;

use App\Models\NotificationModel;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;

class MidtransController extends BaseController
{
    protected $notificationModel;
    public function __construct()
    {
        $this->notificationModel = new NotificationModel();
    }
    public function index()
    {
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

        $snapToken = Snap::getSnapToken($params);

        return view('midtrans/index', ['snapToken' => $snapToken]);
    }

    public function callback()
    {
        echo 'berhasil';
    }
    public function finish(): void
    {
        echo 'finish';
    }
    public function unfinish()
    {
        echo 'unfinish';
    }

    /*public function notification()
{
    // Konfigurasi Midtrans
    Config::$serverKey = config('Midtrans')->serverKey;
    Config::$isProduction = config('Midtrans')->isProduction;

    $notif = new Notification();

    $transaction = $notif->transaction_status;
    $type = $notif->payment_type;
    $order_id = $notif->order_id;
    $gross_amount = $notif->gross_amount;

    // Jika status pembayaran sukses
    if ($transaction == 'capture' || $transaction == 'settlement') {
        // Simpan ke tabel pembayaran Anda
        $db = \Config\Database::connect();
        $db->table('pembayaran')->insert([
            'order_id' => $order_id,
            'nominal' => $gross_amount,
            'payment_type' => $type,
            'status' => $transaction,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }

    return $this->response->setJSON(['message' => 'Notification processed']);
}*/
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
        $transaction_time = $notif->transaction_time;

        $existingData = $this->notificationModel->where('order_id', $order_id)->findAll(); //ubah jadi semua order id (array)

        //mengecek setiap data notification yang order_id = $order_id
        //update data

        $data = [
                //'order_id' => $order_id,
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

        return $this->response->setStatusCode(200)->setBody('OK');

        /* Jika order_id sudah ada, maka update data
        else {
            $data = [
                'order_id' => $order_id,
                'gross_amount' => $gross_amount,
                'payment_type' => $payment_type,
                'transaction_status' => $transaction_status,                
                'transaction_time' => $transaction_time,                
            ];

            $this->notificationModel->insert($data);
        }
        

        // Jika transaction dibuat, maka insert data ke notification
        // Jika transaction = success, maka pembayaranModel->insert($data)


        
        /*

        if ($transaction_status == 'capture' || $transaction_status == 'settlement') {
            

            $pembayaranModel->insert([
                'order_id' => $order_id,
                'gross_amount' => $gross_amount,
                'payment_type' => $payment_type,
                'transaction_status' => $transaction_status,
            ]);
        }

        */
        
    }
}