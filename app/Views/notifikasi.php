<?= $this->include('dashboardadministrator') ?>
<div class="board-wrap">
<div class="group-action-tombol">
<button class="tombol secondary" onclick="history.back()">Kembali</button>
<a class="tombol red" href="<?= base_url('pembayaran/notifikasi/error') ?>" >Log Error Pembayaran</a>
</div>
<div class="divider"></div>
<div class="tablemobile">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Order ID</th>
                <th>Waktu transaksi</th>
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Total pembayaran</th>
                <th>Status</th>                
                <th>Jenis pembayaran</th>     
            </tr>
        </thead>
        <tbody>
            <?php if($notifikasi) :
                $i = 1;
                foreach($notifikasi as $n) : ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= $n['order_id'] ?></td>
                <td><?= $n['waktu_transaksi'] ?></td>
                <td><?= $n['nis'] ?></td>
                <td><?= $n['nama_siswa'] ?></td>
                <td><?= $n['kelas'] ?></td>
                <td><?= $n['total_nominal'] ?></td>
                <td><?= $n['status'] ?></td>
                <td><?= $n['metode_pembayaran'] ?></td>
            </tr>
                <?php endforeach; ?>
            <?php else : ?>
            <tr>
                <td colspan="9">Notifikasi akan ditampilkan di sini</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table> 
    </div>
    </div>
<!-- Modal -->
<?= $this->include('closing') ?>