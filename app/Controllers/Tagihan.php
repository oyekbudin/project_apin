<?php namespace App\Controllers;

use App\Models\InfaqModel;
use App\Models\SiswaModel;
use App\Models\TagihanModel;
use CodeIgniter\Controller;

class Tagihan extends Controller
{
    //protected $siswaModel = new SiswaModel();
    //protected $infaqModel = new InfaqModel();
    //protected $tagihanModel = new TagihanModel();

    public function __construct()
    {
        $this->infaqModel = new InfaqModel();
        $this->siswaModel = new SiswaModel();
        $this->tagihanModel = new TagihanModel();
    }

    public function index()
    {
        helper(['form']);
        $perPage = 10;
        $page = (int) ($this->request->getGet('page') ?? 1);
        $total = $this->tagihanModel->countAll();
        $offset = ($page - 1) * $perPage;
        $keyword = $this->request->getGet('keyword');

        if ($keyword) {
            $datatagihan = $this->tagihanModel->search($keyword);
        } else {
            $datatagihan = $this->tagihanModel->getPaginated($perPage, $offset);
        }

        $data = [
            'menu' => 'Pengelolaan',
            'title' => 'Tagihan',
            'datatagihan' => $datatagihan,
            'total' => $total,
            'perpage' => $perPage,
            'currentPage' => $page,
            'totalPages' => ($total > 0) ? ceil($total / $perPage) : 1,
            'keyword' => $keyword,
            //'kelas' => $this->kelasModel->getDataKelas(),
        ];

        //print_r($datatagihan);
        return view('tagihan', $data);
    }

    public function save()
    {
        helper(['form']);
        $rules =
        [
            'name' => 'required|min_length[3]|max_length[40]|alpha_numeric_space',
            'kelas_id' => 'required',
            'harga' => 'required|min_length[4]|max_length[7]|numeric',
        ];
        $errors = [
            'name' => [
                'required'=>'Harus diisi',
                'min_length'=>'Minimal 3 karakter',
                'max_length'=>'Maksimal 40 karakter',
                'alpha_numeric_space'=>'Karakter yang diizinkan (A-Z) (0-9)'
            ],
            'kelas_id' => [
                'required'=>'Pilih minimal 1 kelas'
            ],
            'harga' => [
                'required'=>'Harus diisi',
                'min_length'=>'Minimal 4 digit angka',
                'max_length'=>'Maksimal 7 digit angka',
                'numeric'=>'Harus berupa angka (0-9)'
            ],
        ];

        if($this->validate($rules, $errors))
        {
            $dataInfaq =
            [
                'name' => $this->request->getVar('name'),
                //'kelas' => $this->request->getVar('kelas'),
                'harga' => $this->request->getVar('harga'),
            ];
            $kelasId = $this->request->getVar('kelas_id');
            $this->infaqModel->saveInfaq($dataInfaq, $kelasId);
            return redirect()->to('/aturinfaq')->with('success', 'Data infaq berhasil ditambahkan.');
        } else {
            session()->setFlashdata('errors', $this->validator->getErrors());
            session()->setFlashdata('show_modal',true);
            return redirect()->back()->withInput();
        }
    }

    public function edit($id)
    {
        $kelasModel = new KelasModel();

        
        $data = [
            'menu' => 'Perencanaan',
            'title' => 'Atur Jenis Infaq',
            //'infaq' => $this->infaqModel->find($id),
            'infaq' => $this->infaqModel->getInfaqById($id),
            'kelas' => $this->kelasModel->getDataKelas(),
            'on' => true,
        ];
        //$infaq = $this->infaqModel->getInfaqById($id);
        //$infaq2 = $this->infaqModel->find($id);
        //$kelas = $this->kelasModel->getDataKelas();
        //print_r($kelas);
        //print_r($infaq2);
        return view('editinfaq', $data);
    }

    public function update($id)
    {       
        $rules =
        [
            'name' => 'required|min_length[3]|max_length[40]|alpha_numeric_space',
            //'kelas_id' => 'required',
            'harga' => 'required|min_length[4]|max_length[7]|numeric',
        ];
        $errors = [
            'name' => [
                'required'=>'Harus diisi',
                'min_length'=>'Minimal 3 karakter',
                'max_length'=>'Maksimal 40 karakter',
                'alpha_numeric_space'=>'Karakter yang diizinkan (A-Z) (0-9)'
            ],
            //'kelas_id' => [
            //    'required'=>'Pilih minimal 1 kelas'
            //],
            'harga' => [
                'required'=>'Harus diisi',
                'min_length'=>'Minimal 4 digit angka',
                'max_length'=>'Maksimal 7 digit angka',
                'numeric'=>'Harus berupa angka (0-9)'
            ],
        ];

        if ($this->validate($rules, $errors))
        {
            $dataInfaq =
            [
                'name' => $this->request->getVar('name'),
                //'kelas' => $this->request->getVar('kelas'),
                'harga' => $this->request->getVar('harga'),
            ];
            $kelasId = $this->request->getVar('kelas_id');
            //$this->infaqModel->update($id, $data);
            $this->infaqModel->updateInfaq($id, $dataInfaq, $kelasId);
            return redirect()->to('/aturinfaq')->with('success', 'Data infaq berhasil diperbarui');
        } else {
            session()->setFlashdata('errors', $this->validator->getErrors());
            session()->setFlashdata('show_modal',true);
            return redirect()->back()->withInput();
        }
    }

    public function delete($id)
    {
        $this->infaqModel->delete($id);

        return redirect()->to('/aturinfaq')->with('success', 'Data infaq berhasil dihapus.');
    }

    public function detail($id)
    {
        $data = [
            'menu' => 'Pengelolaan',
            'title' => 'Detail Tagihan',
            'tagihan' => $this->tagihanModel->getTagihanById($id),
            'on' => true,
        ];

        //print_r ($data['tagihan']);
        return view('detailtagihan', $data);
    }    
}