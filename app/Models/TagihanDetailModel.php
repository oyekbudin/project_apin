<?php

namespace App\Models;

use CodeIgniter\Model;

class TagihanDetailModel extends Model
{
    protected $table      = 'tagihan_detail';
    protected $primaryKey = 'id';
    protected $allowedFields = ['idtagihan', 'idinfaq', 'nominal', 'sudah_dibayar'];

    public function getDetailTagihan($id)
    {
        return $this
        ->join('tagihan','tagihan_detail.idtagihan ='. $id) 
        ->join('infaq','tagihan_detail.idinfaq = infaq.id')
        ->select([
            'DISTINCT ON (infaq.id) infaq.id',
            'infaq.name as nama_infaq',
            'tagihan_detail.*',
            'tagihan.*',
        ])
        ->findAll();
    }
}
