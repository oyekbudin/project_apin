<?php

namespace Config;

class Midtrans
{
    public $serverKey;
    public $clientKey;
    public $isProduction;
    public $snapUrl = 'https://app.sandbox.midtrans.com/snap/v2';

    public function __construct()
    {
        $this->serverKey = env('midtrans.serverKey');
        $this->clientKey = env('midtrans.clientKey');
        $this->isProduction = env('midtrans.isProduction');
    }
}