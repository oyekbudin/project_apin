<?php namespace App\Controllers;

use App\Models\InfaqModel;
use App\Models\KelasModel;
use App\Models\PesanWaModel;
use App\Models\SiswaModel;
use App\Models\TagihanAktifModel;
use App\Models\TagihanModel;
use CodeIgniter\Controller;
use Ramsey\Uuid\Uuid;

class Tagihan extends Controller
{
    protected $siswaModel;
    protected $infaqModel;
    protected $tagihanModel;
    protected $tagihanAktifModel;
    protected $kelasModel;
    protected $pesanWaModel;

    public function __construct()
    {
        $this->infaqModel = new InfaqModel();
        $this->siswaModel = new SiswaModel();
        $this->tagihanModel = new TagihanModel();
        $this->tagihanAktifModel = new TagihanAktifModel();        
        $this->kelasModel = new KelasModel();
        $this->pesanWaModel = new PesanWaModel();
    }

    public function index()
    {
        helper(['form']);
        $perPage = 10;
        $page = (int) ($this->request->getGet('page') ?? 1);
        $total = $this->tagihanModel->countAll();
        $offset = ($page - 1) * $perPage;
        $keyword = $this->request->getGet('keyword');

        if ($keyword) {
            $datatagihan = $this->tagihanModel->search($keyword);
        } else {
            $datatagihan = $this->tagihanModel->getPaginated($perPage, $offset);
        }

        $data = [
            'menu' => 'Pengelolaan',
            'title' => 'Tagihan',
            'datatagihan' => $datatagihan,
            'total' => $total,
            'perpage' => $perPage,
            'currentPage' => $page,
            'totalPages' => ($total > 0) ? ceil($total / $perPage) : 1,
            'keyword' => $keyword,
            //'kelas' => $this->kelasModel->getDataKelas(),
        ];

        //print_r($datatagihan);
        return view('tagihan', $data);
    }

