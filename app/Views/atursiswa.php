<?= $this->include('dashboardadministrator') ?>
<div class="board-wrap">
<div class="group-action">
<button class="tombol green" onclick="onmodalTambah()">Tambah Siswa</button>
<a href="<?= base_url('/export-pdf'); ?>" class="tombol secondary" target="_blank">Export PDF</a>
<div class="search">
    
    <form method="GET" action="<?= base_url('atursiswa'); ?>">
        <span>Search :</span>
    <div class="input">
    <input type="text" id="search" name="keyword" placeholder="Cari siswa" value="<?= isset($_GET['keyword']) ? $_GET['keyword'] : '' ?>" >
    <?php if ($keyword) : ?>
    <a href="<?= base_url('atursiswa')?>"><i class="i">&#xE14C</i></a>
    <?php endif; ?>
    </div>
</form>
</div>

</div>
<div class="divider"></div>

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
                    <a class="tombol warning-outline" href="/atursiswa/edit/<?= $siswa['id'] ?>">Edit</a>
                    <a class="tombol danger-outline" href="/atursiswa/confirmdelete/<?= $siswa['id'] ?>">Hapus</a>
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

    <!-- pagination -->

    <div class="divider"></div>
    <?php if (!$keyword) : ?>
    <div class="group-action data-subtitle" id="pagination">
        <?php
        $start = ($currentPage - 1) * $perpage + 1;
        $end = min($start + $perpage - 1, $total);
        ?>
        <span>Showing <?= $start ?> to <?= $end ?> of <?= $total ?> entries</span>
        
        <ul class="pagination ">
        <?php if ($currentPage > 1): ?>
        <li><a href="?page=<?= $currentPage - 1 ?>">Prev</a></li>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <li><a href="?page=<?= $i ?>" class="<?= ($i == $currentPage) ? 'active' : '' ?>"><?= $i ?></a></li>
    <?php endfor; ?>

    <?php if ($currentPage < $totalPages): ?>
        <li><a href="?page=<?= $currentPage + 1 ?>">Next</a></li>
    <?php endif; ?>
        </ul>
    </div>
</div>
<?php endif; ?>

<!-- Modal -->

    <div id="modalTambah" class="black-board">
        <div class="pop">
            <div class="group-action"><h2 class="data-title">Tambah Siswa</h2><i class="i" onclick="offmodalTambah()">&#xe14c</i></div>
            <div class="divider"></div>
            <span class="tombol green">DATA SISWA</span>
            <form action="/atursiswa/save" method="post">
                <table>
                    <tbody>
                        <tr>
                            <td>Nama Siswa</td>
                            <td>
                                <input class="input" type="text" name="name" id="inputname" value="<?= set_value('name') ?>" placeholder="Nama Siswa">
                                <span class="txtdanger data-subtitle"><?= isset($validation) ? $validation->getError('name') : "" ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>NIS</td>
                            <td><input class="input" type="text" name="nis" id="inputnis" value="<?= set_value('nis') ?>" placeholder="NIS">
                            <span class="txtdanger data-subtitle"><?= isset($validation) ? $validation->getError('nis') : "" ?></span></td>
                        </tr>
                            <td>Kelas</td>
                            <!--td><input class="input" type="text" name="kelas" id="inputkelas" value="" placeholder="Kelas">
                            </td-->
                            <td><select class="input" name="kelas">
                                <option value="">Pilih Kelas</option>
                                <option value="7" <?= set_value('kelas') == "7" ? "selected" : "" ?>>7</option>
                                <option value="8" <?= set_value('kelas') == "8" ? "selected" : "" ?>>8</option>
                                <option value="9" <?= set_value('kelas') == "9" ? "selected" : "" ?>>9</option>
                            </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <!--td><input class="input" type="text" name="gender" id="inputgender" value="" placeholder="Jenis Kelamin">
                            </td-->
                            <td><select class="input" name="gender" id="inputgender" value="<?= set_value('gender') ?>">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select></td>
                        </tr>
                        <tr>
                            <td>No Whatsapp</td>
                            <td><input class="input" type="text" name="phonenumber" id="inputphonenumber" value="<?= set_value('phonenumber') ?>" placeholder="Nomor Whatsapp">
                            <span class="txtdanger data-subtitle"><?= isset($validation) ? $validation->getError('phonenumber') : "" ?></span></td>
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

<!--iframe src=" base_url('/export-pdf'); " width="100%" height="600px"></iframe-->

<?= $this->include('closing') ?>


