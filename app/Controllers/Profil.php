<?php namespace App\Controllers;

      use App\Models\AdministratorModel;
use App\Models\RekeningModel;
use CodeIgniter\Controller;

class Profil extends Controller
{
    protected $administratorModel;

    public function __construct()
    {
        $this->administratorModel = new AdministratorModel;
    }

    /*public function index()
    {
        $session = session();
        $id = $session->get('idadmin');
        $dataprofil = $this->administratorModel->find($id);
        $data = [
            'menu' => 'Profil',
            'title' => 'Profil',
            'dataprofil' => $dataprofil,
        ];

        //echo '<pre>';
        //print_r($data['datarekening']);
        //echo '</pre>';
        return view('profil', $data);
    } */

    /*public function save()
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
            $this->rekeningModel->save($data);
            return redirect()->to('/registeradministrator')->with('success', 'Data User berhasil ditambahkan.');;
        } else {
            session()->setFlashdata('errors', $this->validator->getErrors());
            session()->setFlashdata('show_modal',true);
            return redirect()->back()->withInput();
        }
    } */

    public function edit($id): string
    {
        $data = [
            'menu' => 'Profil',
            'title' => 'Profil',
            'user' => $this->administratorModel->find($id),
            //'on' => true,
        ];
        return view('profil', $data);
    }

    public function update($id)
    {
        
        $rules =
        [
            'name' => 'required|min_length[6]|max_length[40]|alpha_space',
            'adminname' => 'required|min_length[6]|max_length[40]',
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
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
            ];
            $this->administratorModel->update($id, $data);
            return redirect()->to('/profil/edit/'.$id)->with('on','false')->with('success', 'Data profil berhasil diperbarui');

            //return redirect()->back()->with('success', 'Data User berhasil diperbarui');
        } else {
            session()->setFlashdata('errors', $this->validator->getErrors());
            session()->setFlashdata('show_modal',true);
            return redirect()->back()->withInput();
        }
    }
}