    /*public function save()
    {
        helper(['form']);
        $rules =
        [
            'name' => 'required|min_length[3]|max_length[40]|alpha_numeric_space',
            'kelas_id' => 'required',
            'harga' => 'required|min_length[4]|max_length[7]|numeric',
        ];
        $errors = [
            'name' => [
                'required'=>'Harus diisi',
                'min_length'=>'Minimal 3 karakter',
                'max_length'=>'Maksimal 40 karakter',
                'alpha_numeric_space'=>'Karakter yang diizinkan (A-Z) (0-9)'
            ],
            'kelas_id' => [
                'required'=>'Pilih minimal 1 kelas'
            ],
            'harga' => [
                'required'=>'Harus diisi',
                'min_length'=>'Minimal 4 digit angka',
                'max_length'=>'Maksimal 7 digit angka',
                'numeric'=>'Harus berupa angka (0-9)'
            ],
        ];

        if($this->validate($rules, $errors))
        {
            $dataInfaq =
            [
                'name' => $this->request->getVar('name'),
                //'kelas' => $this->request->getVar('kelas'),
                'harga' => $this->request->getVar('harga'),
            ];
            $kelasId = $this->request->getVar('kelas_id');
            $this->infaqModel->saveInfaq($dataInfaq, $kelasId);
            return redirect()->to('/aturinfaq')->with('success', 'Data infaq berhasil ditambahkan.');
        } else {
            session()->setFlashdata('errors', $this->validator->getErrors());
            session()->setFlashdata('show_modal',true);
            return redirect()->back()->withInput();
        }
    }

    public function edit($id)
    {
        $kelasModel = new KelasModel();

        
        $data = [
            'menu' => 'Perencanaan',
            'title' => 'Atur Jenis Infaq',
            //'infaq' => $this->infaqModel->find($id),
            'infaq' => $this->infaqModel->getInfaqById($id),
            'kelas' => $this->kelasModel->getDataKelas(),
            'on' => true,
        ];
        //$infaq = $this->infaqModel->getInfaqById($id);
        //$infaq2 = $this->infaqModel->find($id);
        //$kelas = $this->kelasModel->getDataKelas();
        //print_r($kelas);
        //print_r($infaq2);
        return view('editinfaq', $data);
    }

    public function update($id)
    {       
        $rules =
        [
            'name' => 'required|min_length[3]|max_length[40]|alpha_numeric_space',
            //'kelas_id' => 'required',
            'harga' => 'required|min_length[4]|max_length[7]|numeric',
        ];
        $errors = [
            'name' => [
                'required'=>'Harus diisi',
                'min_length'=>'Minimal 3 karakter',
                'max_length'=>'Maksimal 40 karakter',
                'alpha_numeric_space'=>'Karakter yang diizinkan (A-Z) (0-9)'
            ],
            //'kelas_id' => [
            //    'required'=>'Pilih minimal 1 kelas'
            //],
            'harga' => [
                'required'=>'Harus diisi',
                'min_length'=>'Minimal 4 digit angka',
                'max_length'=>'Maksimal 7 digit angka',
                'numeric'=>'Harus berupa angka (0-9)'
            ],
        ];

        if ($this->validate($rules, $errors))
        {
            $dataInfaq =
            [
                'name' => $this->request->getVar('name'),
                //'kelas' => $this->request->getVar('kelas'),
                'harga' => $this->request->getVar('harga'),
            ];
            $kelasId = $this->request->getVar('kelas_id');
            //$this->infaqModel->update($id, $data);
            $this->infaqModel->updateInfaq($id, $dataInfaq, $kelasId);
            return redirect()->to('/aturinfaq')->with('success', 'Data infaq berhasil diperbarui');
        } else {
            session()->setFlashdata('errors', $this->validator->getErrors());
            session()->setFlashdata('show_modal',true);
            return redirect()->back()->withInput();
        }
    }

    public function delete($id)
    {
        $this->infaqModel->delete($id);

        return redirect()->to('/aturinfaq')->with('success', 'Data infaq berhasil dihapus.');
    }*/

    public function detail($id)
    {
        $data = [
            'menu' => 'Pengelolaan',
            'title' => 'Detail Tagihan',
            'tagihan' => $this->tagihanModel->getTagihanById($id),
            'on' => true,
        ];

        //print_r ($data['tagihan']);
        return view('detailtagihan', $data);
    }
    
    public function request($id)
    {
        $datatagihan = $this->tagihanModel->getTagihanByRequest($id);
        $tagihan_aktif = $this->tagihanAktifModel->orderBy('id','desc')->first();
        if ($tagihan_aktif) {
            $aktif = $tagihan_aktif['id_tagihan'];
        } else {
            $aktif = '';
        }

        $penerima = $this->siswaModel->findAll();
        
        $data = [
            'menu' => 'Pengelolaan',
            'title' => 'Tagihan',
            'datatagihan' => $datatagihan,
            'tagihan_aktif' => $aktif,
            'penerima' => $penerima,
        ];
        //echo '<pre>';
        //print_r($datatagihan);
        //echo '</pre>';
        return view('tagihan',$data);
    }

    public function requestdetail()
    {
        $id = $this->request->getVar('id');
        $request = $this->request->getVar('request');
        $data = [
            'menu' => 'Pengelolaan',
            'title' => 'Detail Tagihan',
            'tagihan' => $this->tagihanModel->getTagihanByRequestById($id, $request),
            'on' => true,
        ];

        //print_r ($data['tagihan']);
        return view('detailtagihan', $data);
    }

