<?php namespace App\Controllers;

      use App\Models\AdministratorModel;
      use CodeIgniter\Controller;

class RegisterAdministrator extends Controller
{
    public function index()
    {
        //helper(['form']);
        $Model = new AdministratorModel();
        $perPage = 10;
        $page = (int) ($this->request->getGet('page') ?? 1);
        $total = $Model->countAll();


        $offset = ($page - 1) * $perPage;



        $keyword = $this->request->getGet('keyword');

        if ($keyword) {
            $dataadministrator = $Model->search($keyword);
        } else {
            $dataadministrator = $Model->getPaginated($perPage, $offset);
        }
        //$data = [];
        //echo view('registeradministrator', $data);

        //$lihatmodel = new AdministratorModel();
        //$lihatdata = $lihatmodel->findAll();
        //$data['lihatdata'] = $lihatdata;
        //$data['title'] = 'Atur User';

        $data = [
            'menu' => 'Pengaturan',
            'title' => 'Atur User',
            //'lihatdata' => $lihatdata,
            'dataadministrator' => $dataadministrator,
            'total' => $total,
            'perpage' => $perPage,
            'currentPage' => $page,
            'totalPages' => ($total > 0) ? ceil($total / $perPage) : 1,
            'keyword' => $keyword,
        ];

        //echo view('atursiswa', $data);
        return view('registeradministrator', $data);
    }

    public function save()
    {
        helper(['form']);
        $rules =
        [
            'name' => 'required|min_length[6]|max_length[40]',
            'adminname' => 'required|min_length[6]|max_length[40]',
            'role' => 'required|min_length[6]|max_length[40]',
            'password' => 'required|min_length[6]|',
        ];

        if($this->validate($rules))
        {
            $model = new AdministratorModel();
            $data =
            [
                'name' => $this->request->getVar('name'),
                'adminname' => $this->request->getVar('adminname'),
                'role' => $this->request->getVar('role'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
            ];
            $model->save($data);
            return redirect()->to('/registeradministrator')->with('success', 'Data User berhasil ditambahkan.');;
        } else {
            session()->setFlashdata('errors', $this->validator->getErrors());
            //$data['validation'] = $this->validator;
            //echo view('registeradministrator', $data);
            return redirect()->to('/registeradministrator');
        }
    }

    public function edit($id)
    {
        $model = new AdministratorModel();
        //$data['user'] = $model->find($id);
        $data = [
            'menu' => 'Pengaturan',
            'title' => 'Atur User',
            'user' => $model->find($id),
            'on' => true,
        ];
        return view('editadministrator', $data);
    }

    public function update($id)
    {
        $model = new AdministratorModel();
        $data =
        [
            'name' => $this->request->getVar('name'),
            'adminname' => $this->request->getVar('adminname'),
            'role' => $this->request->getVar('role'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
        ];
        $model->update($id, $data);

        return redirect()->to('/registeradministrator')->with('success', 'Data user berhasil diperbarui.');
    }

    public function delete($id)
    {
        $model = new AdministratorModel();
        $model->delete($id);

        return redirect()->to('/registeradministrator')->with('success', 'Data user berhasil dihapus.');
    }

    public function confirmdelete($id)
    {
        $model = new AdministratorModel();
        //$data['administrator'] = $model->find($id);

        $data = [
            'menu' => 'Pengaturan',
            'title' => 'Atur User',
            'user' => $model->find($id),
            'on' => true,
        ];

        return view('confirmdeleteadministrator', $data);
    }
}