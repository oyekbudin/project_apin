<?= $this->include('dashboardadministrator') ?>
<div class="board-wrap">
<div class="group-action">
<button class="tombol green" onclick="onmodalTambah()">Buat Tagihan</button>
<a href="<?= base_url('/export-pdf'); ?>" class="tombol secondary" target="_blank">Kirim Tagihan</a>
<div class="search">
    
    <form method="GET" action="<?= base_url('tagihan'); ?>">
        <span>Search :</span>
    <div class="input">
    <input class="search" type="text" id="search" name="keyword" placeholder="Cari siswa" value="<?= isset($_GET['keyword']) ? $_GET['keyword'] : '' ?>" >
    <?php if ($keyword) : ?>
    <a href="<?= base_url('tagihan')?>"><i class="i">&#xE14C</i></a>
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
            <?php if(!empty($siswa)) : ?>
            <?php
            $startNumber = ($currentPage - 1) * $perpage + 1;
            $i = $startNumber;
            ?>
            <?php foreach ($siswa as $s) : ?>
            <tr>
                <td><?= $i++ ; ?></td>
                <td style="text-align:left"><?= $s['name'] ?></td>
                <td><?= $s['nis'] ?></td>
                <td><?= $s['gender'] ?></td>
                <td><?= $s['kelas'] ?></td>
                <td><?= $s['phonenumber'] ?></td>
                <td>
                    <!--a class="tombol warning-outline" href="/atursiswa/edit/<//?= $siswa['id'] ?>">Edit</a-->
                    <a class="tombol orange-outline" href="/tagihan/daftartagihan/<?= $s['nis'] ?>">Lihat</a>
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
    <?= $this->include('pagination') ?>
    </div>

<!-- Modal -->

    <div id="modalTambah" class="black-board">
        <div class="pop">
            <div class="group-action"><h2 class="data-title">Pilih Infaq yang akan dibuat tagihan</h2><i class="i" onclick="offmodalTambah()">&#xe14c</i></div>
            <div class="divider"></div>
            <span class="tombol green">DATA INFAQ</span>
            <form action="/tagihan/save" method="post">
                <div class="datacontent" id="cb">
                    <?php if(!empty($infaq)) : ?>
                    <?php foreach ($infaq as $in) : ?>
                        <div class="cb"><input type="checkbox" name="" id="" value="<?= $in['id'] ?>"><label for=""><?= $in['name'] ?></label></div>
                    <?php endforeach; ?>
                    <?php else : ?>
                        <div class="cb">Tidak ada data</div>
                    <?php endif; ?>
                </div>
                <div class="divider"></div>
                <div class="group-action">
                <a class="tombol disable" onclick="offmodalTambah()">Close</a>
                <button class="tombol primary" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
<!--iframe src=" base_url('/export-pdf'); " width="100%" height="600px"></iframe-->

<script>
    document.querySelectorAll(".cb").forEach(div =>{
        let checkbox = div.querySelector("input");
        div.addEventListener("click", function() {
            checkbox.checked = ! checkbox.checked;
            this.classList.toggle("selected", checkbox.checked);
        });
    });
</script>
<?= $this->include('closing') ?>



