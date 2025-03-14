<?php namespace App\Controllers;

      use App\Models\AdministratorModel;
      use CodeIgniter\Controller;

class RegisterAdministrator extends Controller
{
    public function index()
    {
        helper(['form']);
        $data = [];
        //echo view('registeradministrator', $data);

        $lihatmodel = new AdministratorModel();
        $lihatdata = $lihatmodel->findAll();
        //$data['lihatdata'] = $lihatdata;
        //$data['title'] = 'Atur User';

        $data = [
            'menu' => 'Pengaturan',
            'title' => 'Atur User',
            'lihatdata' => $lihatdata,
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
            return redirect()->to('/registeradministrator');
        } else {
            $data['validation'] = $this->validator;
            echo view('registeradministrator', $data);
        }
    }

    public function edit($id)
    {
        $model = new AdministratorModel();
        $data['user'] = $model->find($id);

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

        return redirect()->to('/registeradministrator');
    }

    public function delete($id)
    {
        $model = new AdministratorModel();
        $model->delete($id);

        return redirect()->to('/registeradministrator');
    }
}