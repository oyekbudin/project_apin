<?php namespace App\Controllers;

      use App\Models\AdministratorModel;
use App\Models\InfaqModel;
use App\Models\KelasModel;
use App\Models\RequestTagihanModel;
use App\Models\TagihanAktifModel;
use App\Models\TagihanInfaqModel;
use CodeIgniter\Controller;

class RequestTagihan extends Controller
{
    protected $infaqModel;
    protected $kelasModel;
    protected $requestTagihanModel;
    //protected $tagihanInfaqModel;
    protected $administratorModel;
    protected $tagihanAktifModel;

    public function __construct()
    {
        $this->infaqModel = new InfaqModel();
        $this->kelasModel = new KelasModel();
        $this->requestTagihanModel = new RequestTagihanModel();
        //$this->tagihanInfaqModel = new TagihanInfaqModel();
        $this->administratorModel = new AdministratorModel();
        $this->tagihanAktifModel = new TagihanAktifModel();
    }

    public function index()
    {
        helper(['form']);
        $session = session();
        $perPage = 10;
        $page = (int) ($this->request->getGet('page') ?? 1);
        $total = $this->requestTagihanModel->countAll();
        $offset = ($page - 1) * $perPage;
        $keyword = $this->request->getGet('keyword');

        if ($keyword) {
            $datarequest = $this->requestTagihanModel->search($keyword);
        } else {
            $datarequest = $this->requestTagihanModel->getPaginated($perPage, $offset);
        }

        $tagihan_aktif = $this->tagihanAktifModel->orderBy('id','desc')->first();
        if ($tagihan_aktif) {
            $aktif = $tagihan_aktif['id_tagihan'];
        } else {
            $aktif = '';
        }

        $data = [
            'menu' => 'Pengelolaan',
            'title' => 'Tagihan',
            'datarequest' => $datarequest,
            'total' => $total,
            'perpage' => $perPage,
            'currentPage' => $page,
            'totalPages' => ($total > 0) ? ceil($total / $perPage) : 1,
            'keyword' => $keyword,
            'infaq' => $this->infaqModel->getDataInfaq(),
            'session' => $session->get(),
            //'tagihan_aktif' => $tagihan_aktif['id_tagihan'],
            'tagihan_aktif' => $aktif,
        ];

        //echo '<pre>';
        //print_r($data);
        //echo '</pre>';
        return view('request_tagihan', $data);
    }

    public function save()
    {
        helper(['form']);
        $rules =
        [
            'title' => 'required|min_length[3]|max_length[40]|alpha_numeric_space',
            'infaq_id' => 'required',
            'idadmin' => 'required',
            'status' => 'required',
        ];
        $errors = [
            'title' => [
                'required'=>'Harus diisi',
                'min_length'=>'Minimal 3 karakter',
                'max_length'=>'Maksimal 40 karakter',
                'alpha_numeric_space'=>'Karakter yang diizinkan (A-Z) (0-9)'
            ],
            'infaq_id' => [
                'required'=>'Pilih minimal 1 infaq'
            ],
            'idadmin' => [
                'required'=>'idadmin belum diset'
            ],
            'status' => [
                'required'=>'status belum diset'
            ],
        ];

        if($this->validate($rules, $errors))
        {
            $dataRequest =
            [
                'title' => $this->request->getVar('title'),
                'id_admin' => $this->request->getVar('idadmin'),
                'status' => $this->request->getVar('status'),
            ];
            $infaqId = $this->request->getVar('infaq_id');
            $this->requestTagihanModel->saveRequest($dataRequest, $infaqId);
            return redirect()->to('/request_tagihan')->with('success', 'Data Tagihan berhasil diajukan.');
        } else {
            session()->setFlashdata('errors', $this->validator->getErrors());
            session()->setFlashdata('show_modal',true);
            return redirect()->back()->withInput();
        }
    }

    public function edit($id)
    {
        //$kelasModel = new KelasModel();
        $session = session();        
        $data = [
            'menu' => 'Pengelolaan',
            'title' => 'Tagihan',
            //'infaq' => $this->infaqModel->find($id),
            'datarequest' => $this->requestTagihanModel->getReqTagihanById($id),
            //'kelas' => $this->kelasModel->getDataKelas(),
            'on' => true,
            'session' => $session->get(),
        ];
        //echo '<pre>';print_r($data);echo '</pre>';


        return view('edit-request-tagihan', $data);
    }

    public function update($id)
    {
        //$status = $this->request->getVar('status');
        $data = [
            'status' => $this->request->getVar('status'),
        ];
        $this->requestTagihanModel->update($id, $data);
        //print_r ($data);
        return redirect()->to('/request_tagihan')->with('success', 'Status tagihan berhasil diperbarui');
    }

    public function delete($id)
    {
        $this->requestTagihanModel->delete($id);

        return redirect()->to('/request_tagihan')->with('success', 'Data tagihan berhasil dihapus.');
    }

    public function confirmdeleteinfaq($id)
    {
        $data = [
            'menu' => 'Perencanaan',
            'title' => 'Atur Jenis Infaq',
            //'infaq' => $this->infaqModel->find($id),
            'infaq' => $this->infaqModel->getInfaqById($id),
            'on' => true,
        ];

        return view('confirmdeleteinfaq', $data);
    }    
}