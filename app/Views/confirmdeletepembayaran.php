<?= $this->include('dashboardadministrator') ?>
<div id="modalTambah" class="black-board">
        <div class="pop">
            <div class="group-action"><h2 class="data-title">Detail Pembayaran <?= $pembayaran['nama_siswa'] ?></h2><a href="<?= base_url('pembayaran') ?>"> <i class="i" onclick="offmodalTambah()">&#xe14c</i></a> </div>
            <div class="divider"></div>
            <span class="tombol green">DATA PEMBAYARAN</span>
    
            <form action="/pembayaran/delete/<?= $pembayaran['id'] ?>" method="post">
            <div class="datacontent">
                <table>
                    <tbody>
                        <tr>
                            <td>Tanggal</td>
                            <td>: <?= $pembayaran['date'] ?></td>
                        </tr>
                            <td>NIS</td>
                            <td>: <?= $pembayaran['nis'] ?></td>
                        </tr>
                        <tr>
                            <td>Nama Siswa</td>
                            <td>: <?= $pembayaran['nama_siswa'] ?></td>
                        </tr>
                        <tr>
                            <td>Kelas</td>
                            <td>: <?= $pembayaran['kelas'] ?></td>
                        </tr>
                        <tr>
                            <td>Nama Jenis Infaq</td>
                            <td>: <?= $pembayaran['nama_infaq'] ?></td>
                        </tr>
                        <tr>
                            <td>Nominal</td>
                            <td>: <?= $pembayaran['nominal'] ?></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>: <?= $pembayaran['status'] ?></td>
                        </tr>
                        <tr>
                            <td>Metode Pembayaran</td>
                            <td>: <?= $pembayaran['payment_method'] ?></td>
                        </tr>
                        <tr>
                            <td>Order id</td>
                            <td>: <?= $pembayaran['order_id'] ?></td>
                        </tr>
                        <tr>
                            <td>Tipe Pembayaran</td>
                            <td>: <?= $pembayaran['payment_type'] ?></td>
                        </tr>
                        <tr>
                            <td>Waktu Transaksi</td>
                            <td>: <?= $pembayaran['transaction_time'] ?></td>
                        </tr>
                        <tr>
                            <td>Status Fraud</td>
                            <td>: <?= $pembayaran['fraud_status'] ?></td>
                        </tr>
                        <tr>
                            <td>Token Snap</td>
                            <td>: <?= $pembayaran['snap_token'] ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
                <div class="divider"></div>
                <div class="group-action">
                <a class="tombol disable" href="<?= base_url('pembayaran') ?>">Close</a>
                <button class="tombol danger" type="submit" onclick="return confirm('Apakah anda yakin ingin menghapus data pembayaran ini?')">Hapus Pembayaran</button>
                </div>
        </form>
    </div>
</div>

<?= $this->include('closing') ?>