    public function aktif($id)
    {
            $data =
            [
                'id' => Uuid::uuid4()->toString(),
                'id_tagihan' => $id,
            ];
            
            $this->tagihanAktifModel->aktif($data);
            return redirect()->back()->with('success', 'Tagihan berhasil diaktifkan.');
    }
    public function kirim_tagihan()
    {
        $rules = [
            'siswa_id' => 'required',
            'header' => 'required|min_length[4]|max_length[100]',
            'footer' => 'required|min_length[4]|max_length[100]',
        ];
        $errors = [
            'siswa_id' => [
                'required'=>'Pilih minimal 1 siswa',
            ],
            'header' => [
                'required'=>'Harus diisi',
                'min_length'=>'Setidaknya 4 karakter',
                'max_length'=>'Maksimal 100 karakter'
            ],
            'footer' => [
                'required'=>'Harus diisi',
                'min_length'=>'Setidaknya 4 karakter',
                'max_length'=>'Maksimal 100 karakter'
            ],
            
        ];

        if ($this->validate($rules, $errors))
        {
            
            $siswa_id = $this->request->getPost('siswa_id');
            $header = $this->request->getPost('header');
            $footer = $this->request->getPost('footer');

            $tagihan_aktif = $this->tagihanAktifModel->orderBy('id','desc')->first();
            if ($tagihan_aktif) {
                $request = $tagihan_aktif['id_tagihan'];
            } else {
                $request = '';
            }        

            foreach ($siswa_id as $id) {
                $siswa = $this->siswaModel->findSiswa($id);
                $nis = $siswa['nis'];
                $tagihan = $this->tagihanModel->getTagihanByRequestById($nis, $request);
                $nomor = preg_replace('/^0/', '62', $siswa['phonenumber']);

                $body = '';
                $total_tagihan = 0;             
                
                foreach($tagihan as $t) {
                    $body .= $t['nama_infaq'] . ' --- Rp' . number_format($t['sisa_tagihan'], 0, ',', '.') . "\n";
                    $total_tagihan += $t['sisa_tagihan'];                
                }
                $body .= '----------' . "\n" . 'Jumlah --- Rp' . number_format($total_tagihan, 0, ',', '.') . "\n";

                $pesan = 'Yth. ' . $siswa['name'] . ",\n\n" . $header . "\n\n" .  $body . "\n" . $footer;

                //Api SaungWA
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://app.saungwa.com/api/create-message',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => array(
                        'appkey' => 'bbac7c30-2cfd-45b7-a1da-216717dff430',
                        'authkey' => 'vu9aMiZvSaC5kblVBQtq3eE9q2XuxJaO1nUsROVrHHJYg5U5ru',
                        'to' => $nomor,
                        'message' => $pesan,
                        'sandbox' => 'false'
                    ),
                ));
                $response = curl_exec($curl);
                curl_close($curl);
                
                $this->pesanWaModel->insert([
                    'nomor_penerima' => $nomor,
                    'nama_penerima' => $siswa['name'],
                    'pesan' => $pesan,
                    'status' => 'Terkirim',
                    'response_json' => $response,
                ]);
            }

            return redirect()->back()->with('success', 'Pesan berhasil dikirim');
        } else {
            session()->setFlashdata('errors', $this->validator->getErrors());
            session()->setFlashdata('show_modal',true);
            return redirect()->back()->withInput();
        }        
    }
        
        
    

    public function riwayat_pengiriman()
    {
        //$id = $this->request->getVar('id');
        //$request = $this->request->getVar('request');
        $data = [
            'menu' => 'Pengelolaan',
            'title' => 'Riwayat Pengiriman',
            'pesanwa' => $this->pesanWaModel->findAll(),
        ];

        return view('riwayat_pengiriman', $data);
    }
    public function detail_pengiriman($id)
    {
        $data = [
            'menu' => 'Pengelolaan',
            'title' => 'Riwayat Pengiriman',
            'pesanwa' => $this->pesanWaModel->find($id),
            'on' => true,
        ];

        return view('detail_pengiriman', $data);
    }
    public function delete_pengiriman($id)
    {
        $this->pesanWaModel->delete($id);       

        return redirect()->to('riwayat_pembayaran');
    }
}