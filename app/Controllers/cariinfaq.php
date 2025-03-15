<?php

namespace App\Controllers;

use App\Models\InfaqModel;
use CodeIgniter\Controller;

class Cariinfaq extends Controller
{
    public function index()
    {
        $Model = new InfaqModel();
        $keyword = $this->request->getGet('keyword');

        if ($keyword) {
            $data['infaq'] = $Model->search($keyword);
        } else {
            $data['infaq'] = $Model->findAll();
        }

        return view('cariinfaq', $data);
    }
}
