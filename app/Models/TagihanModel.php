<?php

namespace App\Models;

use CodeIgniter\Model;

class TagihanModel extends Model
{
    protected $table      = 'tagihan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['idsiswa', 'tanggal', 'total'];

    public function getTagihan()
    {
        return $this
        ->join('siswa','tagihan.idsiswa = siswa.nis') 
        ->select('
            siswa.nis,
            siswa.name as nama_siswa,
            siswa.kelas,
            tagihan.*
        ')
        ->findAll();
    }

    public function search($keyword)
    {
        return $this->table('tagihan')
                    ->like('LOWER(nama_siswa)', strtolower($keyword))
                    ->findAll();        
    }
}
