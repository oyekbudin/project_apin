<?php

namespace App\Models;

use CodeIgniter\Model;

class TagihanModel extends Model
{
    protected $table      = 'tagihan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_siswa', 'id_infaq', 'nominal'];
    protected $useAutoIncrement = false;

    /*public function getTagihan()
    {
        return $this
        ->join('siswa','tagihan.idsiswa = siswa.nis') 
        ->select('
            siswa.nis,
            siswa.name as nama_siswa,
            siswa.kelas,
            tagihan.*
        ')
        ->findAll();
    }*/
    public function getTotalTagihan()
    {
        return $this->countAll(); // Hitung total semua tagihan
    }

    public function getPaginated($limit, $offset)
    {
        /*return $this->orderBy('id', 'ASC')
                    ->groupBy('id_siswa')
                    ->limit($limit, $offset)
                    ->find();
        */

        return $this->db->table('tagihan t')
                        ->join('siswa s', 't.id_siswa = s.nis')
                        ->join('infaq i', 't.id_infaq = i.id')
                        ->select('s.nis, s.name as nama_siswa, s.kelas, array_agg(i.name) as nama_infaq, array_agg(i.harga) as harga_infaq')
                        ->selectSum('i.harga','total_tagihan')
                        ->groupBy('s.nis')
                        ->limit($limit, $offset)
                        ->get()
                        ->getResultArray();
    }

    public function getTagihanByRequest($request)
    {
        return $this->db->table('tagihan t')
                        ->join('siswa s', 't.id_siswa = s.nis')
                        ->join('infaq i', 't.id_infaq = i.id')
                        ->join('tagihan_infaq ti','t.id_infaq = ti.id_infaq')
                        ->select('s.nis, s.name as nama_siswa, s.kelas, array_agg(i.name) as nama_infaq, array_agg(i.harga) as harga_infaq, ti.id_tagihan as id_tagihan')
                        ->selectSum('i.harga','total_tagihan')
                        ->where('ti.id_tagihan',$request)
                        ->groupBy('s.nis, ti.id_tagihan')
                        ->orderBy('s.nis')
                        //->limit($limit, $offset)
                        ->get()
                        ->getResultArray();
    }
    

    public function getTagihanByRequestForExport($request)
    {
        return $this->db->table('tagihan t')
        ->join('siswa s', 't.id_siswa = s.nis')
        ->join('infaq i', 't.id_infaq = i.id')
        ->join('tagihan_infaq ti','t.id_infaq = ti.id_infaq')
        ->join('pembayaran p', 't.id_siswa = p.id_siswa AND t.id_infaq = p.id_infaq', 'left')
        ->select('
            s.nis, 
            s.name AS nama_siswa, 
            s.kelas, 
            i.id AS id_infaq, 
            i.name AS nama_infaq, 
            i.harga AS harga_infaq, 
            COALESCE(SUM(p.nominal), 0) AS total_pembayaran,
            i.harga - COALESCE(SUM(p.nominal), 0) AS sisa_tagihan,
            ti.id_tagihan as id_tagihan
        ')
        //->where('t.id_siswa', $id)
        ->where('ti.id_tagihan',$request)
        ->groupBy('s.nis, s.name, s.kelas, i.harga, i.id, i.name, ti.id_tagihan')
        ->get()
        ->getResultArray();
    }
    public function getSisaTagihan($request)
    {
        return $this->db->table('tagihan t')
        ->join('siswa s', 't.id_siswa = s.nis')
        ->join('infaq i', 't.id_infaq = i.id')
        ->join('tagihan_infaq ti','t.id_infaq = ti.id_infaq')
        ->join('pembayaran p', 't.id_siswa = p.id_siswa AND t.id_infaq = p.id_infaq', 'left')
        ->select('
            s.nis, 
            i.id AS id_infaq, 
            i.harga - COALESCE(SUM(p.nominal), 0) AS sisa_tagihan
        ')
        //->where('t.id_siswa', $id)
        ->where('ti.id_tagihan',$request)
        ->groupBy('s.nis, i.harga, i.id, ti.id_tagihan')
        ->orderBy('nis','ASC')
        ->get()
        ->getResultArray();
    }
    public function getNominalInfaq($id, $request, $id_infaq)
    {
        return $this->db->table('tagihan t')
        ->join('siswa s', 't.id_siswa = s.nis')
        ->join('infaq i', 't.id_infaq = i.id')
        ->join('tagihan_infaq ti','t.id_infaq = ti.id_infaq')
        ->join('pembayaran p', 't.id_siswa = p.id_siswa AND t.id_infaq = p.id_infaq', 'left')
        ->select('
            s.nis, 
            i.id AS id_infaq, 
            i.harga - COALESCE(SUM(p.nominal), 0) AS sisa_tagihan
        ')
        ->where('t.id_siswa', $id)
        ->where('ti.id_tagihan',$request)
        ->whereIn('i.id',$id_infaq)
        ->groupBy('s.nis, i.harga, i.id, ti.id_tagihan')
        ->orderBy('nis','ASC')
        ->get()
        ->getResultArray();
    }

    public function getTagihanByRequestById($id, $request)
    {
        return $this->db->table('tagihan t')
        ->join('siswa s', 't.id_siswa = s.nis')
        ->join('infaq i', 't.id_infaq = i.id')
        ->join('tagihan_infaq ti','t.id_infaq = ti.id_infaq')
        ->join('pembayaran p', 't.id_siswa = p.id_siswa AND t.id_infaq = p.id_infaq', 'left')
        ->select('
            s.nis, 
            s.name AS nama_siswa, 
            s.kelas, 
            i.id AS id_infaq, 
            i.name AS nama_infaq, 
            i.harga AS harga_infaq, 
            COALESCE(SUM(p.nominal), 0) AS total_pembayaran,
            i.harga - COALESCE(SUM(p.nominal), 0) AS sisa_tagihan,
            ti.id_tagihan as id_tagihan
        ')
        ->where('t.id_siswa', $id)
        ->where('ti.id_tagihan',$request)
        ->groupBy('s.nis, s.name, s.kelas, i.id, i.name, i.harga, ti.id_tagihan')
        ->orderBy('i.created_at','ASC')
        ->get()
        ->getResultArray();
    }

    public function search($keyword)
    {
        return $this->table('tagihan')
                    ->like('id_siswa')
                    ->findAll();        
    }

    public function old_getTagihanById($id)
    {
        return $this->db->table('tagihan t')
        ->join('siswa s', 't.id_siswa = s.nis')
        ->join('infaq i', 't.id_infaq = i.id')
        ->select('s.*, s.name as nama_siswa, s.kelas, i.name as nama_infaq, i.harga as harga_infaq, i.id as id_infaq')
        //->selectSum('i.harga','total_tagihan')
        //->groupBy('s.nis')
        ->where('t.id_siswa',$id)
        ->get()
        ->getResultArray();
        
    }

    public function getTagihanById($id)
    {
        return $this->db->table('tagihan t')
    ->join('siswa s', 't.id_siswa = s.nis')
    ->join('infaq i', 't.id_infaq = i.id')
    ->join('pembayaran p', 't.id_siswa = p.id_siswa AND t.id_infaq = p.id_infaq', 'left')
    ->select('
        s.nis, 
        s.name AS nama_siswa, 
        s.kelas, 
        i.id AS id_infaq, 
        i.name AS nama_infaq, 
        i.harga AS harga_infaq, 
        COALESCE(SUM(p.nominal), 0) AS total_pembayaran,
        i.harga - COALESCE(SUM(p.nominal), 0) AS sisa_tagihan
    ')
    ->where('t.id_siswa', $id)
    ->groupBy('s.nis, s.name, s.kelas, i.id, i.name, i.harga')
    ->orderBy('i.created_at','ASC')
    ->get()
    ->getResultArray();

        
    }
}
