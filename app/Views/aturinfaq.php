<?= $this->include('dashboardadministrator') ?>
<div class="board-wrap">

<div class="group-action">
<button class="tombol green" onclick="onmodalTambah()">Tambah Jenis Infaq</button>
<!--button class="tombol secondary">Export PDF</button-->
<a href="<?= base_url('/export-pdf/infaq'); ?>" class="tombol secondary" target="_blank">Export PDF</a>
<!--div class="search"><span>Search :</span><input class="input" type="text" name="" id=""></div-->
<div class="search">
    
    <form method="GET" action="<?= base_url('aturinfaq'); ?>">
        <span>Search :</span>
    <div class="input">
    <input class="search" type="text" id="search" name="keyword" placeholder="Cari infaq" value="<?= isset($_GET['keyword']) ? $_GET['keyword'] : '' ?>" >
    <?php if ($keyword) : ?>
    <a href="<?= base_url('aturinfaq')?>"><i class="i">&#xE14C</i></a>
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
                <th>Nama Infaq</th>
                <th>Kelas</th>
                <th>Harga</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
            
<!--  data -->
            <?php if(!empty($datainfaq)) : ?>
            <?php 
            $startNumber = ($currentPage - 1) * $perpage + 1;
            $i = $startNumber;
            ?>
            <!--?php $i = 1; ?-->
            <?php foreach ($datainfaq as $infaq) : ?>
            <tr>
                <td><?= $i++ ; ?></td>
                <td style="text-align:left"><?= $infaq['name'] ?></td>
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

    <!-- pagination -->
    <?= $this->include('pagination') ?>


    </div>


<!-- Modal -->
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
                                <option value="7" <?= set_value('kelas') == "7" ? "selected" : "" ?>>7</option>
                                <option value="8" <?= set_value('kelas') == "8" ? "selected" : "" ?>>8</option>
                                <option value="9" <?= set_value('kelas') == "9" ? "selected" : "" ?>>9</option>
                                <option value="78" <?= set_value('kelas') == "78" ? "selected" : "" ?>>7 dan 8</option>
                                <option value="79" <?= set_value('kelas') == "79" ? "selected" : "" ?>>7 dan 9</option>
                                <option value="89" <?= set_value('kelas') == "89" ? "selected" : "" ?>>8 dan 9</option>
                                <option value="789" <?= set_value('kelas') == "789" ? "selected" : "" ?>>7, 8 dan 9</option>
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