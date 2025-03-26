<?php

namespace App\Models;

use CodeIgniter\Model;

class TagihanDetailModel extends Model
{
    protected $table      = 'tagihan_detail';
    protected $primaryKey = 'id';
    protected $allowedFields = ['idtagihan', 'idinfaq', 'nominal', 'sudah_dibayar'];
}
