<?= $this->include('dashboardadministrator') ?>
<div id="modalTambah" class="black-board">
        <div class="pop">
        <?php if (!empty($tagihan)) : ?>
            <?php $first = reset($tagihan); ?>
            <div class="group-action"><h2 class="data-title">Kartu Infaq</h2><a href="<?= base_url('tagihan') ?>"> <i class="i" onclick="offmodalTambah()">&#xe14c</i></a> </div>
        
            <div class="divider"></div>
            <span class="tombol green">
            NIS : <?= $first['nis'] ?> <br>
            Nama : <?= $first['nama_siswa'] ?> <br>
            Kelas : <?= $first['kelas'] ?>
            </span>
        <?php endif; ?>
            <form action="#" method="post">
            <div class="datacontent">
                <table>
                    <thead>
                        <tr>
                            <th>Nama Infaq</th>
                            <th>Biaya</th>
                            <th>Telah Dibayarkan</th>
                            <th>Sisa Tagihan</th>
                            <th>Tanggal Pembayaran</th>
                        </tr>
                    </thead>
                
                    <tbody>
                        <?php if(!empty($tagihan)) : ?>
                        <?php foreach ($tagihan as $t) : ?>
                        <tr>
                            <td style="text-align: left; padding-left: 10px;"><?= $t['nama_infaq'] ?></td>
                            <td><?= number_format($t['harga'])  ?></td>
                            <td><?= number_format($t['nominal'])  ?></td>
                            <td><?= number_format($t['sisa_pembayaran']) ?></td>
                            <td><?= !empty($t['last_payment_date']) ? date('d-m-Y', strtotime($t['last_payment_date'])) : '-' ?></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="5">Tidak ada data</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>   
                    </table>
            </div>
                <div class="divider"></div>
                <div class="group-action">
                <a class="tombol disable" href="<?= base_url('tagihan') ?>">Close</a>
                </div>
        </form>
    </div>
</div>

<?= $this->include('closing') ?>