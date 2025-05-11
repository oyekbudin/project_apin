<?php namespace App\Models;

      use CodeIgniter\Model;

class TagihanInfaqModel extends Model
{
    protected $table = 'tagihan_infaq';
    protected $allowedFields = ['id_tagihan','id_infaq'];

}