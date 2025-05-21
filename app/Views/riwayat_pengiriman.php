<?= $this->include('dashboardadministrator') ?>
<div class="board-wrap">
<div class="group-action-tombol">
<button class="tombol secondary" onclick="history.back()">Kembali</button>
</div>
<div class="divider"></div>
<div class="tablemobile">
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Waktu Pengiriman</th>
                <th>Nama Penerima</th>
                <th>Nomor Penerima</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if($pesanwa) :
                $i = 1;
                foreach($pesanwa as $p) : ?>
                    <tr>
                        <td><?= $i ++ ?></td>
                        <td><?= $p['waktu_kirim'] ?></td>
                        <td><?= $p['nama_penerima'] ?></td>
                        <td><?= $p['nomor_penerima'] ?></td>
                        <td><?= $p['status'] ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
            <tr>
                <td colspan="5">Riwayat Pengiriman akan ditampilkan di sini</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table> 
    </div>
    </div>
<!-- Modal -->
<?= $this->include('closing') ?>