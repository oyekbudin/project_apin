<?= $this->include('dashboardadministrator') ?>
<div class="board-wrap">

<div class="group-action">
<button class="tombol green" onclick="onmodalTambah()">Tambah Jenis Infaq</button>
<button class="tombol secondary">Export PDF</button>
<div class="search"><span>Search :</span><input class="input" type="text" name="" id=""></div>
</div>
<div class="divider"></div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Infaq</th>
                <th>Kelas</th>
                <th>Harga</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
            
            <!-- -->
            <?php if(!empty($lihatdata)) : ?>
            <?php $i = 1; ?>
            <?php foreach ($lihatdata as $infaq) : ?>
            <tr>
                <td><?= $i++ ; ?></td>
                <td><?= $infaq['name'] ?></td>
                <td><?= $infaq['kelas'] ?></td>
                <td><?= $infaq['harga'] ?></td>
                <td>
                    <a class="tombol warning-outline" href="/aturinfaq/edit/<?= $infaq['id'] ?>">Edit</a>
                    <a class="tombol danger-outline" href="/aturinfaq/confirmdeleteinfaq/<?= $infaq['id'] ?>">Hapus</a>
                </td>
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

<div id="modalTambah" class="black-board">
    <div class="pop">
        <div class="group-action"><h2 class="data-title">Tambah Jenis Infaq</h2><i class="i" onclick="offmodalTambah()">&#xe14c</i></div>
        <div class="divider"></div>
        <span class="tombol green">DATA INFAQ</span>
    <form action="/aturinfaq/save" method="post">
            <table>
                    <tbody>
                        <tr>
                            <td>Nama Jenis Infaq</td>
                            <td>
                                <input class="input" type="text" name="name" id="inputname" value="<?= set_value('name') ?>" placeholder="Nama Jenis Infaq">
                                <span class="txtdanger data-subtitle"><?= isset($validation) ? $validation->getError('name') : "" ?></span>
                            </td>
                        </tr>
                            <td>Kelas</td>
                            <td><select class="input" name="kelas" id="inputkelas" value="<?= set_value('kelas') ?>">
                                <option value="">Pilih Kelas</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="78">7 dan 8</option>
                                <option value="79">7 dan 9</option>
                                <option value="89">8 dan 9</option>
                                <option value="789">7, 8 dan 9</option>
                            </select></td>
                        </tr>
                        <tr>
                            <td>Harga</td>
                            <td><input class="input" type="number" name="harga" id="inputharga" value="<?= set_value('harga') ?>" placeholder="Harga">
                            <span class="txtdanger data-subtitle"><?= isset($validation) ? $validation->getError('harga') : "" ?></span></td>
                        </tr>
                    </tbody>
                </table>
                <div class="divider"></div>
                <div class="group-action">
                <a class="tombol disable" onclick="offmodalTambah()">Close</a>
                <button class="tombol primary" type="submit">Simpan</button>
                </div>
    </form>

    </div>
    </div>
<?= $this->include('closing') ?>