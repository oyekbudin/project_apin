<?php

use GuzzleHttp\Client;

if (!function_exists('supabase_request')) {
    function supabase_request($endpoint, $method = 'GET', $data = [])
    {
        $client = new Client([
            'base_uri' => 'https://kzafhlsjyaujmgrmrhqn.supabase.co', // Ganti dengan URL proyek Supabase
            'headers' => [
                'apikey' => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6Imt6YWZobHNqeWF1am1ncm1yaHFuIiwicm9sZSI6ImFub24iLCJpYXQiOjE3NDIzNDc2OTMsImV4cCI6MjA1NzkyMzY5M30.GkH1kDLMyHcXOLLkb8lUc-va5Oq76FZvP6aaKewd-wE', // Ganti dengan API Key Supabase
                'Authorization' => 'Bearer your-anon-key',
                'Content-Type' => 'application/json'
            ]
        ]);

        $options = ($method !== 'GET') ? ['json' => $data] : [];

        $response = $client->request($method, $endpoint, $options);
        return json_decode($response->getBody(), true);
    }
}
