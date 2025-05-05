<?= $this->include('dashboardadministrator') ?>
<div id="modalTambah" class="black-board">
        <div class="pop">
            <div class="group-action"><h2 class="data-title">Apakah anda yakin ingin menghapus data berikut?</h2><a href="<?= base_url('aturinfaq') ?>"> <i class="i" onclick="offmodalTambah()">&#xe14c</i></a> </div>
            <div class="divider"></div>
            <span class="tombol green">DATA SISWA</span>

    <form action="/aturinfaq/delete/<?= $infaq[0]['id'] ?>" method="post">
    <table>
                    <tbody>
                        <tr>
                            <td>Nama Jenis Infaq</td>
                            <td>: <?= $infaq[0]['name'] ?></td>
                        </tr>
                            <td>Kelas</td>
                            <td>: <?= str_replace(['{', '}', '"'], '',$infaq[0]['kelas']) ?></td>
                        </tr>
                        <tr>
                            <td>Harga</td>
                            <td>: <?= $infaq[0]['harga'] ?></td>
                        </tr>
                    </tbody>
                </table>
                <div class="divider"></div>
                <div class="group-action">
                <a class="tombol disable" href="<?= base_url('aturinfaq') ?>">Batal</a>
                <button class="tombol danger" type="submit">Hapus</button>
                </div>
    </form>
    </div>
</div>

<?= $this->include('closing') ?>