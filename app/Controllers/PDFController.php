<?php namespace App\Controllers;

use App\Models\InfaqModel;
use App\Models\KelasModel;
use App\Models\PembayaranModel;
use App\Models\SiswaModel;
use App\Models\TagihanModel;
use CodeIgniter\Controller;
      use DateTime;
      use Dompdf\Dompdf;
      use Dompdf\Options;

class PDFController extends Controller
{
    public function exportToPdf()
{
    date_default_timezone_set('Asia/Jakarta');
    $tgl = new DateTime();
    $bln = [
        'January' => 'Januari',
        'February' => 'Februari',
        'March' => 'Maret',
        'May' => 'Mei',
        'June' => 'Juni',
        'July' => 'Juli',
        'August' => 'Agustus',
        'October' => 'Oktober',
        'December' => 'Desember'
    ];

    $formatTgl = $tgl->format('j') . ' ' . $bln[$tgl->format('F')] . ' ' . $tgl->format('Y');

    $siswaModel = new SiswaModel();
    $siswa = $siswaModel->findAll(); 
    $kepalasekolah = 'Ibnu Sadun Isngadi, S.Pd.';
    $nim = '113401118';
    $data = [
        'siswa' => $siswa,
        'tanggal' => $formatTgl,
        'kepalasekolah' => $kepalasekolah,
        'nim' => $nim,
    ];
    $html = view('pdf_siswa', $data);

    $options = new Options();
    $options->set('defaultFont', 'Arial');
    $options->set('isRemoteEnabled', false);
    $dompdf = new Dompdf($options);

    $dompdf->loadHtml($html);

    $dompdf->setPaper('A4', 'posrtrait');
    $dompdf->render();

    $canvas = $dompdf->getCanvas();
    $font = $dompdf->getFontMetrics()->get_font("helvetica", "normal");
    $canvas->page_text(270, 820, "Halaman {PAGE_NUM} dari {PAGE_COUNT}", $font, 10, array(0,0,0));

    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="data_siswa.pdf"'); 
    header('Cache-Control: public, must-revalidate, max-age=0');
    header('Pragma: public');
    header('Expires: 0');

    echo $dompdf->output();
    exit;
}
public function exportInfaq()
{
    date_default_timezone_set('Asia/Jakarta');
    $tgl = new DateTime();
    $bln = [
        'January' => 'Januari',
        'February' => 'Februari',
        'March' => 'Maret',
        'May' => 'Mei',
        'June' => 'Juni',
        'July' => 'Juli',
        'August' => 'Agustus',
        'October' => 'Oktober',
        'December' => 'Desember'
    ];

    $formatTgl = $tgl->format('j') . ' ' . $bln[$tgl->format('F')] . ' ' . $tgl->format('Y');

    $Model = new InfaqModel();
    $kelasModel = new KelasModel();
    $infaq = $Model->exportInfaqPDF(); 
    $kepalasekolah = 'Ibnu Sadun Isngadi, S.Pd.';
    $nim = '113401118';
    $data = [
        'infaq' => $infaq,
        'tanggal' => $formatTgl,
        'kepalasekolah' => $kepalasekolah,
        'nim' => $nim,
        'kelas' => $kelasModel->getDataKelas(),
    ];
    $html = view('pdf_infaq', $data);

    $options = new Options();
    $options->set('defaultFont', 'Arial');
    $options->set('isRemoteEnabled', false);
    $dompdf = new Dompdf($options);

    $dompdf->loadHtml($html);

    $dompdf->setPaper('A4', 'posrtrait');
    $dompdf->render();

    $canvas = $dompdf->getCanvas();
    $font = $dompdf->getFontMetrics()->get_font("helvetica", "normal");
    $canvas->page_text(270, 820, "Halaman {PAGE_NUM} dari {PAGE_COUNT}", $font, 10, array(0,0,0));

    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="data_infaq.pdf"'); 
    header('Cache-Control: public, must-revalidate, max-age=0');
    header('Pragma: public');
    header('Expires: 0');

    echo $dompdf->output();
    exit;
}

public function laporanBulanan($bulan)
{
    date_default_timezone_set('Asia/Jakarta');
    $tgl = new DateTime();
    $bln = [
        'January' => 'Januari',
        'February' => 'Februari',
        'March' => 'Maret',
        'May' => 'Mei',
        'June' => 'Juni',
        'July' => 'Juli',
        'August' => 'Agustus',
        'October' => 'Oktober',
        'December' => 'Desember'
    ];

    $formatTgl = $tgl->format('j') . ' ' . $bln[$tgl->format('F')] . ' ' . $tgl->format('Y');

    $Model = new PembayaranModel();
    $tahun = '2025'; 
    $tglAwal = "$tahun-$bulan-01";
    $tglAkhir = date('Y-m-t', strtotime($tglAwal));
    $datapembayaran = $Model->getPembayaranByBulan($tglAwal, $tglAkhir); 
    //$tanggalttd = strftime("%d %B %Y", strtotime($tglAkhir->format('Y-m-d')));
    $bulanIndo = [
        '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
        '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
        '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
    ];

    $tanggalAkhir = new DateTime($tglAkhir);

    $day = $tanggalAkhir->format('d');
    $month = $bulanIndo[$tanggalAkhir->format('m')];
    $year = $tanggalAkhir->format('Y');

    $tglTtd = "$day $month $year";

    $kepalasekolah = 'Ibnu Sadun Isngadi, S.Pd.';
    $nim = '113401118';
    $data = [
        'datapembayaran' => $datapembayaran,
        'tanggal' => $tglTtd,
        'kepalasekolah' => $kepalasekolah,
        'nim' => $nim,
    ];
    $html = view('pdf_laporanbulanan', $data);

    $options = new Options();
    $options->set('defaultFont', 'Arial');
    $options->set('isRemoteEnabled', false);
    $dompdf = new Dompdf($options);

    $dompdf->loadHtml($html);

    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();

    $canvas = $dompdf->getCanvas();
    $font = $dompdf->getFontMetrics()->get_font("helvetica", "normal");
    $canvas->page_text(270, 820, "Halaman {PAGE_NUM} dari {PAGE_COUNT}", $font, 10, array(0,0,0));

    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="laporan_bulanan.pdf"'); 
    header('Cache-Control: public, must-revalidate, max-age=0');
    header('Pragma: public');
    header('Expires: 0');

    echo $dompdf->output();
    exit;

}

public function laporanTahunan()
{
    date_default_timezone_set('Asia/Jakarta');
    $tgl = new DateTime();
    $bln = [
        'January' => 'Januari',
        'February' => 'Februari',
        'March' => 'Maret',
        'May' => 'Mei',
        'June' => 'Juni',
        'July' => 'Juli',
        'August' => 'Agustus',
        'October' => 'Oktober',
        'December' => 'Desember'
    ];

    $formatTgl = $tgl->format('j') . ' ' . $bln[$tgl->format('F')] . ' ' . $tgl->format('Y');

    $Model = new PembayaranModel();
    $tahun = '2025'; 
    $tglAwal = "$tahun-05-01";
    $tglAkhir = date('Y-m-t', strtotime($tglAwal));
    $datapembayaran = $Model->getPembayaranByTahun(); 
    //$tanggalttd = strftime("%d %B %Y", strtotime($tglAkhir->format('Y-m-d')));
    $bulanIndo = [
        '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
        '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
        '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
    ];

    $tanggalAkhir = new DateTime($tglAkhir);

    $day = $tanggalAkhir->format('d');
    $month = $bulanIndo[$tanggalAkhir->format('m')];
    $year = $tanggalAkhir->format('Y');

    $tglTtd = "$day $month $year";

    $kepalasekolah = 'Ibnu Sadun Isngadi, S.Pd.';
    $nim = '113401118';
    $data = [
        'datapembayaran' => $datapembayaran,
        'tanggal' => $tglTtd,
        'kepalasekolah' => $kepalasekolah,
        'nim' => $nim,
    ];

    //echo '<pre>';
    //print_r($data['datapembayaran']);
    //echo '</pre>';
    $html = view('pdf_laporantahunan', $data);

    $options = new Options();
    $options->set('defaultFont', 'Arial');
    $options->set('isRemoteEnabled', false);
    $dompdf = new Dompdf($options);

    $dompdf->loadHtml($html);

    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();

    $canvas = $dompdf->getCanvas();
    $font = $dompdf->getFontMetrics()->get_font("helvetica", "normal");
    $canvas->page_text(270, 820, "Halaman {PAGE_NUM} dari {PAGE_COUNT}", $font, 10, array(0,0,0));

    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="laporan_tahunan.pdf"'); 
    header('Cache-Control: public, must-revalidate, max-age=0');
    header('Pragma: public');
    header('Expires: 0');

    echo $dompdf->output();
    exit; 
}

public function tagihan($id)
{
    date_default_timezone_set('Asia/Jakarta');
    $tgl = new DateTime();
    $bln = [
        'January' => 'Januari',
        'February' => 'Februari',
        'March' => 'Maret',
        'May' => 'Mei',
        'June' => 'Juni',
        'July' => 'Juli',
        'August' => 'Agustus',
        'October' => 'Oktober',
        'December' => 'Desember'
    ];

    $formatTgl = $tgl->format('j') . ' ' . $bln[$tgl->format('F')] . ' ' . $tgl->format('Y');

    $tagihanModel = new TagihanModel();
    //$siswa = $siswaModel->findAll(); 
    $datatagihan = $tagihanModel->getTagihanByRequestForExport($id);

    //echo '<pre>';
    //print_r($datatagihan);
    //echo '</pre>';
    
    $kepalasekolah = 'Ibnu Sadun Isngadi, S.Pd.';
    $nim = '113401118';
    $data = [
        'datatagihan' => $datatagihan,
        'tanggal' => $formatTgl,
        'kepalasekolah' => $kepalasekolah,
        'nim' => $nim,
    ];
    $html = view('pdf_tagihan', $data);

    $options = new Options();
    $options->set('defaultFont', 'Arial');
    $options->set('isRemoteEnabled', false);
    $dompdf = new Dompdf($options);

    $dompdf->loadHtml($html);

    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    $canvas = $dompdf->getCanvas();
    $font = $dompdf->getFontMetrics()->get_font("helvetica", "normal");
    $canvas->page_text(270, 820, "Halaman {PAGE_NUM} dari {PAGE_COUNT}", $font, 10, array(0,0,0));

    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="data_tagihan.pdf"'); 
    header('Cache-Control: public, must-revalidate, max-age=0');
    header('Pragma: public');
    header('Expires: 0');

    echo $dompdf->output();
    exit; 
}

public function tagihan_siswa($id)
{
    date_default_timezone_set('Asia/Jakarta');
    $tgl = new DateTime();
    $bln = [
        'January' => 'Januari',
        'February' => 'Februari',
        'March' => 'Maret',
        'May' => 'Mei',
        'June' => 'Juni',
        'July' => 'Juli',
        'August' => 'Agustus',
        'October' => 'Oktober',
        'December' => 'Desember'
    ];

    $formatTgl = $tgl->format('j') . ' ' . $bln[$tgl->format('F')] . ' ' . $tgl->format('Y');

    $tagihanModel = new TagihanModel();
    //$siswa = $siswaModel->findAll(); 
    $datatagihan = $tagihanModel->getTagihanByRequestForExport($id);

    //echo '<pre>';
    //print_r($datatagihan);
    //echo '</pre>';
    
    $kepalasekolah = 'Ibnu Sadun Isngadi, S.Pd.';
    $nim = '113401118';
    $data = [
        'datatagihan' => $datatagihan,
        'tanggal' => $formatTgl,
        'kepalasekolah' => $kepalasekolah,
        'nim' => $nim,
    ];
    $html = view('pdf_tagihan_siswa', $data);

    $options = new Options();
    $options->set('defaultFont', 'Arial');
    $options->set('isRemoteEnabled', false);
    $dompdf = new Dompdf($options);

    $dompdf->loadHtml($html);

    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    $canvas = $dompdf->getCanvas();
    $font = $dompdf->getFontMetrics()->get_font("helvetica", "normal");
    $canvas->page_text(270, 820, "Halaman {PAGE_NUM} dari {PAGE_COUNT}", $font, 10, array(0,0,0));

    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="data_tagihan_siswa.pdf"'); 
    header('Cache-Control: public, must-revalidate, max-age=0');
    header('Pragma: public');
    header('Expires: 0');

    echo $dompdf->output();
    exit; 
}

}