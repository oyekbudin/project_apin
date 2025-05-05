<?= $this->include('dashboardadministrator') ?>
<div class="board-wrap">
<div class="group-action">
<button class="tombol green" onclick="onmodalTambah()">Buat Tagihan</button>
<a href="<?= base_url('/export-pdf'); ?>" class="tombol secondary" target="_blank">Kirim Tagihan</a>

</div>
<div class="divider"></div>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>Total Tagihan</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($tagihan)) : ?>            
            <?php foreach ($tagihan as $t) : ?>
            <tr>
                <td><?= $t['tanggal'] ?></td>
                <td><?= $t['nis'] ?></td>
                <td style="text-align:left"><?= $t['nama_siswa'] ?></td>
                <td><?= number_format($t['total'])  ?></td>
                <td>
                    <a class="tombol green-outline" href="<?= base_url('tagihan/lihatkartu/?nis=' .$t['nis']. '&kelas='.$t['kelas']) ?>">Lihat Kartu</a>
                    <a class="tombol orange-outline" href="/tagihan/detailtagihan/<?= $t['id'] ?>">Lihat Tagihan</a>
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
    </div>

<!-- Modal -->

    <div id="modalTambah" class="black-board">
    <div class="pop">
        <div class="group-action">
            <h2 class="data-title">Pilih Infaq yang akan dibuat tagihan</h2>
            <i class="i" onclick="offmodalTambah()">&#xe14c</i>
        </div>
        <div class="divider"></div>
        <span class="tombol green">DATA INFAQ</span>        
        <form action="/tagihan/buattagihan" method="post">
            <div class="datacontent" id="cb">
                <?php if (!empty($infaq)) : ?>
                    <?php foreach ($infaq as $in) : ?>
                        <div class="cb">
                            <input type="checkbox" name="infaq[]" id="<?= $in['id'] ?>" value="<?= $in['id'] ?>">
                            <label for="<?= $in['id'] ?>"><?= $in['name'] ?></label>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="cb">Tidak ada data</div>
                <?php endif; ?>
            </div>                
            <div class="divider"></div>
            <div class="group-action">
                <a  class="tombol disable" onclick="offmodalTambah()">Close</a>
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



