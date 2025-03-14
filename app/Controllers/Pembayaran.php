<?php namespace App\Controllers;

      use App\Models\PembayaranModel;
      use App\Models\SiswaModel;
      use CodeIgniter\Controller;

class Pembayaran extends Controller
{
    public function index()
    {
        helper(['form']);

        $pembayaranModel = new PembayaranModel();
        $pembayaran = $pembayaranModel->getPembayaran();
        //$data['pembayaran'] = $pembayaran;
        //$data['title'] = 'Input Pembayaran';

        $data = [
            'menu' => 'Pengelolaan',
            'title' => 'Input Pembayaran',
            'pembayaran' => $pembayaran,
        ];

        echo view('pembayaran', $data);
    }

    public function save()
    {
        helper(['form']);
        $rules =
        [
            'idsiswa' => 'required',
            'idinfaq' => 'required',
            'nominal' => 'required',
        ];

        if($this->validate($rules))
        {
            $model = new PembayaranModel();
            $data =
            [
                'idsiswa' => $this->request->getVar('idsiswa'),
                'idinfaq' => $this->request->getVar('idinfaq'),
                'nominal' => $this->request->getVar('nominal'),
            ];
            $model->save($data);
            return redirect()->to('/pembayaran');
        } else {
            $data['validation'] = $this->validator;
            echo view('pembayaran', $data);
        }
    }
}