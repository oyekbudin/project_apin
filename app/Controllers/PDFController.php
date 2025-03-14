<?php namespace App\Controllers;

      use App\Models\SiswaModel;
      use DateTime;
      use Dompdf\Dompdf;
      use Dompdf\Options;

class PDFController extends baseController
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



}