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
}