<?php

namespace App\Controllers;

use Midtrans\Config;
use Midtrans\Snap;

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
}