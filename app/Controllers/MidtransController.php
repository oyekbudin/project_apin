<?php

namespace App\Controllers;

use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;

class MidtransController extends BaseController
{
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
        //handle callback
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
        // Konfigurasi Midtrans
        Config::$serverKey = config('Midtrans')->serverKey;
        Config::$isProduction = config('Midtrans')->isProduction;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Tangkap notifikasi dari Midtrans
        $notif = new Notification();

        // Ambil data penting
        $transaction = $notif->transaction_status;
        $order_id    = $notif->order_id;
        $status_code = $notif->status_code;
        $fraud       = $notif->fraud_status;
        $payment_type = $notif->payment_type;
        $gross_amount = $notif->gross_amount;

        // Contoh aksi ketika sukses
        if ($transaction == 'capture' || $transaction == 'settlement') {
            // Simpan ke tabel pembayaran
            $pembayaranModel = new \App\Models\PembayaranModel();       // <-- ubah ke tabel notifikasi
            $pembayaranModel->insert([
                'order_id' => $order_id,
                'gross_amount' => $gross_amount,
                'payment_type' => $payment_type,
                'transaction_status' => $transaction,
                'time' => date('Y-m-d H:i:s')
            ]);
        }

        return $this->response->setStatusCode(200)->setBody('OK');
    }
}