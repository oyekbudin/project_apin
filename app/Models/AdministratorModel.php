<?php namespace App\Models;

use CodeIgniter\Model;

class AdministratorModel extends Model
{
    protected $table ='administrator';
    protected $allowedFields = ['name','registerdate','adminname','role','password'];
}