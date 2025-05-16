<?php namespace App\Controllers;

      use App\Models\InfaqModel;
      use App\Models\SiswaModel;
      use CodeIgniter\Controller;

class DashboardWalimurid extends Controller
{
    
    public function index()
    {
        $session = session();

        $siswaModel = new SiswaModel();
        $infaqModel = new InfaqModel();

        $data = [
            'menu' => 'Dashboard',
            'title' => 'Dashboard',
            'totalsiswa' => $siswaModel->getTotalSiswa(),
            'totalinfaq' => $infaqModel->getTotalInfaq(),
        ];
        //echo "Selamat datang. ".$session->get('name')." Sebagai :".$session->get('role');
        echo view('rekapdata', $data);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('loginadministrator');
    }
}