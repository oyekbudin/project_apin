<?= $this->include('dashboardadministrator') ?>
<div id="modalTambah" class="black-board">
        <div class="pop">
            <div class="group-action"><h2 class="data-title">Detail Tagihan</h2><a onclick="history.back()"> <i class="i" onclick="offmodalTambah()">&#xe14c</i></a> </div>
            <div class="divider"></div>
            <span class="tombol green">DATA TAGIHAN</span>
    
            <form action="/tagihan/delete/#" method="post">
            <div class="datacontent" id="pembayaran">

            <?php
            $total_tagihan = 0;
            foreach ($tagihan as $t) {
            $total_tagihan += $t['sisa_tagihan'];
            }
            ?>
            <?php if(isset($tagihan)) : ?>
                        <table>
                            <tbody>
                                <tr>
                                    <td>NIS</td>
                                    <td>: <?= $tagihan[0]['nis'] ?></td>
                                </tr>
                                <tr>
                                    <td>Nama Siswa</td>
                                    <td>: <?= $tagihan[0]['nama_siswa'] ?></td>
                                </tr>
                                <tr>
                                    <td>Kelas</td>
                                    <td>: <?= $tagihan[0]['kelas'] ?></td>
                                </tr>                                
                            </tbody>
                        </table>
                    <?php endif; ?> 
<div class="tablemobile">
            <table class="mini">
                    <thead>
                        <tr>
                            <th>Jenis Infaq</th>
                            <th>Harga</th>
                            <th>Pembayaran</th>
                            <th>Sisa</th>
                        </tr>
                    </thead>                
                    <tbody>
                        <?php if(!empty($tagihan)) : ?>
                        <?php foreach ($tagihan as $t) : ?>
                        <tr>
                            <td style="text-align: center;"><?= $t['nama_infaq'] ?></td>
                            <td style="text-align: right;"><?= number_format($t['harga_infaq']) ?></td>
                            <td style="text-align: right;"><?= number_format($t['total_pembayaran']) ?></td>
                            <td style="text-align: right;"><?= number_format($t['sisa_tagihan']) ?></td>
                        </tr>
                        <?php endforeach; ?>
                        <tr class="primary">
                            <td colspan="3" style="text-align: center;">Total Tagihan</td>
                            <td style="text-align: right;"><?= number_format($total_tagihan) ?></td>
                        </tr>
                        <?php else : ?>
                            <tr>
                                <td colspan="2">Tidak ada data</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>   
                    </table>
                    </div>
            </div>
                <div class="divider"></div>
                <div class="group-action">
                <a class="tombol disable" onclick="history.back()">Close</a>
                </div>
        </form>
    </div>
</div>

<?= $this->include('closing') ?>