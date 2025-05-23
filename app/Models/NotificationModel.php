<?php namespace App\Models;

use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class NotificationModel extends Model
{
    protected $table ='notification';
    protected $primaryKey ='id';
    protected $allowedFields = ['gross_amount','payment_type','transaction_status','created_at','order_id','id_siswa','id_infaq','nominal','payment_method','snaptoken'];

    protected $useAutoIncrement = false;
    
    public function saveNotification($data)
    {
        $id_infaq = $data['id_infaq'];
        $nominal = $data['nominal'];


        $db = db_connect();
        //$db->query("SELECT setval('notification_id_seq', coalesce(max(id), 0) + 1, false) FROM notification");
        $db->transStart();
        try {     
            foreach ($id_infaq as $key => $value) {
                if (isset($nominal[$key]) && !empty($nominal[$key])) {
                /*foreach ($nominal as $nom) {*/
                    $dataNotification[] = [
                        'id' => Uuid::uuid4()->toString(),
                        'order_id' => $data['order_id'],
                        'id_siswa' => $data['id_siswa'],
                        'id_infaq' => $value,
                        'nominal' => $nominal[$key],
                        'transaction_status' => $data['transaction_status'],
                        'payment_method' => $data['payment_method'],
                        'gross_amount' => $data['gross_amount'],
                        'snaptoken' => $data['snaptoken'],
                    ];
                }
            }
            $this->insertBatch($dataNotification);
            //echo $db->getLastQuery();
            //$db = \Config\Database::connect();
            //echo $db->getLastQuery();

            $db->transComplete();
            return true;
        } catch (\Exception $e){
            $db->transRollback();
            //$lastQuery = $db->getLastQuery();
            //echo $e->getMessage();
            return false;
        }
    }

    public function getNotification()
    {
        return $this
        ->select('notification.order_id, DATE(notification.transaction_time) as waktu_transaksi, notification.id_siswa as nis, siswa.name as nama_siswa, siswa.kelas as kelas, notification.gross_amount as total_nominal, notification.transaction_status as status, notification.payment_method as metode_pembayaran')
        ->join('siswa', 'notification.id_siswa = siswa.nis')
        ->groupBy('notification.order_id, notification.transaction_time, notification.id_siswa, siswa.name, siswa.kelas, notification.gross_amount, notification.transaction_status, notification.payment_method')
        ->orderBy('notification.transaction_time','DESC')
        ->get()
        ->getResultArray();
    }

    public function getPendingNotifById($id)
    {
        return $this
        ->select('notification.order_id, DATE(notification.transaction_time) as waktu_transaksi, notification.id_siswa as nis, siswa.name as nama_siswa, siswa.kelas as kelas, notification.gross_amount as total_nominal, notification.transaction_status as status, notification.payment_method as metode_pembayaran, notification.snaptoken')
        ->join('siswa', 'notification.id_siswa = siswa.nis')
        ->groupBy('notification.order_id, notification.transaction_time, notification.id_siswa, siswa.name, siswa.kelas, notification.gross_amount, notification.transaction_status, notification.payment_method, notification.snaptoken')
        //->orderBy('pembayaran.date','DESC')
        ->where('id_siswa', $id)
        ->where('transaction_status','pending')
        ->get()
        ->getResultArray();
    }

    public function getDetailNotification()
    {}
}