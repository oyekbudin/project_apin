<?php namespace App\Controllers;

      use App\Models\SiswaModel;
      use CodeIgniter\Controller;

class AturSiswa extends Controller
{
    public function index()
    {
        helper(['form']);
        $siswaModel = new SiswaModel();
        //$lihatdata = $siswaModel->findAll();

        $perPage = 9;
        $page = (int) ($this->request->getGet('page') ?? 1);
        $offset = ($page - 1) * $perPage;
        //$totalPages = ($total > 0) ? ceil($total / $perPage) : 1; 
        $total = $siswaModel->countAll();

        $data = [
            'menu' => 'Perencanaan',
            'title' => 'Atur Siswa',
            //'lihatdata' => $lihatdata,
            'datasiswa' => $siswaModel->getPaginatedSiswa($perPage, $offset),
            'total' => $total,
            'perpage' => $perPage,
            'currentPage' => $page,
            'totalPages' => ($total > 0) ? ceil($total / $perPage) : 1,
        ];

        return view('atursiswa', $data);
    }

    public function save()
    {
        helper(['form']);
        $rules =
        [
            'nis' => 'required|max_length[4]',
            'name' => 'required|min_length[4]|max_length[40]',
            'phonenumber' => 'required|min_length[10]|max_length[50]',
            'gender' => 'required|max_length[1]',
            'kelas' => 'required|max_length[1]|',
        ];

        if($this->validate($rules))
        {
            $model = new SiswaModel();
            $data =
            [
                'nis' => $this->request->getVar('nis'),
                'name' => $this->request->getVar('name'),
                'phonenumber' => $this->request->getVar('phonenumber'),
                'gender' => $this->request->getVar('gender'),
                'kelas' => $this->request->getVar('kelas'),
            ];
            $model->save($data);
            return redirect()->to(base_url('atursiswa'));
        } else {
            $lihatmodel = new SiswaModel();
            $lihatdata = $lihatmodel->findAll();
            $data = [
                'menu' => 'Perencanaan',
                'title' => 'Atur Siswa',
                'lihatdata' => $lihatdata,
                'validation' => $this->validator,
                'on' => true,
            ];
            //$data['validation'] = $this->validator;
            return view('atursiswa', $data);
            //return redirect()->to(base_url('atursiswa'));
        }
    }

    public function edit($id)
    {
        $model = new SiswaModel();
        $data['siswa'] = $model->find($id);

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
        $data =
        [
            'nis' => $this->request->getPost('nis'),
            'name' => $this->request->getPost('name'),
            'phonenumber' => $this->request->getPost('phonenumber'),
            'gender' => $this->request->getPost('gender'),
            'kelas' => $this->request->getPost('kelas'),
        ];
        $model->update($id, $data);

        return redirect()->to('/atursiswa');
    }

    public function confirmdelete($id)
    {
        $model = new SiswaModel();
        $data['siswa'] = $model->find($id);

        $data = [
            'menu' => 'Perencanaan',
            'title' => 'Atur Siswa',
            'siswa' => $model->find($id),
            'on' => true,
        ];

        return view('confirmdelete', $data);
    }
    public function delete($id)
    {
        $model = new SiswaModel();
        $model->delete($id);

        return redirect()->to('/atursiswa');
    }

}