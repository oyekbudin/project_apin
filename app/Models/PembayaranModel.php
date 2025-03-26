<?php namespace App\Models;

use CodeIgniter\Model;

class PembayaranModel extends Model
{
    protected $table ='pembayaran';
    protected $primaryKey ='id';
    protected $allowedFields = ['idsiswa','idinfaq','nominal','status'];
   
    public function getPembayaran()
    {
        return $this
        ->join('siswa','pembayaran.idsiswa = siswa.nis') 
        ->join('infaq','pembayaran.idinfaq = infaq.id')
        ->select('
            siswa.nis,
            siswa.name as nama_siswa,
            siswa.kelas,
            infaq.name as nama_infaq,
            pembayaran.*
        ')
        ->findAll();
    }

    public function getPembayaranDelete($id)
    {
        return $this
        ->join('siswa','pembayaran.idsiswa = siswa.nis') 
        ->join('infaq','pembayaran.idinfaq = infaq.id')
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
            '(SELECT idinfaq, idsiswa, SUM(nominal) AS total_nominal, MAX(date) AS last_payment_date
              FROM pembayaran
              WHERE idsiswa = ' . $nis . ' 
              GROUP BY idinfaq, idsiswa) p',
            'p.idinfaq = i.id',
            'left'
        )
        ->where('i.kelas LIKE', "%{$kelas}%") // Hanya infaq untuk kelas siswa ini
        ->orderBy('i.id', 'ASC')
        ->findAll();
    }
}