<?= $this->include('dashboardadministrator') ?>
<div class="board-wrap">
    <div class="dataonly">
        <?php if(isset($rekening)) : ?>
    <table>
        <tr>
            <td style="font-weight: bold;">Nama Sekolah</td>
            <td>: <?= $rekening[0]['nama_sekolah']?></td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Nama Pemilik Rekening</td>
            <td>: <?= $rekening[0]['nama_pemilik_rekening']?></td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Nama Bank</td>
            <td>: <?= $rekening[0]['nama_bank']?></td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Nomor Rekening</td>
            <td>: <?= $rekening[0]['nomor_rekening']?></td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Nama Kepala Sekolah</td>
            <td>: <?= $rekening[0]['nama_kepsek']?></td>
        </tr>
        <tr>
            <td style="font-weight: bold;">NIM</td>
            <td>: <?= $rekening[0]['nim_kepsek']?></td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Nama Bendahara</td>
            <td>: <?= $rekening[0]['nama_bendahara']?></td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Nomor Whatsapp</td>
            <td>: <?= $rekening[0]['phonenumber']?></td>
        </tr>
        <tr>
            <td></td>
            <td><a class="tombol primary-outline" href="/aturrekening/edit/<?= $rekening[0]['id']?>">Edit Data</a></td>
        </tr>        
    </table>
    <?php endif; ?>
    </div>
</div>

<?= $this->include('closing') ?>