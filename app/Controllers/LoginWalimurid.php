<?php namespace App\Controllers;

      use App\Models\AdministratorModel;
use App\Models\SiswaModel;
use CodeIgniter\Controller;

class LoginWalimurid extends Controller
{
    protected $siswaModel;

    public function __construct()
    {
        $this->siswaModel = new SiswaModel();
    }
    public function index()
    {
        helper(['form']);
        $data['title'] = 'Login Wali Murid';
        echo view('loginwalimurid', $data);
    }

    public function auth()
    {
        $session = session();
        //$model = new AdministratorModel();
        $nis = $this->request->getVar('nis');
        $phonenumber = $this->request->getVar('phonenumber');
        $data = $this->siswaModel->where('nis', $nis)->first();
        if($data)
        {
            $pass = $data['phonenumber'];
            //$verify_pass = $pass;
            if($phonenumber === $pass)
            {
                $ses_data =
                [
                    'id' => $data['id'],
                    'nis' =>$data['nis'],
                    'name' => $data['name'],
                    'phonenumber' => $data['phonenumber'],
                    'gender' => $data['gender'],                    
                    'kelas' => $data['kelas'],
                    'loginstatus' => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/dashboard-walimurid');
            }else{
                $session->setFlashdata('msg', 'Nomor Whatsapp Salah/Belum didaftarkan');
                return redirect()->back();
            }
        }else{
            $session->setFlashdata('msg', 'NIS tidak ditemukan');
            return redirect()->back();
        }
    }

    
}