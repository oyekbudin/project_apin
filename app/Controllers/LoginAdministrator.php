<?php namespace App\Controllers;

      use App\Models\AdministratorModel;
      use CodeIgniter\Controller;

class LoginAdministrator extends Controller
{
    public function index()
    {
        helper(['form']);
        $data['title'] = 'Login Administrator';
        echo view('loginadministrator', $data);
    }

    public function auth()
    {
        $session = session();
        $model = new AdministratorModel();
        $adminname = $this->request->getVar('adminname');
        $password = $this->request->getVar('password');
        $data = $model->where('adminname', $adminname)->first();
        if($data)
        {
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);
            if($verify_pass)
            {
                $ses_data =
                [
                    'id' => $data['id'],
                    'idadmin' =>$data['idadmin'],
                    'name' => $data['name'],
                    'adminname' => $data['adminname'],
                    'role' => $data['role'],
                    'loginstatus' => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/dashboardadministrator');
            }else{
                $session->setFlashdata('msg', 'Password Salah');
                return redirect()->to('/loginadministrator');
            }
        }else{
            $session->setFlashdata('msg', 'Username tidak ditemukan');
            return redirect()->to('/loginadministrator');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
}