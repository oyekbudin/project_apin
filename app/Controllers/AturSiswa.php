<?php namespace App\Controllers;

use App\Models\SiswaModel;
use CodeIgniter\Controller;

class AturSiswa extends Controller
{
    public function index()
    {
        helper(['form']);
        $siswaModel = new SiswaModel();
        $perPage = 10;
        $page = (int) ($this->request->getGet('page') ?? 1);
        $total = $siswaModel->countAll();
        
        
        $offset = ($page - 1) * $perPage;
        //$datasiswa = $siswaModel->getPaginatedSiswa($perPage, $offset);
        

        $keyword = $this->request->getGet('keyword');

        if ($keyword) {
            $datasiswa = $siswaModel->search($keyword);
        } else {
            $datasiswa = $siswaModel->getPaginatedSiswa($perPage, $offset);
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
            'nis' => 'required|max_length[4]',
            'name' => 'required|min_length[4]|max_length[40]',
            'phonenumber' => 'required|min_length[10]|max_length[50]',
            'gender' => 'required|max_length[1]',
            'kelas' => 'required|max_length[1]', 
        ];

        if ($this->validate($rules)) {
            $model = new SiswaModel();
            $data = [
                'nis' => $this->request->getVar('nis'),
                'name' => $this->request->getVar('name'),
                'phonenumber' => $this->request->getVar('phonenumber'),
                'gender' => $this->request->getVar('gender'),
                'kelas' => $this->request->getVar('kelas'),
            ];
            $model->save($data);
            return redirect()->to('/atursiswa')->with('success', 'Data siswa berhasil ditambahkan.');
        } else {
            session()->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->to('/atursiswa');
        }
    }

    public function edit($id)
    {
        $model = new SiswaModel();
        $data = [
            'menu' => 'Perencanaan',
            'title' => 'Atur Siswa',
            'siswa' => $model->find($id),
            'on' => true,
        ];
        return view('editsiswa', $data);
    }

    public function update($id)
    {
        $model = new SiswaModel();
        $data = [
            'nis' => $this->request->getPost('nis'),
            'name' => $this->request->getPost('name'),
            'phonenumber' => $this->request->getPost('phonenumber'),
            'gender' => $this->request->getPost('gender'),
            'kelas' => $this->request->getPost('kelas'),
        ];
        $model->update($id, $data);

        return redirect()->to('/atursiswa')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function delete($id)
    {
        $model = new SiswaModel();
        $model->delete($id);

        return redirect()->to('/atursiswa')->with('success', 'Data siswa berhasil dihapus.');
    }
}
