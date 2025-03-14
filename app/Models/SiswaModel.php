<?php namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
    protected $table = 'siswa';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nis', 'name', 'phonenumber', 'gender', 'kelas'];

    public function getTotalSiswa()
    {
        return $this->countAll(); // Hitung total semua siswa
    }

    public function getPaginatedSiswa($limit, $offset)
    {
        return $this->orderBy('id', 'ASC')
                    ->limit($limit, $offset)
                    ->find();
    }

    public function search($keyword)
    {
        return $this->table('siswa')
                    ->like('LOWER(name)', strtolower($keyword))
                    ->findAll();
        
    }
}
