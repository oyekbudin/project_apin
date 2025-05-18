<?php namespace App\Models;

      use CodeIgniter\Model;

class RequestTagihanModel extends Model
{
    protected $table = 'request_tagihan';
    protected $allowedFields = ['id','title','id_admin','date','status'];

    public function search($keyword)
    {
        return $this->table('request_tagihan')
                    ->like('LOWER(title)', strtolower($keyword))
                    ->findAll();
    }

    public function getPaginated($limit, $offset)
    {
        return $this->db->table('request_tagihan')
        ->select("request_tagihan.*, DATE(request_tagihan.date), administrator.name as nama_admin")
        ->join('administrator', 'request_tagihan.id_admin = administrator.idadmin')
        //->join('kelas k', 'ik.id_kelas = k.id')
        //->groupBy('infaq.id')
        ->orderBy('request_tagihan.date', 'DESC')
        ->limit($limit, $offset)
        ->get()
        ->getResultArray();
    }

    public function saveRequest($dataRequest, $infaqId)
    {
        //$infaqKelasModel = new InfaqKelasModel();
        //$siswaModel = new SiswaModel();
        //$tagihanModel = new TagihanModel();
        $tagihanInfaqModel = new TagihanInfaqModel();

        $db = db_connect();        
        $db->query("SELECT setval('request_tagihan_id_seq', coalesce(max(id), 0) + 1, false) FROM request_tagihan");
        $db->transStart();
        try {
            $this->insert($dataRequest);
            $requestId = $this->getInsertID();
            
            foreach ($infaqId as $in) {
                $dataTagihanInfaq = [
                    'id_tagihan' => $requestId,
                    'id_infaq' => $in
                ];
                $tagihanInfaqModel->insert($dataTagihanInfaq);                
            };
                        
            $db->transComplete();
            return true;
        } catch (\Exception $e){
            $db->transRollback();
            return false;
        }
    }

    public function getReqTagihanById($id)
    {
        return $this->db->table('request_tagihan')
        ->select("request_tagihan.*, DATE(request_tagihan.date), administrator.name as nama_admin, array_agg(infaq.name) as nama_infaq")
        ->join('administrator', 'request_tagihan.id_admin = administrator.idadmin')
        ->join('tagihan_infaq', 'request_tagihan.id = tagihan_infaq.id_tagihan')
        ->join('infaq', 'tagihan_infaq.id_infaq = infaq.id')
        ->groupBy('request_tagihan.id, request_tagihan.date, nama_admin')
        ->where('request_tagihan.id',$id)
        ->get()
        ->getRowArray();
    }

}