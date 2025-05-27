<?= $this->include('dashboardadministrator') ?>
<div class="board-wrap">
<div class="group-action">
<button class="tombol green" onclick="onmodalTambah()">Tambah Siswa</button>
<a href="<?= base_url('/export-pdf'); ?>" class="tombol secondary" target="_blank">Export PDF</a>
<div class="search">
    
    <form method="GET" action="<?= base_url('atursiswa'); ?>">
        <span>Search :</span>
    <div class="input">
    <input class="search" type="text" id="search" name="keyword" placeholder="Cari siswa" value="<?= isset($_GET['keyword']) ? $_GET['keyword'] : '' ?>" >
    <?php if ($keyword) : ?>
    <a href="<?= base_url('atursiswa')?>"><i class="i">&#xE14C</i></a>
    <?php endif; ?>
    </div>
</form>
</div>

</div>
<div class="divider"></div>
<div class="tablemobile">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>NIS</th>
                <th>Jenis Kelamin</th>
                <th>Kelas</th>
                <th>Nomor Whatsapp</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($datasiswa)) : ?>
            <?php
            $startNumber = ($currentPage - 1) * $perpage + 1;
            $i = $startNumber;
            ?>
            <?php foreach ($datasiswa as $siswa) : ?>
            <tr>
                <td><?= $i++ ; ?></td>
                <td style="text-align:left"><?= $siswa['name'] ?></td>
                <td><?= $siswa['nis'] ?></td>
                <td><?= $siswa['gender'] ?></td>
                <td><?= $siswa['kelas'] ?></td>
                <td><?= $siswa['phonenumber'] ?></td>
                <td>
                    <div class="td-action">
                    <a class="tombol warning-outline" href="/atursiswa/edit/<?= $siswa['nis'] ?>">Edit</a>
                    <a class="tombol danger-outline" href="/atursiswa/confirmdelete/<?= $siswa['nis'] ?>">Hapus</a>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="7">Tidak ada data</td>
                </tr>
                <?php endif; ?>
        </tbody>
    </table> 
    </div>
    <!-- pagination -->
    <?= $this->include('pagination') ?>
    </div>
<!-- Modal -->

    <div id="modalTambah" class="black-board">
        <div class="pop">
            <div class="group-action"><h2 class="data-title">Tambah Siswa</h2><i class="i" onclick="offmodalTambah()">&#xe14c</i></div>
            <div class="divider"></div>
            <form action="/atursiswa/save" method="post">
            <div class="overflow-content">
            <div class="tombol green">DATA SISWA</div>
            
                <table>
                    <tbody>
                        <tr>
                            <td>Nama Siswa</td>
                            <td>
                                <input class="input" type="text" name="name" id="inputname" value="<?= old('name') ?>" placeholder="Nama Siswa" required oninvalid="this.setCustomValidity('Nama Siswa harus diisi')" oninput="this.setCustomValidity('')">
                                <br> <span class="txtdanger data-subtitle"><?= session()->getFlashdata('errors') ['name'] ?? '' ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>NIS</td>
                            <td><input class="input" type="text" name="nis" id="inputnis" value="<?= old('nis') ?>" placeholder="NIS" required oninvalid="this.setCustomValidity('NIS harus diisi')" oninput="this.setCustomValidity('')">
                            <br> <span class="txtdanger data-subtitle"><?= session()->getFlashdata('errors') ['nis'] ?? '' ?></span></td>
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
                            <br> <span class="txtdanger data-subtitle"><?= session()->getFlashdata('errors') ['phonenumber'] ?? '' ?></span></td>
                        </tr>
                    </tbody>
                </table>
                
                <div class="divider"></div>
                <div class="group-action">
                <a class="tombol disable" onclick="offmodalTambah()">Close</a>
                <button class="tombol primary" type="submit">Simpan</button>
                </div>
            </div>
            </form>
        </div>
    </div>
<?= $this->include('closing') ?>