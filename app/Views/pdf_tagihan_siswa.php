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
            /*size: A4 landscape;*/
            size: 330mm 210mm;
            margin: 5mm;       
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
    <?php /*
    $siswa = [];
    $grand_total =0;
    foreach ($datatagihan as $item) {
        $nis = $item['nis'];
        
        if (!isset($siswa[$nis])) {
            $siswa[$nis] = [
                'nis' => $item['nis'],
                'nama' => $item['nama_siswa'],
                'kelas' => $item['kelas'],
                'total_tagihan' => 0
            ];
        }

        $siswa[$nis]['total_tagihan'] += $item['sisa_tagihan'];
        $grand_total += $item['sisa_tagihan'];
    }  */
    ?>

    <!--table >
        <tr>
            <td style="potong">
            <table>
        <tr>
            <td colspan="2" style="text-align: center;">Rincian Administrasi<br>SMP Ma'arif NU 01 Wanareja</td>
        </tr>
        <tr>
            <td colspan="2">Nama : <br>Kelas : </td>
        </tr>
        <tr>
            <td>SOT April<br>SOT Mei</td>
            <td style="text-align: right;">45.000<br>45.000</td>
        </tr>
        <tr>
            <td>Jumlah</td>
            <td style="text-align: right;">90.000</td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;">Catatan: Jika ada kesalahan, silakan bisa menghubungi Bendahara Arvin Noer Hakim<br> 08121475939<br>Terima Kasih</td>
        </tr>
    </table>
            </td>
            <td>
            <table>
        <tr>
            <td colspan="2" style="text-align: center;">Rincian Administrasi<br>SMP Ma'arif NU 01 Wanareja</td>
        </tr>
        <tr>
            <td colspan="2">Nama : <br>Kelas : </td>
        </tr>
        <tr>
            <td>SOT April<br>SOT Mei</td>
            <td style="text-align: right;">45.000<br>45.000</td>
        </tr>
        <tr>
            <td>Jumlah</td>
            <td style="text-align: right;">90.000</td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;">Catatan: Jika ada kesalahan, silakan bisa menghubungi Bendahara Arvin Noer Hakim<br> 08121475939<br>Terima Kasih</td>
        </tr>
    </table>
            </td>
            <td>
            <table>
        <tr>
            <td colspan="2" style="text-align: center;">Rincian Administrasi<br>SMP Ma'arif NU 01 Wanareja</td>
        </tr>
        <tr>
            <td colspan="2">Nama : <br>Kelas : </td>
        </tr>
        <tr>
            <td>SOT April<br>SOT Mei</td>
            <td style="text-align: right;">45.000<br>45.000</td>
        </tr>
        <tr>
            <td>Jumlah</td>
            <td style="text-align: right;">90.000</td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;">Catatan: Jika ada kesalahan, silakan bisa menghubungi Bendahara Arvin Noer Hakim<br> 08121475939<br>Terima Kasih</td>
        </tr>
    </table>
            </td>
            <td>
            <table>
        <tr>
            <td colspan="2" style="text-align: center;">Rincian Administrasi<br>SMP Ma'arif NU 01 Wanareja</td>
        </tr>
        <tr>
            <td colspan="2">Nama : <br>Kelas : </td>
        </tr>
        <tr>
            <td>SOT April<br>SOT Mei</td>
            <td style="text-align: right;">45.000<br>45.000</td>
        </tr>
        <tr>
            <td>Jumlah</td>
            <td style="text-align: right;">90.000</td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;">Catatan: Jika ada kesalahan, silakan bisa menghubungi Bendahara Arvin Noer Hakim<br> 08121475939<br>Terima Kasih</td>
        </tr>
    </table>
            </td>
        </tr>
    </table-->

    <?php

$grouped = [];
foreach ($datatagihan as $item) {
    $nis = $item['nis'];
    if (!isset($grouped[$nis])) {
        $grouped[$nis] = [
            'nama_siswa' => $item['nama_siswa'],
            'kelas' => $item['kelas'],
            'infaq' => []
        ];
    }
    $grouped[$nis]['infaq'][] = [
        'nama_infaq' => $item['nama_infaq'],
        'harga_infaq' => $item['sisa_tagihan']
    ];

    //$status = ($nis[$nis]['total_tagihan'] == 0) ? "L" : "B";
}

$counter = 0;
foreach ($grouped as $nis => $siswa):
    if ($counter % 4 == 0): // Setiap 4 tabel mulai baris baru
        if ($counter > 0): // Mulai halaman baru setelah 4
            echo '<div style="page-break-after: always;"></div>';
        endif;
        echo '<table><tr>';
    endif;
?>

<td>
    <table>
        <tr>
            <td colspan="2" style="text-align: center;">
                Rincian Administrasi<br>SMP Ma'arif NU 01 Wanareja
            </td>
        </tr>
        <tr>
            <td colspan="2">
                Nama : <?= $siswa['nama_siswa'] ?><br>
                Kelas : <?= $siswa['kelas'] ?>
            </td>
        </tr>
        <?php 
            $total = 0;
            foreach ($siswa['infaq'] as $item): 
                $total += $item['harga_infaq'];
            $status = ($total == 0) ? "L" : "B";
        ?>
        <tr>
            <td><?= $item['nama_infaq'] ?></td>
            <td style="text-align: right;">
                <?= number_format($item['harga_infaq'], 0, ',', '.') ?>
            </td>
        </tr>
        <?php endforeach; ?>
        <tr>
            <td>Jumlah</td>
            <td style="text-align: right;"><?= number_format($total, 0, ',', '.') ?></td>
        </tr>
        <tr>
            <td>Keterangan</td>
            <td style="text-align: center;"><?= ($status == "L") ? "Lunas" : "Belum Lunas" ?></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;">
                Catatan: Jika ada kesalahan, silakan bisa menghubungi Bendahara Arvin Noer Hakim<br>
                08121475939<br>Terima Kasih
            </td>
        </tr>
    </table>
</td>

<?php
    $counter++;
    if ($counter % 4 == 0) {
        echo '</tr></table>';
    }
endforeach;

// Jika sisa tabel < 4, tutup table terakhir
if ($counter % 4 != 0) {
    echo '</tr></table>';
}
?>


    

    <!--table class="tablearea">
        <thead>
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Total Tagihan</th>
            </tr>
        </thead>
        <tbody>
            <?php /*
            $no = 1; 
            foreach ($siswa as $row): ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['nis']; ?></td>
                <td><?= $row['nama']; ?></td>
                <td><?= $row['kelas']; ?></td>                
                <td style="text-align:right"><?= number_format($row['total_tagihan'], 0, ',', '.'); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
                <tr>
                    <td colspan="4" style="text-align: center;">Jumlah</td>
                    <td style="text-align: right;"><?= number_format($grand_total, 0, ',', '.'); */?></td>
                </tr>
            </tfoot> 
    </table-->
</body>
</html>