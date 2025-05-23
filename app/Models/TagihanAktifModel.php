<?php namespace App\Models;

use CodeIgniter\Model;

class TagihanAktifModel extends Model
{
    protected $table = 'tagihan_aktif';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_tagihan'];
    protected $useAutoIncrement = false;

    public function aktif($data)
    {
        //$db = db_connect();
        //$db->query("SELECT setval('tagihan_aktif_id_seq', coalesce(max(id), 0) + 1, false) FROM tagihan_aktif");
        $dataaktif = [
            'id' => $data['id'],
            'id_tagihan' => $data['id_tagihan'],
        ];
        $this->insert($dataaktif);  
    }
}