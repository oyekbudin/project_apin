<?= $this->include('dashboardadministrator') ?>
<div class="board-wrap">
    <div class="dataonly">
        <?php if(isset($rekening)) : ?>
    <table>
        <tr>
            <td style="font-weight: bold;">Nama Sekolah</td>
            <td>: <?= $rekening['nama_sekolah']?></td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Nama Pemilik Rekening</td>
            <td>: <?= $rekening['nama_pemilik_rekening']?></td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Nama Bank</td>
            <td>: <?= $rekening['nama_bank']?></td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Nomor Rekening</td>
            <td>: <?= $rekening['nomor_rekening']?></td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Nama Kepala Sekolah</td>
            <td>: <?= $rekening['nama_kepsek']?></td>
        </tr>
        <tr>
            <td style="font-weight: bold;">NIM</td>
            <td>: <?= $rekening['nim_kepsek']?></td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Nama Bendahara</td>
            <td>: <?= $rekening['nama_bendahara']?></td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Nomor Whatsapp</td>
            <td>: <?= $rekening['phonenumber']?></td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="td-action">
                <a class="tombol primary-outline" href="/aturrekening/edit/<?= $rekening['id']?>">Edit Data</a></td>
        </div></tr>        
    </table>
    <?php endif; ?>
    </div>
</div>

<?= $this->include('closing') ?>