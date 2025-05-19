<?php namespace App\Models;

use CodeIgniter\Model;

class NotificationModel extends Model
{
    protected $table ='notification';
    protected $primaryKey ='id';
    protected $allowedFields = ['gross_amount','payment_type','transaction_status','created_at','order_id','id_siswa','id_infaq','nominal','payment_method'];

    
}