<?php namespace App\Models;

use CodeIgniter\Model;

class InfaqModel extends Model
{
    protected $table ='infaq';
    protected $primaryKey ='id';
    protected $allowedFields = ['name','kelas','harga'];
    //protected $infaqKelasModel;

    /*public function __construct()
    {
        $this->infaqKelasModel = new InfaqKelasModel();
    } */

    public function getTotalInfaq()
    {
        return $this->countAll();
    }

    //public function getPaginated($limit, $offset)
    //{
    //    return $this->orderBy('id', 'ASC')
    //                ->limit($limit, $offset)
    //                ->find();
    //}

    public function getPaginated($limit, $offset)
    {
        return $this->db->table('infaq')
        ->select("infaq.*, array_agg(k.nama) as kelas")
        ->join('infaq_kelas ik', 'infaq.id = ik.id_infaq')
        ->join('kelas k', 'ik.id_kelas = k.id')
        ->groupBy('infaq.id')
        ->orderBy('infaq.id', 'ASC')
        ->limit($limit, $offset)
        ->get()
        ->getResultArray();
        //foreach ($infaq as &$i)
        //{
            //var_dump($i['kelas']);
        //}
    }

    public function getInfaqById($id)
    {
        return $this->db->table('infaq')
        ->select("infaq.*, array_agg(k.id) as kelas")
        ->join('infaq_kelas ik', 'infaq.id = ik.id_infaq')
        ->join('kelas k', 'ik.id_kelas = k.id')
        ->groupBy('infaq.id')
        ->orderBy('infaq.id', 'ASC')
        //->limit($limit, $offset)
        ->get()
        ->getResultArray();
    }

    public function search($keyword)
    {
        return $this->table('infaq')
                    ->like('LOWER(name)', strtolower($keyword))
                    ->findAll();
    }

    public function searchByKelas($keyword)
    {
        return $this->table('infaq')
                    ->like('kelas',$keyword)
                    ->findAll();
    }

    public function getDataInfaq()
    {
        return $this->select()->findAll();
    }

    public function saveInfaq($dataInfaq, $kelasId)
    {
        $db = db_connect();
        $db->transStart();
        try {
            $this->insert($dataInfaq);
            $infaqId = $this->getInsertID();
            $infaqKelasModel = new InfaqKelasModel();
            foreach ($kelasId as $kelas) {
                $dataInfaqKelas = [
                    'id_infaq' => $infaqId,
                    'id_kelas' => $kelas
                ];
            $infaqKelasModel->insert($dataInfaqKelas);
            }
            $db->transComplete();
            return true;
        } catch (\Exception $e){
            $db->transRollback();
            return false;
        }
    }
    
    public function updateInfaq($id, $dataInfaq, $kelasId)
    {
        
        $db = db_connect();
        $db->transStart();
        try {           
            $this->update($id, $dataInfaq);

            $infaqKelasModel = new InfaqKelasModel();
            $infaqKelasModel->where('id_infaq', $id)->delete();
            
            $infaqId = $id;            
            foreach ($kelasId as $kelas)
            {
                $dataInfaqKelas[] = [
                    'id_infaq' => $infaqId,
                    'id_kelas' => $kelas,
                ];                
            }
            $infaqKelasModel->insertBatch($dataInfaqKelas);

            $db->transComplete();
            return true;
        } catch (\Exception $e){
            echo $e->getMessage();
            $db->transRollback();
            return false;
        }
    }  


}