<?php namespace App\Models;

use CodeIgniter\Model;

class TagihanAktifModel extends Model
{
    protected $table = 'tagihan_aktif';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_tagihan'];

    
}