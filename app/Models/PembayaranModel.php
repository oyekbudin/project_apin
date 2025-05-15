<?php namespace App\Models;

use CodeIgniter\Model;

class PembayaranModel extends Model
{
    protected $table ='pembayaran';
    protected $primaryKey ='id';
    protected $allowedFields = ['id_siswa','id_infaq','nominal','status','order_id','payment_method','payment_type','transaction_time','fraud_status','snap_token'];
   
    public function getPembayaranDetail($id)
    {
        return $this
        ->join('siswa','pembayaran.id_siswa = siswa.nis') 
        ->join('infaq','pembayaran.id_infaq = infaq.id')
        ->select('
            siswa.nis,
            siswa.name as nama_siswa,
            siswa.kelas,
            infaq.name as nama_infaq,
            pembayaran.*
        ')
        ->where('pembayaran.order_id', $id)
        ->orderBy('pembayaran.date', 'DESC')
        ->findAll();
    }

    public function getPembayaran()
    {
        return $this
        ->select('pembayaran.order_id, DATE(pembayaran.date) as tanggal, pembayaran.id_siswa as nis, siswa.name as nama_siswa, siswa.kelas as kelas, SUM(pembayaran.nominal) as total_nominal')
        ->join('siswa', 'pembayaran.id_siswa = siswa.nis')
        ->groupBy('pembayaran.order_id, pembayaran.date, pembayaran.id_siswa, siswa.name, siswa.kelas')
        ->orderBy('pembayaran.date','DESC')
        ->get()
        ->getResultArray();
        //->findAll();
    }

    public function getPembayaranByBulan($tglAwal, $tglAkhir)
    {
        //$tahun = '2025';
        //$tglAwal = $tahun . '-' . $bulan . '-01';
        //$tglAkhir = date('Y-m-t',strtotime($tglAwal));
        return $this
        ->select('pembayaran.order_id, DATE(pembayaran.date) as tanggal, pembayaran.id_siswa as nis, siswa.name as nama_siswa, siswa.kelas as kelas, SUM(pembayaran.nominal) as total_nominal')
        
        ->join('siswa', 'pembayaran.id_siswa = siswa.nis')
        ->groupBy('pembayaran.order_id, pembayaran.date, pembayaran.id_siswa, siswa.name, siswa.kelas')
        ->orderBy('pembayaran.date, pembayaran.id_siswa')
        //->where("pembayaran.date <=",$tglAkhir)
        ->where("pembayaran.date BETWEEN '$tglAwal' AND '$tglAkhir'")
        //->where('pembayaran.date <=',$tglAkhir)
        
        ->get()
        ->getResultArray();
        //->findAll();
    }

    public function getPembayaranByTahun()
    {
        return $this
        ->select("TO_CHAR(date, 'MM') as bulan, SUM(nominal) as total_nominal")
        //->where('EXTRACT(YEAR FROM date)', $tahun)
        ->groupBy('bulan')
        ->orderBy('bulan', 'ASC')
        ->get()
        ->getResultArray();
    }

    public function getPembayaranDelete($id)
    {
        return $this
        ->join('siswa','pembayaran.id_siswa = siswa.nis') 
        ->join('infaq','pembayaran.id_infaq = infaq.id')
        ->select('
            siswa.nis,
            siswa.name as nama_siswa,
            siswa.kelas,
            infaq.name as nama_infaq,
            pembayaran.*
        ')
        ->find($id);
    }

    public function getTagihan($nis, $kelas)
    {
        return $this
        //->join('siswa','pembayaran.idsiswa = siswa.nis')
        //->join('infaq','pembayaran.idinfaq = infaq.id')
        //->select('
        //    siswa.nis,
        //    siswa.name as nama_siswa,
        //    siswa.kelas,
        //    infaq.id as id_infaq,
        //    infaq.name as nama_infaq,
        //    pembayaran.*
        //')        
        //->where('pembayaran.idsiswa', $nis)
        //->orderBy('infaq.id', 'ASC')
        //->findAll();

        //->from('infaq i')
        //->select([
        //    'DISTINCT ON (i.id, s.nis) i.id AS id_infaq',
        //    's.nis',
        //    's.name AS nama_siswa',
        //    's.kelas',
        //    'i.name AS nama_infaq',
        //    'i.harga',
        //    'COALESCE(p.nominal, 0) AS nominal',
        //    'p.id AS id_pembayaran',
        //])
        //->join('siswa s', 's.nis = ' . $nis, 'inner')
        //->join('pembayaran p', 'p.idinfaq = i.id AND p.idsiswa = s.nis', 'left')
        //->where('i.kelas LIKE', '%7%')
        //->orderBy('i.id', 'ASC') // Urutkan berdasarkan ID infaq
        //->findAll();

        ->from('infaq i')
        ->select([
            'DISTINCT ON (i.id) i.id AS id_infaq', // Mencegah duplikasi
            's.nis',
            's.name AS nama_siswa',
            's.kelas',
            'i.name AS nama_infaq',
            'i.harga',
            'i.harga - COALESCE(p.total_nominal, 0) AS sisa_pembayaran',
            'COALESCE(p.total_nominal, 0) AS nominal', // Jumlahkan pembayaran hanya untuk siswa ini
            'COALESCE(p.last_payment_date, NULL) AS last_payment_date',
        ])
        ->join('siswa s', 's.nis = ' . $nis, 'inner')
        ->join(
            '(SELECT id_infaq, id_siswa, SUM(nominal) AS total_nominal, MAX(date) AS last_payment_date
              FROM pembayaran
              WHERE id_siswa = ' . $nis . ' 
              GROUP BY id_infaq, id_siswa) p',
            'p.id_infaq = i.id',
            'left'
        )
        ->where('i.kelas LIKE', "%{$kelas}%") // Hanya infaq untuk kelas siswa ini
        ->orderBy('i.id', 'ASC')
        ->findAll();
    }

    public function savePembayaran($order_id, $id_siswa, $id_infaq, $nominal, $status, $payment_method)
    {
        //$infaqKelasModel = new InfaqKelasModel();
        //$siswaModel = new SiswaModel();
        //$tagihanModel = new TagihanModel();

        $db = db_connect();
        $db->transStart();
        try {     
            //$dataPembayaran =[];    
             
            foreach ($id_infaq as $key => $value) {
                if (isset($nominal[$key]) && !empty($nominal[$key])) {
                /*foreach ($nominal as $nom) {*/
                    $dataPembayaran[] = [
                        'order_id' => $order_id,
                        'id_siswa' => $id_siswa,
                        'id_infaq' => $value,
                        'nominal' => $nominal[$key],
                        'status' => $status,
                        'payment_method' => $payment_method
                    ];
                }
                
                
                //echo '<pre>';
                //print_r($dataPembayaran);
                //echo '</pre>';
                //$this->insert($dataPembayaran);
            }
            //echo '<pre>';
            //print_r(value: $dataPembayaran);
            //echo '</pre>';
            $this->insertBatch($dataPembayaran);

            $db->transComplete();
            return true;
        } catch (\Exception $e){
            $db->transRollback();
            return false;
        }
    }
}