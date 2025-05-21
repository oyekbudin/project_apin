<?php namespace App\Controllers;

      use App\Models\InfaqModel;
use App\Models\LogErrorModel;
use App\Models\NotificationModel;
use App\Models\PembayaranModel;
      use App\Models\SiswaModel;
      use App\Models\TagihanModel;
      use CodeIgniter\Controller;

class Pembayaran extends Controller
{
    protected $pembayaranModel;
    protected $siswaModel;
    protected $infaqModel;
    protected $tagihanModel;
    protected $notificationModel;
    protected $logErrorModel;

    public function __construct()
    {
        $this->pembayaranModel = new PembayaranModel();
        $this->siswaModel = new SiswaModel();
        $this->infaqModel = new InfaqModel();
        $this->tagihanModel = new TagihanModel();
        $this->notificationModel = new NotificationModel();
        $this->logErrorModel = new LogErrorModel();
    }

    public function index()
    {
        helper(['form']);

        //$pembayaranModel = new PembayaranModel();
        $pembayaran = $this->pembayaranModel->getPembayaran();
        //$data['pembayaran'] = $pembayaran;
        //$data['title'] = 'Input Pembayaran';

        $data = [
            'menu' => 'Pengelolaan',
            'title' => 'Input Pembayaran',
            'pembayaran' => $pembayaran,
        ];

        //echo '<pre>';
        //print_r($pembayaran);
        //echo '</pre>';

        echo view('pembayaran', $data);
    }

    public function save()
    {
        helper(['form']);
        /*$rules =
        [
            'id_siswa' => 'required',
            'id_infaq' => 'required',
            'nominal' => 'required|min_length[4]|max_length[7]|numeric',
        ];
        $errors = [
            'idsiswa' => [
                'required'=>'Harus diisi'
            ],
            'idinfaq' => [
                'required'=>'Harus diisi'
            ],
            'nominal' => [
                'required'=>'Harus diisi',
                'min_length'=>'Minimal 4 digit angka',
                'max_length'=>'Maksimal 7 digit angka',
                'numeric'=>'Harus berupa angka (0-9)'
            ],
        ]; 

        if($this->validate($rules, $errors))
        { 
            $data =
            [
                'id_siswa' => $this->request->getVar('id_siswa'),
                'id_infaq' => $this->request->getVar('id_infaq'),
                'nominal' => $this->request->getVar('nominal'),
            ];
            */
            $id_siswa = $this->request->getVar('id_siswa');   //1
            $id_infaq = $this->request->getVar('id_infaq');   //2
            $nominal = $this->request->getVar('nominal');     //3
            $date = date('md');
            $order_id = $date . $id_siswa . uniqid(); //4
            $status = 'success';                                       //5
            $payment_method = 'manual';                                //6
            //$this->pembayaranModel->save($data);
            $this->pembayaranModel->savePembayaran($order_id, $id_siswa, $id_infaq, $nominal, $status, $payment_method);
            //print_r($order_id);
            return redirect()->to('/pembayaran')->with('success', 'Data pembayaran berhasil ditambahkan.');
            /*
        } else {
            session()->setFlashdata('errors', $this->validator->getErrors());
            session()->setFlashdata('show_modal',true);
            return redirect()->back()->withInput();
        }*/
    }

    public function searchSiswa()
    {
        //$Model = new SiswaModel();
        //$Model = new InfaqModel();
        $keyword = $this->request->getGet('keyword');
        //$result = $Model->like('name', $keyword)
                        //->orLike('nis', $keyword)
                        //->findAll(10);
        $result = $this->siswaModel->search($keyword);
        return $this->response->setJSON($result);
    }

    public function getInfaqByKelas()
    {
        //$Model = new InfaqModel();
        $keyword = $this->request->getGet('kelas');
        //$result = $Model->find($keyword);
        $result = $this->infaqModel->searchByKelas($keyword);
        //$result = $Model->like('kelas',$kelas)->findAll();
        return $this->response->setJSON($result);
    }

    public function getTagihanForPembayaran()
    {
        $id = $this->request->getGet('nis');
        $result = $this->tagihanModel->getTagihanById($id);
        return $this->response->setJSON($result);
    }

    public function delete($id)
    {
        //$model = new PembayaranModel();
        $this->pembayaranModel->delete($id);

        return redirect()->to('/pembayaran')->with('success', 'Data Pembayaran berhasil dihapus.');
    }

    public function deleteall($order_id)
    {
        $id_pembayaran = $this->pembayaranModel->where('order_id',$order_id)->findColumn('id');
        $this->pembayaranModel->delete($id_pembayaran);
        return redirect()->to('/pembayaran')->with('success', 'Data Pembayaran berhasil dihapus.');
    }

    public function detailPembayaran($id)
    {
        //$Model = new PembayaranModel();
        //$data['administrator'] = $model->find($id);
        //$pembayaran = $this->pembayaranModel->getPembayaranDelete($id);
        $pembayaran = $this->pembayaranModel->getPembayaranDetail($id);

        $data = [
            'menu' => 'Pengelolaan',
            'title' => 'Input Pembayaran',
            'pembayaran' => $pembayaran,
            'on' => true,
        ];
        //echo '<pre>';
        //print_r($pembayaran);
        //echo '</pre>';

        return view('detailpembayaran', $data);
    }

    public function notifikasi()
    {
        $data = [
            'menu' => 'Pengelolaan',
            'title' => 'Notifikasi',
            'notifikasi' => $this->notificationModel->getNotification(),
        ];

        //echo '<pre>';
        //print_r($data);
        //echo '</pre>';
        return view('notifikasi', $data);
    }

    public function log_error()
    {
        $data = [
            'menu' => 'Pengelolaan',
            'title' => 'Log Error Pembayaran',
            'error' => $this->logErrorModel->findAll(),
        ];

        //echo '<pre>';
        //print_r($data);
        //echo '</pre>';
        return view('log_error_pembayaran', $data);
    }
    
}