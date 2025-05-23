<?php namespace App\Models;

use CodeIgniter\Model;

class RekeningModel extends Model
{
    protected $table = 'rekening';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_sekolah', 'nama_pemilik_rekening','nama_bank','nomor_rekening','nama_kepsek','nim_kepsek','nama_bendahara','phonenumber'];

    protected $useAutoIncrement = false;
}