<?php namespace App\Controllers;

      use App\Models\InfaqModel;
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
                'status' => 'Sukses',
            ];
            $model->save($data);
            return redirect()->to('/pembayaran')->with('success', 'Data pembayaran berhasil ditambahkan.');
        } else {
            session()->setFlashdata('errors', $this->validator->getErrors());
            //$data['validation'] = $this->validator;
            //echo view('pembayaran', $data);
        }
    }

    public function searchSiswa()
    {
        $Model = new SiswaModel();
        //$Model = new InfaqModel();
        $keyword = $this->request->getGet('keyword');
        //$result = $Model->like('name', $keyword)
                        //->orLike('nis', $keyword)
                        //->findAll(10);
        $result = $Model->search($keyword);
        return $this->response->setJSON($result);
    }

    public function getInfaqByKelas()
    {
        $Model = new InfaqModel();
        $keyword = $this->request->getGet('kelas');
        //$result = $Model->find($keyword);
        $result = $Model->searchByKelas($keyword);
        //$result = $Model->like('kelas',$kelas)->findAll();
        return $this->response->setJSON($result);
    }

    public function delete($id)
    {
        $model = new PembayaranModel();
        $model->delete($id);

        return redirect()->to('/pembayaran')->with('success', 'Data Pembayaran berhasil dihapus.');
    }

    public function confirmdelete($id)
    {
        $Model = new PembayaranModel();
        //$data['administrator'] = $model->find($id);
        $pembayaran = $Model->getPembayaranDelete($id);

        $data = [
            'menu' => 'Pengelolaan',
            'title' => 'Input Pembayaran',
            'pembayaran' => $pembayaran,
            'on' => true,
        ];

        return view('confirmdeletepembayaran', $data);
    }
}