<!DOCTYPE html>
<html lang="id"
>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Infaq</title>
    <style>
             
        .kop 
        {
            text-align: center;
        }
        .logo {position: absolute; top: 10px; left: 0;}

        .arial
        {
            font-family: Arial, Helvetica, sans-serif;
        }
               
        .timesnewroman
        {
            font-family: 'Times New Roman', Times, serif;
        }
        body {font-family: Arial, Helvetica, sans-serif; font-size: 12pt;}
        .garis {border-top: 4px solid #000;border-bottom: 1px solid #000;height: 1px;margin-top: 5px;}
        .heading {
            text-align: center;
            line-height: 3;
        }
        
        @page { 
            size: A4 landscape;
            margin: 15mm 15mm 15mm 15mm;       
        }
        .mengetahui{padding-left: 700px;page-break-inside: avoid;break-inside: avoid;}
        .tablearea {margin: auto;}
        table, tr, td, th{
            border: 1px solid #000;
            border-collapse: collapse;
            padding: 4px 20px 4px 4px;
        }
        table{width: 100%;}
        thead{
            background-color: yellow;
        }
    </style>
</head>
<body>
    <?php
    $path = FCPATH . 'assets/logo.jpg' ;
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    ?>
<div class="kop">
    <span class="arial" style="font-size:14pt;font-weight:bold;">LEMBAGA PENDIDIKAN MA'ARIF NU</span><br>
    <span class="timesnewroman" style="font-size:18pt;font-weight:bold;">SMP MA'ARIF NU 01 WANAREJA</span><br>
    <span class="arial" style="font-size:12pt;font-weight:bold;">TERAKREDITASI B (BAIK)</span><br>
    <span class="arial" style="font-size:11pt;font-weight:normal;">Alamat : Jl. KH. Hasyim Asy'ari No.9 RT 03/XII Bantar Wanareja 53265</span>
    <div class="garis"></div>
    <div class="logo">
    <img src="<?= $base64 ?>" alt="" width="100"></div>
</div>
<div class="heading">
    <span class="arial" style="font-size:14pt;font-weight:bold;">LAPORAN BULANAN ADMINISTRASI SMP MA'ARIF NU 01 WANAREJA</span>
</div>
            <?php
            $total_pembayaran = 0;
            foreach ($datapembayaran as $d) {
            $total_pembayaran += $d['total_nominal'];
            }
            ?>
    <table class="tablearea">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Nominal</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $no = 1; 
            foreach ($datapembayaran as $d): ?>
            <tr>
                <td style="text-align: center;"><?= $no++; ?></td>
                <td style="text-align: center;"><?= date('d/m/Y', strtotime($d['tanggal'])); ?></td>
                <td style="text-align: center;"><?= $d['nis']; ?></td>                
                <td><?= $d['nama_siswa']; ?></td>
                <td style="text-align: center;"><?= $d['kelas']; ?></td>
                <td style="text-align: right;"><?= number_format($d['total_nominal'],0,',','.'); ?></td>
            </tr>
            <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" style="text-align: center;">Jumlah</td>
                    <td style="text-align: right;"><?= number_format($total_pembayaran, 0, ',', '.'); ?></td>
                </tr>
            </tfoot>
    </table>
    <div class="mengetahui">
    <br><span>Wanareja, <?= $tanggal; ?></span><br>
    <span>Mengetahui,</span><br>
    <span>Kepala Sekolah</span><br><br><br><br><br>
    <span><?= $kepalasekolah ;?></span><br>
    <span>NIM. <?= $nim ;?></span>
    </div>
</body>
</html>
