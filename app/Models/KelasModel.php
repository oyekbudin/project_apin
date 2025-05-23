<?php namespace App\Models;

      use CodeIgniter\Model;

Class KelasModel extends Model
{
    protected $table = 'kelas';
    protected $allowedFields = 'id, nama';
    protected $useAutoIncrement = false;
    public function getDataKelas()
    {
        return $this->select()->findAll();
    }

    public function getKelasById($id)
    {
        return $this->find($id);
    }

}