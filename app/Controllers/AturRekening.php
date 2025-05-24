<?php namespace App\Controllers;

      use App\Models\AdministratorModel;
use App\Models\RekeningModel;
use CodeIgniter\Controller;
use CodeIgniter\Encryption\Encryption;

class AturRekening extends Controller
{
    protected $rekeningModel;

    public function __construct()
    {
        $this->rekeningModel = new RekeningModel;
    }

    public function index()
    {
        $datarek = $this->rekeningModel->first();
        $encrypter = \Config\Services::encrypter();
/*
        $datarekening = [
            'nama_sekolah' => $datarek['nama_sekolah'],
            'nama_pemilik_rekening' => $encrypter->decrypt($datarek['nama_pemilik_rekening']),
            'nama_bank' => $encrypter->decrypt($datarek['nama_bank']),
            'nomor_rekening' => $encrypter->decrypt($datarek['nomor_rekening']),
            'nama_kepsek' => $encrypter->decrypt($datarek['nama_kepsek']),
            'nim_kepsek' => $encrypter->decrypt($datarek['nim_kepsek']),
            'nama_bendahara' => $encrypter->decrypt($datarek['nama_bendahara']),
            'phonenumber' => $encrypter->decrypt($datarek['phonenumber']),
        ];
*/
        $datarekening = [
            'id' => $datarek['id'],
            'nama_sekolah'           => $datarek['nama_sekolah'],
            'nama_pemilik_rekening'  => !empty($datarek['nama_pemilik_rekening']) ? $encrypter->decrypt(base64_decode($datarek['nama_pemilik_rekening'])) : null,
            'nama_bank'              => !empty($datarek['nama_bank']) ? $encrypter->decrypt(base64_decode($datarek['nama_bank'])) : null,
            'nomor_rekening'         => !empty($datarek['nomor_rekening']) ? $encrypter->decrypt(base64_decode($datarek['nomor_rekening'])) : null,
            'nama_kepsek'            => !empty($datarek['nama_kepsek']) ? $encrypter->decrypt(base64_decode($datarek['nama_kepsek'])) : null,
            'nim_kepsek'             => !empty($datarek['nim_kepsek']) ? $encrypter->decrypt(base64_decode($datarek['nim_kepsek'])) : null,
            'nama_bendahara'         => !empty($datarek['nama_bendahara']) ? $encrypter->decrypt(base64_decode($datarek['nama_bendahara'])) : null,
            'phonenumber'            => !empty($datarek['phonenumber']) ? $encrypter->decrypt(base64_decode($datarek['phonenumber'])) : null,
        ];

        $data = [
            'menu' => 'Pengaturan',
            'title' => 'Atur Rekening',
            'rekening' => $datarekening,
            //'encrypter' => \Config\Services::encrypter(),
        ];

        //echo '<pre>';
        //print_r($data['datarekening']);
        //echo '</pre>';
        return view('aturrekening', $data);
    }

    public function edit($id)
    {
        $encrypter = \Config\Services::encrypter();
        $datarek = $this->rekeningModel->find($id);
        $datarekening = [
            'id' => $datarek['id'],
            'nama_sekolah'           => $datarek['nama_sekolah'],
            'nama_pemilik_rekening'  => !empty($datarek['nama_pemilik_rekening']) ? $encrypter->decrypt(base64_decode($datarek['nama_pemilik_rekening'])) : null,
            'nama_bank'              => !empty($datarek['nama_bank']) ? $encrypter->decrypt(base64_decode($datarek['nama_bank'])) : null,
            'nomor_rekening'         => !empty($datarek['nomor_rekening']) ? $encrypter->decrypt(base64_decode($datarek['nomor_rekening'])) : null,
            'nama_kepsek'            => !empty($datarek['nama_kepsek']) ? $encrypter->decrypt(base64_decode($datarek['nama_kepsek'])) : null,
            'nim_kepsek'             => !empty($datarek['nim_kepsek']) ? $encrypter->decrypt(base64_decode($datarek['nim_kepsek'])) : null,
            'nama_bendahara'         => !empty($datarek['nama_bendahara']) ? $encrypter->decrypt(base64_decode($datarek['nama_bendahara'])) : null,
            'phonenumber'            => !empty($datarek['phonenumber']) ? $encrypter->decrypt(base64_decode($datarek['phonenumber'])) : null,
        ];
        $data = [
            'menu' => 'Pengaturan',
            'title' => 'Atur Rekening',
            'rekening' => $datarekening,
            'on' => true,
        ];
        return view('editrekening', $data);
    }

    public function update($id)
    {
        $encrypter = \Config\Services::encrypter();


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
                'nama_pemilik_rekening' => base64_encode($encrypter->encrypt($this->request->getVar('nama_pemilik_rekening'))),
                'nama_bank' => base64_encode($encrypter->encrypt($this->request->getVar('nama_bank'))),
                'nomor_rekening' => base64_encode($encrypter->encrypt($this->request->getVar('nomor_rekening'))),
                'nama_kepsek' => base64_encode($encrypter->encrypt($this->request->getVar('nama_kepsek'))),
                'nim_kepsek' => base64_encode($encrypter->encrypt($this->request->getVar('nim_kepsek'))),
                'nama_bendahara' => base64_encode($encrypter->encrypt($this->request->getVar('nama_bendahara'))),
                'phonenumber' => base64_encode($encrypter->encrypt($this->request->getVar('phonenumber'))),
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