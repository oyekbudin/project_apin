<?= $this->include('dashboardadministrator') ?>

    <h2>List Pembayaran</h2>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Nama Infaq</th>
                <th>Nominal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pembayaran as $row) : ?>
            <tr>
                <td><?= $row['date'] ?></td>
                <td><?= $row['nis'] ?></td>
                <td><?= $row['nama_siswa'] ?></td>
                <td><?= $row['kelas'] ?></td>
                <td><?= $row['nama_infaq'] ?></td>
                <td><?= $row['nominal'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Tambah Pembayaran</h2>
    <?php if(isset($validation)) :?>
        <span><?= $validation->listErrors() ?></span>
    <?php endif;?>
    <form action="/pembayaran/save" method="post">
        <input type="text" name="idsiswa" id="inputidsiswa" value="<?= set_value('idsiswa') ?>" placeholder="idsiswa">
        <input type="text" name="idinfaq" id="inputidinfaq" value="<?= set_value('idinfaq') ?>" placeholder="idinfaq">
        <input type="text" name="nominal" id="inputnominal" value="<?= set_value('nominal') ?>" placeholder="nominal">
        <button type="submit">Tambah Pembayaran</button>
    </form>

    <?= $this->include('closing') ?>