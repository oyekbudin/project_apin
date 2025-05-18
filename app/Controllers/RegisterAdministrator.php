<?php namespace App\Controllers;

      use App\Models\AdministratorModel;
      use CodeIgniter\Controller;

class RegisterAdministrator extends Controller
{
    protected $administratorModel;

    public function __construct()
    {
        $this->administratorModel = new AdministratorModel();
    }

    public function index()
    {
        $perPage = 10;
        $page = (int) ($this->request->getGet('page') ?? 1);
        $total = $this->administratorModel->countAll();
        $offset = ($page - 1) * $perPage;
        $keyword = $this->request->getGet('keyword');

        if ($keyword) {
            $dataadministrator = $this->administratorModel->search($keyword);
        } else {
            $dataadministrator = $this->administratorModel->getPaginated($perPage, $offset);
        }

        $data = [
            'menu' => 'Pengaturan',
            'title' => 'Atur User',
            'dataadministrator' => $dataadministrator,
            'total' => $total,
            'perpage' => $perPage,
            'currentPage' => $page,
            'totalPages' => ($total > 0) ? ceil($total / $perPage) : 1,
            'keyword' => $keyword,
        ];

        return view('registeradministrator', $data);
    }

    public function save()
    {
        helper(['form']);
        $rules =
        [
            'name' => 'required|min_length[6]|max_length[40]|alpha_space',
            'adminname' => 'required|min_length[6]|max_length[40]',
            'role' => 'required|min_length[6]|max_length[40]',
            'password' => 'required|min_length[6]|max_length[40]',
        ];
        $errors = [
            'name' => [
                'required'=>'Harus diisi',
                'min_length'=>'Minimal 6 karakter',
                'max_length'=>'Maksimal 40 karakter',
                'alpha_space'=>'Tidak boleh mengandung angka (0-9)'],
            'adminname' => [
                'required'=>'Harus diisi',
                'min_length'=>'Minimal 6 karakter',
                'max_length'=>'Maksimal 40 karakter'],
            'password' => [
                'required'=>'Harus diisi',
                'min_length'=>'Minimal 6 karakter',
                'max_length'=>'Maksimal 40 karakter'],
        ];

        if($this->validate($rules, $errors))
        {
            $data =
            [
                'name' => $this->request->getVar('name'),
                'adminname' => $this->request->getVar('adminname'),
                'role' => $this->request->getVar('role'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
            ];
            //$this->administratorModel->save($data);
            $this->administratorModel->saveAdministrator($data);
            return redirect()->to('/registeradministrator')->with('success', 'Data User berhasil ditambahkan.');;
        } else {
            session()->setFlashdata('errors', $this->validator->getErrors());
            session()->setFlashdata('show_modal',true);
            return redirect()->back()->withInput();
        }
    }

    public function edit($id)
    {

        $data = [
            'menu' => 'Pengaturan',
            'title' => 'Atur User',
            'user' => $this->administratorModel->find($id),
            'on' => true,
        ];
        return view('editadministrator', $data);
    }

    public function update($id)
    {
        
        $rules =
        [
            'name' => 'required|min_length[6]|max_length[40]|alpha_space',
            'adminname' => 'required|min_length[6]|max_length[40]',
            'role' => 'required|min_length[6]|max_length[40]',
            'password' => 'permit_empty|min_length[6]|max_length[40]',
        ];
        $errors = [
            'name' => [
                'required'=>'Harus diisi',
                'min_length'=>'Minimal 6 karakter',
                'max_length'=>'Maksimal 40 karakter',
                'alpha_space'=>'Tidak boleh mengandung angka (0-9)'],
            'adminname' => [
                'required'=>'Harus diisi',
                'min_length'=>'Minimal 6 karakter',
                'max_length'=>'Maksimal 40 karakter'],
            'password' => [
                'min_length'=>'Minimal 6 karakter',
                'max_length'=>'Maksimal 40 karakter'],
        ];

        if($this->validate($rules, $errors))
        {
            $data =
            [
                'name' => $this->request->getVar('name'),
                'adminname' => $this->request->getVar('adminname'),
                'role' => $this->request->getVar('role'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
            ];
            $this->administratorModel->update($id, $data);
            return redirect()->to('/registeradministrator')->with('success', 'Data User berhasil diperbarui');
            //return redirect()->back()->with('success', 'Data User berhasil diperbarui');
        } else {
            session()->setFlashdata('errors', $this->validator->getErrors());
            session()->setFlashdata('show_modal',true);
            return redirect()->back()->withInput();
        }
    }

    public function delete($id)
    {
        $this->administratorModel->delete($id);

        return redirect()->to('/registeradministrator')->with('success', 'Data user berhasil dihapus.');
    }

    public function confirmdelete($id)
    {
        $data = [
            'menu' => 'Pengaturan',
            'title' => 'Atur User',
            'user' => $this->administratorModel->find($id),
            'on' => true,
        ];

        return view('confirmdeleteadministrator', $data);
    }
}