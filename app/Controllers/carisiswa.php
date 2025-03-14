<?php

namespace App\Controllers;

use App\Models\SiswaModel;
use CodeIgniter\Controller;

class Carisiswa extends Controller
{
    public function index()
    {
        $siswaModel = new SiswaModel();
        $keyword = $this->request->getGet('keyword');

        if ($keyword) {
            $data['siswa'] = $siswaModel->search($keyword);
        } else {
            $data['siswa'] = $siswaModel->findAll();
        }

        return view('carisiswa', $data);
    }
}
