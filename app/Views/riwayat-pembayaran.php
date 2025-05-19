<?= $this->include('dashboard-walimurid') ?>

<?php $session = session(); 
            $name = $session->get('name');
            ?>
<?php 
$total_tagihan = 0;
if ($tagihan) {
foreach($tagihan as $t) {
    if($t['sisa_tagihan'] != 0) {
        $total_tagihan += $t['sisa_tagihan'];
    };
};
}
    ?>

<div class="grid-board">
    <div class="board-1">
        <div class="board-wrap primarylight">
        <div class="wrap-rekap">
            <div class="card-3 primarydark">
                <span class="data-subtitle">Sisa tagihan</span>
                <span class="data-title"> Rp <?= number_format($total_tagihan, 0, ',', '.') ?></span>                
            </div>
        </div>
        </div>
    </div>

    <div class="board-2">
        <div class="board-wrap">
        <h3>Catatan Pembayaran</h3>
        <div class="divider"></div>
            <div class="tablemobile">
                <table>
                    <tbody>
                        <?php if(!empty($pembayaran)) : ?>
                        <?php foreach($pembayaran as $p) : ?>
                        <tr>
                            <td><?= date('j F Y', strtotime($p['date'])) ?></td>
                            <td><?= $p['nama_infaq'] ?></td>
                            <td class="txtgreen"><?= 'Rp ' . number_format($p['nominal'], 0, ',', '.') ?></td>
                        </tr>
                        <?php endforeach ?>
                        <?php else : ?>
                        <tr>
                            <td colspan="3">Belum ada riwayat pembayaran</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->include('closing') ?>