<?php namespace App\Models;

use CodeIgniter\Model;

class InfaqModel extends Model
{
    protected $table ='infaq';
    protected $primaryKey ='id';
    protected $allowedFields = ['name','kelas','harga'];

    public function getTotalInfaq()
    {
        return $this->countAll();
    }

    public function getPaginated($limit, $offset)
    {
        return $this->orderBy('id', 'ASC')
                    ->limit($limit, $offset)
                    ->find();
    }

    public function search($keyword)
    {
        return $this->table('infaq')
                    ->like('LOWER(name)', strtolower($keyword))
                    ->findAll();
    }

    public function searchByKelas($keyword)
    {
        return $this->table('infaq')
                    ->like('kelas',$keyword)
                    ->findAll();
    }

    public function getDataInfaq()
    {
        return $this->select()->findAll();
    }
}