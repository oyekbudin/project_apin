<?php namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
    protected $table = 'siswa';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nis', 'name', 'phonenumber', 'gender', 'kelas'];

    public function getTotalSiswa()
    {
        return $this->countAll(); // Hitung total semua siswa
    }

    public function getPaginatedSiswa($limit, $offset)
    {
        return $this->orderBy('id', 'ASC')
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
        $this->insert($data);
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
}
