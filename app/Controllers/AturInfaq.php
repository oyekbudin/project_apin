<?php namespace App\Controllers;

      use App\Models\InfaqModel;
      use CodeIgniter\Controller;

class AturInfaq extends Controller
{
    protected $infaqModel;

    public function __construct()
    {
        $this->infaqModel = new InfaqModel();
    }

    public function index()
    {
        helper(['form']);
        $perPage = 10;
        $page = (int) ($this->request->getGet('page') ?? 1);
        $total = $this->infaqModel->countAll();
        $offset = ($page - 1) * $perPage;
        $keyword = $this->request->getGet('keyword');

        if ($keyword) {
            $datainfaq = $this->infaqModel->search($keyword);
        } else {
            $datainfaq = $this->infaqModel->getPaginated($perPage, $offset);
        }

        $data = [
            'menu' => 'Perencanaan',
            'title' => 'Atur Jenis Infaq',
            'datainfaq' => $datainfaq,
            'total' => $total,
            'perpage' => $perPage,
            'currentPage' => $page,
            'totalPages' => ($total > 0) ? ceil($total / $perPage) : 1,
            'keyword' => $keyword,
        ];

        return view('aturinfaq', $data);
    }

    public function save()
    {
        helper(['form']);
        $rules =
        [
            'name' => 'required|min_length[3]|max_length[40]|alpha_numeric_space',
            'kelas' => 'required|min_length[1]|max_length[3]|numeric',
            'harga' => 'required|min_length[4]|max_length[7]|numeric',
        ];
        $errors = [
            'name' => [
                'required'=>'Harus diisi',
                'min_length'=>'Minimal 3 karakter',
                'max_length'=>'Maksimal 40 karakter',
                'alpha_numeric_space'=>'Karakter yang diizinkan (A-Z) (0-9)'
            ],
            'kelas' => [
                'required'=>'Harus diisi',
                'min_length'=>'Minimal 1 karakter',
                'max_length'=>'Maksimal 3 karakter',
                'numeric'=>'Harus berupa angka (0-9)'
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
            $data =
            [
                'name' => $this->request->getVar('name'),
                'kelas' => $this->request->getVar('kelas'),
                'harga' => $this->request->getVar('harga'),
            ];
            $this->infaqModel->save($data);
            return redirect()->to('/aturinfaq')->with('success', 'Data infaq berhasil ditambahkan.');
        } else {
            session()->setFlashdata('errors', $this->validator->getErrors());
            session()->setFlashdata('show_modal',true);
            return redirect()->back()->withInput();
        }
    }

    public function edit($id)
    {
        $data = [
            'menu' => 'Perencanaan',
            'title' => 'Atur Jenis Infaq',
            'infaq' => $this->infaqModel->find($id),
            'on' => true,
        ];
        return view('editinfaq', $data);
    }

    public function update($id)
    {       
        $rules =
        [
            'name' => 'required|min_length[3]|max_length[40]|alpha_numeric_space',
            'kelas' => 'required|min_length[1]|max_length[3]|numeric',
            'harga' => 'required|min_length[4]|max_length[7]|numeric',
        ];
        $errors = [
            'name' => [
                'required'=>'Harus diisi',
                'min_length'=>'Minimal 3 karakter',
                'max_length'=>'Maksimal 40 karakter',
                'alpha_numeric_space'=>'Karakter yang diizinkan (A-Z) (0-9)'
            ],
            'kelas' => [
                'required'=>'Harus diisi',
                'min_length'=>'Minimal 1 karakter',
                'max_length'=>'Maksimal 3 karakter',
                'numeric'=>'Harus berupa angka (0-9)'
            ],
            'harga' => [
                'required'=>'Harus diisi',
                'min_length'=>'Minimal 4 digit angka',
                'max_length'=>'Maksimal 7 digit angka',
                'numeric'=>'Harus berupa angka (0-9)'
            ],
        ];

        if ($this->validate($rules, $errors))
        {
            $data =
            [
                'name' => $this->request->getVar('name'),
                'kelas' => $this->request->getVar('kelas'),
                'harga' => $this->request->getVar('harga'),
            ];
            $this->infaqModel->update($id, $data);
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

    public function confirmdeleteinfaq($id)
    {
        $data = [
            'menu' => 'Perencanaan',
            'title' => 'Atur Jenis Infaq',
            'infaq' => $this->infaqModel->find($id),
            'on' => true,
        ];

        return view('confirmdeleteinfaq', $data);
    }    
}