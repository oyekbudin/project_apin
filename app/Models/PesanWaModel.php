<?php namespace App\Models;

use CodeIgniter\Model;

class PesanWaModel extends Model
{
    protected $table ='pesanwa';
    protected $primaryKey ='id';
    protected $allowedFields = ['nomor_penerima','nama_penerima','pesan','status','response_json','waktu_kirim'];

    
}