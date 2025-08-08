<?php namespace App\Models;

use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class SiswaModel extends Model
{
    protected $table = 'siswa';
    protected $primaryKey = 'nis';
    protected $allowedFields = ['nis', 'name', 'phonenumber', 'gender', 'kelas'];
    protected $useAutoIncrement = false;


    public function getTotalSiswa()
    {
        return $this->countAll(); // Hitung total semua siswa
    }

    public function getPaginatedSiswa($limit, $offset)
    {
        return $this->orderBy('kelas', 'ASC')
                    ->orderBy('name', 'ASC')
                    ->limit($limit, $offset)
                    ->find();
    }

    public function search($keyword)
    {
        return $this->table('siswa')
                    ->like('LOWER(name)', strtolower($keyword))
                    ->findAll();        
    }

    public function getTagihan($id)
    {
        return $this->select()->findAll();
    }

    public function saveSiswa($data)
    {
        $db = db_connect();
        //$db->query("SELECT setval('users_id_seq', coalesce(max(id), 0) + 1, false) FROM users");
        //$db->query("SELECT setval('tagihan_id_seq', coalesce(max(id), 0) + 1, false) FROM tagihan");
        $datasiswa = [
            'id' => $data['id'],
            'nis' => $data['nis'],
            'name' => $data['name'],
            'phonenumber' => $data['phonenumber'],
            'gender' => $data['gender'],
            'kelas' => $data['kelas'],
        ];

        $this->insert($datasiswa);
        $siswaId = $data['nis'];
        $kelas = $data['kelas'];

        $infaqKelasModel = new InfaqKelasModel();
        //$siswaModel = new SiswaModel();
        $tagihanModel = new TagihanModel();               
        
        $db = db_connect();
        $db->transStart();

        
        try {
            
            /*foreach ($kelasId as $kelas) {
                $dataInfaqKelas = [
                    'id_infaq' => $infaqId,
                    'id_kelas' => $kelas
                ];
                $infaqKelasModel->insert($dataInfaqKelas);*/
            $infaqId = $infaqKelasModel->where('id_kelas', $kelas)->findAll();
            if (!empty($infaqId)) {                
                foreach ($infaqId as $i) {
                    $dataTagihan = [
                        'id' => Uuid::uuid4()->toString(),
                        'id_siswa' => $siswaId,
                        'id_infaq' => $i['id_infaq'],
                    ];                        
                    $tagihanModel->insert($dataTagihan);
                };
            };

            $db->transComplete();
            return true;
        } catch (\Exception $e){
            $db->transRollback();
            return false;
        }
    }

    public function getSiswaByKelas($kelas)
    {
        return $this->where('kelas', $kelas)->findAll();
    }

    public function findSiswa($id)
    {
        return $this->where('nis', $id)->first();
        //return $this->find($id);
    }
    public function findSiswaByNis($id_siswa)
    {
        return $this->where('nis', $id_siswa)->first();
        //return $this->find($id);
    }

    public function updateSiswa($id, $data)
    {
        $this->update($id, $data);
    }
}
