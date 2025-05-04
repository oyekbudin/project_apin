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
                <td><?= str_replace(['{', '}', '"'], '',$infaq['kelas']) ?></td>
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
    <form action="/aturinfaq/save" method="post" id="myForm">
            <table>
                    <tbody>
                        <tr>
                            <td>Nama Jenis Infaq</td>
                            <td>
                                <input class="input" type="text" name="name" id="inputname" value="<?= old('name') ?>" placeholder="Nama Jenis Infaq" required oninvalid="this.setCustomValidity('Nama jenis infaq harus diisi')" oninput="this.setCustomValidity('')">
                                <span class="txtdanger data-subtitle"><?= session()->getFlashdata('errors') ['name'] ?? '' ?></span>
                            </td>
                        </tr>
                        
                        <tr>
                            <td>Harga</td>
                            <td><input class="input" type="number" name="harga" id="inputharga" value="<?= old('harga') ?>" placeholder="Harga" required oninvalid="this.setCustomValidity('Harga harus diisi')" oninput="this.setCustomValidity('')">
                            <span class="txtdanger data-subtitle"><?= session()->getFlashdata('errors') ['harga'] ?? '' ?></span></td>
                        </tr>
                        <tr>
                            <td>Kelas</td>
                            
                            <!--select class="input" name="kelas" id="inputkelas" required oninvalid="this.setCustomValidity('Pilih kelas')" oninput="this.setCustomValidity('')">
                                <option value="">Pilih Kelas</option>
                                <option value="7" <//?= old('kelas') == '7' ? 'selected' : '' ?>>7</option>
                                <option value="8" <//?= old('kelas') == '8' ? 'selected' : '' ?>>8</option>
                                <option value="9" <//?= old('kelas') == '9' ? 'selected' : '' ?>>9</option>
                                <option value="78" <//?= old('kelas') == '78' ? 'selected' : '' ?>>7 dan 8</option>
                                <option value="79" <//?= old('kelas') == '79' ? 'selected' : '' ?>>7 dan 9</option>
                                <option value="89" <//?= old('kelas') == '89' ? 'selected' : '' ?>>8 dan 9</option>
                                <option value="789" <//?= old('kelas') == '789' ? 'selected' : '' ?>>7, 8 dan 9</option>
                            </select-->
                           <td>
                            
                            <?php foreach ($kelas as $k) : ?>
                                <div class="cbkelas">
                                    <input class="" type="checkbox" name="kelas_id[]" id="<?= $k['id'] ?>" value="<?= $k['id'] ?>">
                                    <label for="<?= $k['id'] ?>"><?= $k['nama'] ?></label><br>
                                </div>
                            <?php endforeach ?>
                            <span class="txtdanger data-subtitle"><?= session()->getFlashdata('errors') ['kelas_id'] ?? '' ?></span>
                           </td>
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