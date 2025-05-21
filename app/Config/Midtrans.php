<?php

namespace Config;

class Midtrans
{
    public $serverKey = env('midtrans.serverKey');
    public $clientKey = env('midtrans.clientKey');
    public $isProduction = env('midtrans.isProduction');
    public $snapUrl = 'https://app.sandbox.midtrans.com/snap/v2';
}