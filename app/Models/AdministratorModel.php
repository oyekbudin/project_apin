<?php namespace App\Models;

use CodeIgniter\Model;

class AdministratorModel extends Model
{
    protected $table ='administrator';
    protected $primaryKey ='idadmin';
    protected $allowedFields = ['idadmin','name','registerdate','adminname','role','password'];

    public function getTotalAdministrator()
    {
        return $this->countAll();
    }

    public function getPaginated($limit, $offset)
    {
        return $this->orderBy('idadmin', 'ASC')
                    ->limit($limit, $offset)
                    ->find();
    }

    public function search($keyword)
    {
        return $this->table('administrator')
                    ->like('LOWER(name)', strtolower($keyword))
                    ->findAll();
        
    }
}