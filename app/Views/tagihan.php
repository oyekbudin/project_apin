<?= $this->include('dashboardadministrator') ?>
<div class="board-wrap">
<div class="group-action-tombol">
<button class="tombol secondary" onclick="history.back()">Kembali</button>

<a href="<?= base_url('/pdf/tagihan/' . $datatagihan[0]['id_tagihan'] ); ?>" class="tombol primary" target="_blank">Export Tagihan</a>
<a href="<?= base_url('/pdf/tagihan-siswa/' . $datatagihan[0]['id_tagihan'] ); ?>" class="tombol primary" target="_blank">Export Tagihan Per Siswa</a>
<a href="<?= base_url('/#'); ?>" class="tombol green" target="_blank">Kirim Tagihan</a>

</div>
<div class="divider"></div>
<div class="tablemobile">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($datatagihan)) : ?>
            <?php
            $i = 1;
            ?>
            <?php foreach ($datatagihan as $t) : ?>
            <tr>
                <td><?= $i++ ; ?></td>
                <td><?= $t['nis'] ?></td>
                <td style="text-align:left"><?= $t['nama_siswa'] ?></td>
                <td><?= $t['kelas'] ?></td>
                <td>
                    <a class="tombol danger-outline" href="/tagihan/requestdetail?id=<?= $t['nis'] ?>&request=<?= $t['id_tagihan'] ?>">Detail Tagihan</a>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="6">Tidak ada data</td>
                </tr>
                <?php endif; ?>
        </tbody>
    </table> 
    </div>
    <!-- pagination -->
    </div>
<!-- Modal -->

    <div id="modalTambah" class="black-board">
        <div class="pop">
            <div class="group-action"><h2 class="data-title">Tambah Tagihan</h2><i class="i" onclick="offmodalTambah()">&#xe14c</i></div>
            <div class="divider"></div>
            <span class="tombol green">DATA TAGIHAN</span>
            <form action="/tagihan/save" method="post">
                <table>
                    <tbody>
                        <tr>
                            <td>Nama Siswa</td>
                            <td>
                                <input class="input" type="text" name="name" id="inputname" value="<?= old('name') ?>" placeholder="Nama Siswa" required oninvalid="this.setCustomValidity('Nama Siswa harus diisi')" oninput="this.setCustomValidity('')">
                                <span class="txtdanger data-subtitle"><?= session()->getFlashdata('errors') ['name'] ?? '' ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>NIS</td>
                            <td><input class="input" type="text" name="nis" id="inputnis" value="<?= old('nis') ?>" placeholder="NIS" required oninvalid="this.setCustomValidity('NIS harus diisi')" oninput="this.setCustomValidity('')">
                            <span class="txtdanger data-subtitle"><?= session()->getFlashdata('errors') ['nis'] ?? '' ?></span></td>
                        </tr>
                            <td>Kelas</td>
                            <td><select class="input" name="kelas" required oninvalid="this.setCustomValidity('Pilih kelas')" oninput="this.setCustomValidity('')">
                                <option value="">Pilih Kelas</option>
                                <option value="7" <?= old('kelas') == '7' ? 'selected' : '' ?>>7</option>
                                <option value="8" <?= old('kelas') == '8' ? 'selected' : '' ?>>8</option>
                                <option value="9" <?= old('kelas') == '9' ? 'selected' : '' ?>>9</option>
                            </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td><select class="input" name="gender" id="inputgender" required oninvalid="this.setCustomValidity('Pilih jenis kelamin')" oninput="this.setCustomValidity('')">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L" <?= old('gender') == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                                <option value="P" <?= old('gender') == 'P' ? 'selected' : '' ?>>Perempuan</option>
                            </select></td>
                        </tr>
                        <tr>
                            <td>No Whatsapp</td>
                            <td><input class="input" type="text" name="phonenumber" id="inputphonenumber" value="<?= old('phonenumber') ?>" placeholder="Nomor Whatsapp" required oninvalid="this.setCustomValidity('Nomor Whatsapp harus diisi')" oninput="this.setCustomValidity('')">
                            <span class="txtdanger data-subtitle"><?= session()->getFlashdata('errors') ['phonenumber'] ?? '' ?></span></td>
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