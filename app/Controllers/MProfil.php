<?php namespace App\Controllers;

      use App\Models\InfaqModel;
      use App\Models\SiswaModel;
      use CodeIgniter\Controller;

class MProfil extends Controller
{
    protected $siswaModel;

    public function __construct()
    {
        $this->siswaModel = new SiswaModel();
    }
    
    /*public function index()
    {
        $session = session();

        $siswaModel = new SiswaModel();
        $infaqModel = new InfaqModel();

        $data = [
            'menu' => 'Profil',
            'title' => 'Profil',
            'totalsiswa' => $siswaModel->getTotalSiswa(),
            'totalinfaq' => $infaqModel->getTotalInfaq(),
        ];
        //echo "Selamat datang. ".$session->get('name')." Sebagai :".$session->get('role');
        echo view('m-profil', $data);
    }*/

    public function edit($id)
    {
        $data = [
            'menu' => 'Profil',
            'title' => 'Profil',
            'user' => $this->siswaModel->find($id),
            //'on' => true,
        ];
        //print_r($data);
        //print_r($id);
        return view('m-profil', $data);
    }

    public function update($id)
    {
        
        $rules =
        [
            'phonenumber' => 'required|min_length[10]|max_length[15]|numeric',
        ];
        $errors = [
            'phonenumber' => [
                'required'=>'Harus diisi',
                'min_length'=>'Minimal 10 karakter',
                'max_length'=>'Maksimal 15 karakter',
                'numeric'=>'Harus berupa angka (0-9)'],
        ];

        if($this->validate($rules, $errors))
        {
            $data =
            [
                'phonenumber' => $this->request->getVar('phonenumber'),
            ];
            $this->siswaModel->update($id, $data);
            return redirect()->to('/m-profil/edit/'.$id)->with('on','false')->with('success', 'Nomor Whatsapp berhasil diperbarui');

            //return redirect()->back()->with('success', 'Data User berhasil diperbarui');
        } else {
            session()->setFlashdata('errors', $this->validator->getErrors());
            session()->setFlashdata('show_modal',true);
            return redirect()->back()->withInput();
        }
    }

    public function help()
    {
        $data = [
            'menu' => 'Profil',
            'title' => 'Pusat Bantuan',
            //'user' => $this->siswaModel->find($id),
            //'on' => true,
        ];
        return view('m-help', $data);
    }

}