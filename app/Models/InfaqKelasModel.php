<?php namespace App\Models;

      use CodeIgniter\Model;

class InfaqKelasModel extends Model
{
    protected $table = 'infaq_kelas';
    protected $allowedFields = ['id_infaq', 'id_kelas'];

}