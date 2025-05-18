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

    public function saveAdministrator($data)
    {
        $db = db_connect();
        $db->query("SELECT setval('users_id_seq', coalesce(max(id), 0) + 1, false) FROM users");
        $db->query("SELECT setval('administrator_idadmin_seq', coalesce(max(id), 0) + 1, false) FROM administrator");
        return $this->insert($data);
    }
}