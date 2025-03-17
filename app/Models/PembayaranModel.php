<?php namespace App\Models;

use CodeIgniter\Model;

class PembayaranModel extends Model
{
    protected $table ='pembayaran';
    protected $primaryKey ='id';
    protected $allowedFields = ['idsiswa','idinfaq','nominal','status'];
   
    public function getPembayaran()
    {
        return $this
        ->join('siswa','pembayaran.idsiswa = siswa.nis') 
        ->join('infaq','pembayaran.idinfaq = infaq.id')
        ->select('
            siswa.nis,
            siswa.name as nama_siswa,
            siswa.kelas,
            infaq.name as nama_infaq,
            pembayaran.*
        ')
        ->findAll();
    }
}