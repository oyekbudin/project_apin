<!DOCTYPE html>
<html lang="id"
>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
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
        .tablearea {margin: auto;}
        table, tr, td, th{
            border: 1px solid #000;
            border-collapse: collapse;
            padding: 4px 20px 4px 4px;
        }
        thead{
            background-color: yellow;
        }
        @page { 
            size: A4 portrait;
            margin: 15mm 15mm 15mm 15mm;       
        }
        .mengetahui{margin-left: 420px;}
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
    <span class="arial" style="font-size:14pt;font-weight:bold;">DATA SISWA-SISWI SMP MA'ARIF NU 01 WANAREJA</span>
</div>
    <table class="tablearea">
        <thead>
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>JK</th>
                <th>No Whatsapp</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1; 
            foreach ($siswa as $row): ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['nis']; ?></td>
                <td><?= $row['name']; ?></td>
                <td><?= $row['kelas']; ?></td>                
                <td><?= $row['gender']; ?></td>
                <td><?= $row['phonenumber']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="mengetahui">
    <br><span>Wanareja, <?= $tanggal; ?></span><br>
    <span>Mengetahui,</span><br>
    <span>Kepala Sekolah</span><br><br><br><br><br>
    <span><?= $kepalasekolah ;?></span><br>
    <span>NIM. <?= $nim ;?></span></div>
</body>
</html>
