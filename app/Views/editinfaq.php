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
                                <input class="input" type="text" name="name" id="inputname" value="<?= $infaq['name'] ?>" placeholder="Nama Jenis Infaq" required oninvalid="this.setCustomValidity('Nama jenis infaq harus diisi')" oninput="this.setCustomValidity('')">
                                <span class="txtdanger data-subtitle"><?= session()->getFlashdata('errors') ['name'] ?? '' ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Kelas</td>
                            <td><select class="input" name="kelas" id="inputkelas" value="<?= $infaq['kelas'] ?>">                                
                                <option value="7" <?= $infaq['kelas'] == "7" ? "selected" : "" ?>>7</option>
                                <option value="8" <?= $infaq['kelas'] == "8" ? "selected" : "" ?>>8</option>
                                <option value="9" <?= $infaq['kelas'] == "9" ? "selected" : "" ?>>9</option>
                                <option value="78" <?= $infaq['kelas'] == "78" ? "selected" : "" ?>>7 dan 8</option>
                                <option value="79" <?= $infaq['kelas'] == "79" ? "selected" : "" ?>>7 dan 9</option>
                                <option value="89" <?= $infaq['kelas'] == "89" ? "selected" : "" ?>>8 dan 9</option>
                                <option value="789" <?= $infaq['kelas'] == "789" ? "selected" : "" ?>>7, 8 dan 9</option>
                            </select></td>
                        </tr>
                        <tr>
                            <td>Harga</td>
                            <td><input class="input" type="text" name="harga" id="inputharga" value="<?= $infaq['harga'] ?>" placeholder="Harga" required oninvalid="this.setCustomValidity('Harga harus diisi')" oninput="this.setCustomValidity('')">
                            <span class="txtdanger data-subtitle"><?= session()->getFlashdata('errors') ['harga'] ?? '' ?></span></td>
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