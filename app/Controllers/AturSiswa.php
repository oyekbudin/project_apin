<?php namespace App\Controllers;

use App\Models\SiswaModel;
use CodeIgniter\Controller;

class AturSiswa extends Controller
{
    protected $siswaModel;

    public function __construct()
    {
        $this->siswaModel = new SiswaModel();
    }

    public function index()
    {
        helper(['form']);
        $perPage = 10;
        $page = (int) ($this->request->getGet('page') ?? 1);
        $total = $this->siswaModel->countAll();
        $offset = ($page - 1) * $perPage;
        $keyword = $this->request->getGet('keyword');

        if ($keyword) {
            $datasiswa = $this->siswaModel->search($keyword);
        } else {
            $datasiswa = $this->siswaModel->getPaginatedSiswa($perPage, $offset);
        }

        $data = [
            'menu' => 'Perencanaan',
            'title' => 'Atur Siswa',
            'datasiswa' => $datasiswa,
            'total' => $total,
            'perpage' => $perPage,
            'currentPage' => $page,
            'totalPages' => ($total > 0) ? ceil($total / $perPage) : 1,
            'keyword' => $keyword,
        ];

        return view('atursiswa', $data);
    }

    public function save()
    {
        helper(['form']);
        $rules = [
            'nis' => 'required|max_length[4]|numeric',
            'name' => 'required|min_length[4]|max_length[40]|alpha_space',
            'phonenumber' => 'required|min_length[10]|max_length[15]|numeric',
            'gender' => 'required|max_length[1]',
            'kelas' => 'required|max_length[1]', 
        ];
        $errors = [
            'nis' => [
                'required'=>'Harus diisi',
                'max_length'=>'Maksimal 4 karakter',
                'numeric'=>'Harus berupa angka (0-9)'],
            'name' => [
                'required'=>'Harus diisi',
                'min_length'=>'Minimal 4 karakter',
                'max_length'=>'Maksimal 40 karakter',
                'alpha_space'=>'Tidak boleh mengandung Angka (0-9)'],
            'phonenumber' => [
                'required'=>'Harus diisi',
                'min_length'=>'Minimal 10 karakter',
                'max_length'=>'Maksimal 15 karakter',
                'numeric'=>'Harus berupa angka (0-9)'],
            'gender' => [
                'required'=>'Harus diisi',
                'max_length'=>'Maksimal 1 karakter'],
            'kelas' => [
                'required'=>'Harus diisi',
                'max_length'=>'Maksimal 1 karakter'],
        ];

        if ($this->validate($rules, $errors)) {
            $data = [
                'nis' => $this->request->getVar('nis'),
                'name' => $this->request->getVar('name'),
                'phonenumber' => $this->request->getVar('phonenumber'),
                'gender' => $this->request->getVar('gender'),
                'kelas' => $this->request->getVar('kelas'),
            ];
            $this->siswaModel->save($data);
            return redirect()->to('/atursiswa')->with('success', 'Data siswa berhasil ditambahkan.');
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
            'title' => 'Atur Siswa',
            'siswa' => $this->siswaModel->find($id),
            'on' => true,
        ];
        return view('editsiswa', $data);
    }

    public function update($id)
    {
        $rules = [
            'nis' => 'required|max_length[4]|numeric',
            'name' => 'required|min_length[4]|max_length[40]|alpha_space',
            'phonenumber' => 'required|min_length[10]|max_length[15]|numeric',
            'gender' => 'required|max_length[1]',
            'kelas' => 'required|max_length[1]', 
        ];
        $errors = [
            'nis' => [
                'required'=>'Harus diisi',
                'max_length'=>'Maksimal 4 karakter',
                'numeric'=>'Harus berupa angka (0-9)'
            ],
            'name' => [
                'required'=>'Harus diisi',
                'min_length'=>'Minimal 4 karakter',
                'max_length'=>'Maksimal 40 karakter',
                'alpha_space'=>'Tidak boleh mengandung Angka (0-9)'
            ],
            'phonenumber' => [
                'required'=>'Harus diisi',
                'min_length'=>'Minimal 10 karakter',
                'max_length'=>'Maksimal 15 karakter',
                'numeric'=>'Harus berupa angka (0-9)'
            ],
            'gender' => [
                'required'=>'Harus diisi',
                'max_length'=>'Maksimal 1 karakter'
            ],
            'kelas' => [
                'required'=>'Harus diisi',
                'max_length'=>'Maksimal 1 karakter'
            ],
        ];

        if ($this->validate($rules, $errors))
        {
            $data = [
                'nis' => $this->request->getVar('nis'),
                'name' => $this->request->getVar('name'),
                'phonenumber' => $this->request->getVar('phonenumber'),
                'gender' => $this->request->getVar('gender'),
                'kelas' => $this->request->getVar('kelas'),
            ];
            $this->siswaModel->update($id, $data);
            return redirect()->to('/atursiswa')->with('success', 'Data siswa berhasil diperbarui');
        } else {
            session()->setFlashdata('errors', $this->validator->getErrors());
            session()->setFlashdata('show_modal',true);
            return redirect()->back()->withInput();
        }
    }

    public function delete($id)
    {
        $this->siswaModel->delete($id);

        return redirect()->to('/atursiswa')->with('success', 'Data siswa berhasil dihapus.');
    }

    public function confirmdelete($id)
    {
        $data = [
            'menu' => 'Perencanaan',
            'title' => 'Atur Siswa',
            'siswa' => $this->siswaModel->find($id),
            'on' => true,
        ];

        return view('confirmdelete', $data);
    }
}