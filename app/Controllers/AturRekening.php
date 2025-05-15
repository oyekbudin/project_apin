<?php namespace App\Controllers;

      use App\Models\AdministratorModel;
use App\Models\RekeningModel;
use CodeIgniter\Controller;

class AturRekening extends Controller
{
    protected $rekeningModel;

    public function __construct()
    {
        $this->rekeningModel = new RekeningModel;
    }

    public function index()
    {
        $datarekening = $this->rekeningModel->findAll();
        $data = [
            'menu' => 'Pengaturan',
            'title' => 'Atur Rekening',
            'rekening' => $datarekening,
        ];

        //echo '<pre>';
        //print_r($data['datarekening']);
        //echo '</pre>';
        return view('aturrekening', $data);
    }

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

    public function edit($id)
    {
        $data = [
            'menu' => 'Pengaturan',
            'title' => 'Atur Rekening',
            'rekening' => $this->rekeningModel->find($id),
            'on' => true,
        ];
        return view('editrekening', $data);
    }

    public function update($id)
    {
        $rules =
        [
            'nama_sekolah' => 'required|min_length[6]|max_length[50]|alpha_numeric_space',
            'nama_pemilik_rekening' => 'required|min_length[6]|max_length[50]|alpha_numeric_space',
            'nama_bank' => 'required|min_length[6]|max_length[50]|alpha_space',
            'nomor_rekening' => 'required|min_length[6]|max_length[20]|numeric',
            'nama_kepsek' => 'required|min_length[6]|max_length[50]|regex_match[/^[a-zA-Z0-9\s\.,]+$/]',
            'nim_kepsek' => 'required|min_length[6]|max_length[20]|numeric',
            'nama_bendahara' => 'required|min_length[6]|max_length[50]|regex_match[/^[a-zA-Z0-9\s\.,]+$/]',
            'phonenumber' => 'required|min_length[10]|max_length[15]|numeric',
        ];
        $errors = [
            'nama_sekolah' => [
                'required'=>'Harus diisi',
                'min_length'=>'Minimal 6 karakter',
                'max_length'=>'Maksimal 50 karakter',
                'alpha_numeric_space'=>'Tidak boleh mengandung simbol'],
            'nama_pemilik_rekening' => [
                'required'=>'Harus diisi',
                'min_length'=>'Minimal 6 karakter',
                'max_length'=>'Maksimal 50 karakter',
                'alpha_numeric_space'=>'Tidak boleh mengandung simbol'],
            'nama_bank' => [
                'required'=>'Harus diisi',
                'min_length'=>'Minimal 6 karakter',
                'max_length'=>'Maksimal 50 karakter',
                'alpha_space'=>'Tidak boleh mengandung angka (0-9)'],
            'nomor_rekening' => [
                'required'=>'Harus diisi',
                'min_length'=>'Minimal 6 karakter',
                'max_length'=>'Maksimal 20 karakter',
                'numeric' => 'Karakter yang diizinkan adalah angka (0-9)'],
            'nama_kepsek' => [
                'required'=>'Harus diisi',
                'min_length'=>'Minimal 6 karakter',
                'max_length'=>'Maksimal 50 karakter',
                'regex_match'=>'Karakter yang diizinkan adalah angka (A-Z) (0-9) (. ,)'],
            'nim_kepsek' => [
                'required'=>'Harus diisi',
                'min_length'=>'Minimal 6 karakter',
                'max_length'=>'Maksimal 20 karakter',
                'numeric' => 'Karakter yang diizinkan adalah angka (0-9)'],
            'nama_bendahara' => [
                'required'=>'Harus diisi',
                'min_length'=>'Minimal 6 karakter',
                'max_length'=>'Maksimal 50 karakter',
                'alpha_space'=>'Karakter yang diizinkan adalah angka (A-Z) (0-9) (. ,)'],
            'phonenumber' => [
                'required'=>'Harus diisi',
                'min_length'=>'Minimal 10 karakter',
                'max_length'=>'Maksimal 15 karakter',
                'numeric' => 'Karakter yang diizinkan adalah angka (0-9)'],
        ];

        if($this->validate($rules, $errors))
        {
            $data =
            [
                'nama_sekolah' => $this->request->getVar('nama_sekolah'),
                'nama_pemilik_rekening' => $this->request->getVar('nama_pemilik_rekening'),
                'nama_bank' => $this->request->getVar('nama_bank'),
                'nomor_rekening' => $this->request->getVar('nomor_rekening'),
                'nama_kepsek' => $this->request->getVar('nama_kepsek'),
                'nim_kepsek' => $this->request->getVar('nim_kepsek'),
                'nama_bendahara' => $this->request->getVar('nama_bendahara'),
                'phonenumber' => $this->request->getVar('phonenumber'),
            ];
            $this->rekeningModel->update($id, $data);
            return redirect()->to('/aturrekening')->with('success', 'Data rekening berhasil diperbarui');;
        } else {
            session()->setFlashdata('errors', $this->validator->getErrors());
            session()->setFlashdata('show_modal',true);
            return redirect()->back()->withInput();
        }
    }
}