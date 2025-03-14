<?php namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
    protected $table ='siswa';
    protected $primaryKey ='id';
    protected $allowedFields = ['nis','name','phonenumber','gender','kelas'];

    public function getTotalSiswa()
    {
        return $this->countAll();
    }

    public function getPaginatedSiswa($limit, $offset)
    {
        return $this->orderBy('id', 'ASC')->findAll($limit, $offset);
    }
}