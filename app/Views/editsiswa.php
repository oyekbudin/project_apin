<?= $this->include('dashboardadministrator') ?>
<div id="modalTambah" class="black-board">
        <div class="pop">
            <div class="group-action"><h2 class="data-title">Ubah Data Siswa</h2><a onclick="history.back()"> <i class="i" onclick="offmodalTambah()">&#xe14c</i></a> </div>
            <div class="divider"></div>
            <span class="tombol green">DATA SISWA</span>

    <form action="/atursiswa/update/<?= $siswa['id']?>" method="post">
    <table>
                    <tbody>
                        <tr>
                            <td>Nama Siswa</td>
                            <td>
                                <input class="input" type="text" name="name" id="inputname" value="<?= $siswa['name'] ?>" placeholder="Nama Siswa" required oninvalid="this.setCustomValidity('Nama siswa harus diisi')" oninput="this.setCustomValidity('')">
                                <span class="txtdanger data-subtitle"><?= session()->getFlashdata('errors') ['name'] ?? '' ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>NIS</td>
                            <td><input class="input" type="text" name="nis" id="inputnis" value="<?= $siswa['nis'] ?>" placeholder="NIS" required oninvalid="this.setCustomValidity('NIS harus diisi')" oninput="this.setCustomValidity('')">
                            <span class="txtdanger data-subtitle"><?= session()->getFlashdata('errors') ['nis'] ?? '' ?></span></td>
                        </tr>
                            <td>Kelas</td>
                            <td><select class="input" name="kelas" id="inputkelas" value="<?= $siswa['kelas'] ?>">
                                <option value="7" <?= $siswa['kelas'] == "7" ? "selected" : "" ?>>7</option>
                                <option value="8" <?= $siswa['kelas'] == "8" ? "selected" : "" ?>>8</option>
                                <option value="9" <?= $siswa['kelas'] == "9" ? "selected" : "" ?>>9</option>
                            </select></td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td><select class="input" name="gender" id="inputgender" value="<?= $siswa['gender'] ?>">
                                <option value="L" <?= $siswa['gender'] == "L" ? "selected" : "" ?>>Laki-laki</option>
                                <option value="P" <?= $siswa['gender'] == "P" ? "selected" : "" ?>>Perempuan</option>
                            </select></td>
                        </tr>
                        <tr>
                            <td>No Whatsapp</td>
                            <td><input class="input" type="text" name="phonenumber" id="inputphonenumber" value="<?= $siswa['phonenumber'] ?>" placeholder="Nomor Whatsapp" required oninvalid="this.setCustomValidity('Nomor whatsapp harus diisi')" oninput="this.setCustomValidity('')">
                            <span class="txtdanger data-subtitle"><?= session()->getFlashdata('errors') ['phonenumber'] ?? '' ?></span></td>
                        </tr>
                    </tbody>
                </table>
                <div class="divider"></div>
                <div class="group-action">
                <a class="tombol disable" onclick="history.back()">Close</a>
                <button class="tombol primary" type="submit">Simpan</button>
                </div>
    </form>
    </div>
</div>

<?= $this->include('closing') ?>