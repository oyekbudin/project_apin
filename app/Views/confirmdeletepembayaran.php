<?= $this->include('dashboardadministrator') ?>
<div id="modalTambah" class="black-board">
        <div class="pop">
            <div class="group-action"><h2 class="data-title">Apakah anda yakin ingin menghapus data berikut?</h2><a href="<?= base_url('registeradministrator') ?>"> <i class="i" onclick="offmodalTambah()">&#xe14c</i></a> </div>
            <div class="divider"></div>
            <span class="tombol green">DATA USER</span>
    
    <form action="/pembayaran/delete/<?= $pembayaran['id'] ?>" method="post">
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
                    </tbody>
                </table>
                <div class="divider"></div>
                <div class="group-action">
                <a class="tombol disable" href="<?= base_url('pembayaran') ?>">Batal</a>
                <button class="tombol danger" type="submit">Hapus</button>
                </div>
    </form>
    </div>
</div>

<?= $this->include('closing') ?>