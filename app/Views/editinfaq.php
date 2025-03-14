<?= $this->include('dashboardadministrator') ?>
<div id="modalTambah" class="black-board">
        <div class="pop">
            <div class="group-action"><h2 class="data-title">Ubah Data Infaq</h2><a href="<?= base_url('aturinfaq') ?>"> <i class="i" onclick="offmodalTambah()">&#xe14c</i></a> </div>
            <div class="divider"></div>
            <span class="tombol green">DATA INFAQ</span>
    <form action="/aturinfaq/update/<?= $infaq['id']?>" method="post">
<table>
                    <tbody>
                        <tr>
                            <td>Nama Jenis Infaq</td>
                            <td>
                                <input class="input" type="text" name="name" id="inputname" value="<?= $infaq['name'] ?>" placeholder="Nama Jenis Infaq">
                                <span class="txtdanger data-subtitle"><?= isset($validation) ? $validation->getError('name') : "" ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Kelas</td>
                            <td><select class="input" name="kelas" id="inputkelas" value="<?= $infaq['kelas'] ?>">
                                <option value="<?= $infaq['kelas'] ?>"><?= $infaq['kelas'] ?></option>
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
                            <td><input class="input" type="text" name="harga" id="inputharga" value="<?= $infaq['harga'] ?>" placeholder="Harga">
                            <span class="txtdanger data-subtitle"><?= isset($validation) ? $validation->getError('harga') : "" ?></span></td>
                        </tr>
                    </tbody>
                </table>
                <div class="divider"></div>
                <div class="group-action">
                <a class="tombol disable" href="<?= base_url('aturinfaq') ?>">Close</a>
                <button class="tombol primary" type="submit">Simpan</button>
                </div>
    </form>
    </div>
</div>

<?= $this->include('closing') ?>