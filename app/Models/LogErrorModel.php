<?php namespace App\Models;

use CodeIgniter\Model;

class LogErrorModel extends Model
{
    protected $table ='log_error_pembayaran';
    protected $primaryKey ='id';
    protected $allowedFields = ['order_id','status_message','status_code','transaction_status','payment_type','raw_response','created_at'];

    protected $useAutoIncrement = false;
}