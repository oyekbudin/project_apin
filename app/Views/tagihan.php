<?= $this->include('dashboardadministrator') ?>
<div class="board-wrap">
<div class="group-action-tombol">
<button class="tombol secondary" onclick="history.back()">Kembali</button>

<a href="<?= base_url('/pdf/tagihan/' . $datatagihan[0]['id_tagihan'] ); ?>" class="tombol primary" target="_blank">Export Tagihan</a>
<a href="<?= base_url('/pdf/tagihan-siswa/' . $datatagihan[0]['id_tagihan'] ); ?>" class="tombol primary" target="_blank">Export Tagihan Per Siswa</a>
<a href="<?= base_url('/tagihan/aktif/'. $datatagihan[0]['id_tagihan'] );?>" class="tombol green">Aktifkan Tagihan</a>
<button class="tombol green" onclick="onmodalTambah()">Kirim Tagihan</button>
<a href="<?= base_url('tagihan/riwayat_pengiriman') ?>" class="tombol secondary">Riwayat Pengiriman</a>

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
                    <div class="td-action">
                    <a class="tombol primary-outline" href="/tagihan/requestdetail?id=<?= $t['nis'] ?>&request=<?= $t['id_tagihan'] ?>">Detail Tagihan</a>
                    </div>
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
            <div class="group-action"><h2 class="data-title">Kirim Tagihan</h2><a onclick="offmodalTambah()"> <i class="i" onclick="offmodalTambah()">&#xe14c</i></a> </div>
            <div class="divider"></div>
            <div class="overflow-content">
            <form action="/tagihan/kirim_tagihan" method="post">
                
            <div class="tombol green">DATA PESAN</div>
   
    <table id="">
                    <tbody>
                        <tr>
                            <td>Kalimat Pembuka</td>
                            <td id="textArea">
                                <textarea name="header" id="" value="<?= old('header') ?>" placeholder="Salam, maksud dan tujuan, dsb." required oninvalid="this.setCustomValidity('Kalimat pembuka harus diisi')" oninput="this.setCustomValidity('')"></textarea>
                                
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><span class="txtdanger data-subtitle"><?= session()->getFlashdata('errors') ['header'] ?? '' ?></span></td>
                        </tr>
                        <tr>
                            <td>Kalimat Penutup</td>
                            <td id="textArea">
                                <textarea name="footer" id="" value="<?= old('footer') ?>" placeholder="Terima kasih, info pembayaran, dsb." required oninvalid="this.setCustomValidity('Kalimat penutup harus diisi')" oninput="this.setCustomValidity('')"></textarea>
                                
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><span class="txtdanger data-subtitle"><?= session()->getFlashdata('errors') ['footer'] ?? '' ?></span></td>
                        </tr>
                        <tr>
                            <td>Pilih Penerima</td>
                            <td>
                                <span class="txtdanger data-subtitle"><?= session()->getFlashdata('errors') ['siswa_id'] ?? '' ?></span>                           
                            <?php foreach ($penerima as $p) : ?>
                                <div class="cbkelas">
                                    <input class="" type="checkbox" name="siswa_id[]" id="<?= $p['nis'] ?>" value="<?= $p['nis'] ?>">
                                    <label for="<?= $p['nis'] ?>"><?= $p['name'] ?> - <?= $p['phonenumber'] ?></label><br>
                                </div>
                            <?php endforeach ?>                           
                           </td>
                        </tr>
                        
                    </tbody>
                </table>
                <div class="divider"></div>
                <div class="group-action">
                <a class="tombol disable" onclick="offmodalTambah()">Close</a>
                <button class="tombol primary" type="submit">Kirim</button>
                </div>
                
    </form>
    </div>
    </div>
</div>
<?= $this->include('closing') ?>