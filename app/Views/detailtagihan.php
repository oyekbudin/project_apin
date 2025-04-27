<?= $this->include('dashboardadministrator') ?>
<div id="modalTambah" class="black-board">
        <div class="pop">
            <div class="group-action"><h2 class="data-title">Detail Tagihan</h2><a href="<?= base_url('tagihan') ?>"> <i class="i" onclick="offmodalTambah()">&#xe14c</i></a> </div>
            <div class="divider"></div>
            <span class="tombol green">DATA TAGIHAN</span>
    
            <form action="/tagihan/delete/#" method="post">
            <div class="datacontent" id="pembayaran">
            <table>                
                    <tbody>
                        <?php if(!empty($tagihan)) : ?>
                        <?php foreach ($tagihan as $t) : ?>
                        <tr>
                            <td><?= $t['nama_infaq'] ?></td>
                            <td><?= number_format($t['nominal'])  ?></td>
                        </tr>
                        <?php endforeach; ?>
                        <tr class="danger">
                            <td>Total Tagihan</td>
                            <td><?= number_format($t['total']) ?></td>
                        </tr>
                        <?php else : ?>
                            <tr>
                                <td colspan="2">Tidak ada data</td>
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