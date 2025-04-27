<?php namespace App\Controllers;

      use App\Models\InfaqModel;
      use App\Models\PembayaranModel;
      use App\Models\SiswaModel;
      use CodeIgniter\Controller;

class Pembayaran extends Controller
{
    protected $pembayaranModel;
    protected $siswaModel;
    protected $infaqModel;

    public function __construct()
    {
        $this->pembayaranModel = new PembayaranModel();
        $this->siswaModel = new SiswaModel();
        $this->infaqModel = new InfaqModel();
    }

    public function index()
    {
        helper(['form']);

        //$pembayaranModel = new PembayaranModel();
        $pembayaran = $this->pembayaranModel->getPembayaran();
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
            'nominal' => 'required|min_length[4]|max_length[7]|numeric',
        ];
        $errors = [
            'idsiswa' => [
                'required'=>'Harus diisi'
            ],
            'idinfaq' => [
                'required'=>'Harus diisi'
            ],
            'nominal' => [
                'required'=>'Harus diisi',
                'min_length'=>'Minimal 4 digit angka',
                'max_length'=>'Maksimal 7 digit angka',
                'numeric'=>'Harus berupa angka (0-9)'
            ],
        ];

        if($this->validate($rules, $errors))
        {
            $data =
            [
                'idsiswa' => $this->request->getVar('idsiswa'),
                'idinfaq' => $this->request->getVar('idinfaq'),
                'nominal' => $this->request->getVar('nominal'),
            ];
            $this->pembayaranModel->save($data);
            return redirect()->to('/pembayaran')->with('success', 'Data pembayaran berhasil ditambahkan.');
        } else {
            session()->setFlashdata('errors', $this->validator->getErrors());
            session()->setFlashdata('show_modal',true);
            return redirect()->back()->withInput();
        }
    }

    public function searchSiswa()
    {
        //$Model = new SiswaModel();
        //$Model = new InfaqModel();
        $keyword = $this->request->getGet('keyword');
        //$result = $Model->like('name', $keyword)
                        //->orLike('nis', $keyword)
                        //->findAll(10);
        $result = $this->siswaModel->search($keyword);
        return $this->response->setJSON($result);
    }

    public function getInfaqByKelas()
    {
        //$Model = new InfaqModel();
        $keyword = $this->request->getGet('kelas');
        //$result = $Model->find($keyword);
        $result = $this->infaqModel->searchByKelas($keyword);
        //$result = $Model->like('kelas',$kelas)->findAll();
        return $this->response->setJSON($result);
    }

    public function delete($id)
    {
        //$model = new PembayaranModel();
        $this->pembayaranModel->delete($id);

        return redirect()->to('/pembayaran')->with('success', 'Data Pembayaran berhasil dihapus.');
    }

    public function detailPembayaran($id)
    {
        //$Model = new PembayaranModel();
        //$data['administrator'] = $model->find($id);
        $pembayaran = $this->pembayaranModel->getPembayaranDelete($id);

        $data = [
            'menu' => 'Pengelolaan',
            'title' => 'Input Pembayaran',
            'pembayaran' => $pembayaran,
            'on' => true,
        ];

        return view('detailpembayaran', $data);
    }
}