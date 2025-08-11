<?= $this->include('dashboardadministrator') ?>
<div class="board-wrap">
<div class="group-action-tombol morerow">

<div class="tombolgroup noborder">
    <button class="tombol secondary" onclick="history.back()">Kembali</button>
    <a href="<?= base_url('/tagihan/aktif/'. $datatagihan[0]['id_tagihan'] );?>" class="tombol green">Aktifkan Tagihan</a>
    <button class="tombol secondary" onclick="onmodalFilter()">Filter & Urutkan</button>
    <a href="<?= base_url('tagihan/riwayat_pengiriman') ?>" class="tombol secondary">Riwayat Pengiriman</a>
</div>

<!--
<div class="tombolgroup secondary">
    <span id="selectedCount"></span>
    <a href="<?//= base_url('/pdf/tagihan/' . $datatagihan[0]['id_tagihan'] ); ?>" class="tombol primary" target="_blank">Export Tagihan</a>
    <a href="<?//= base_url('/pdf/tagihan-siswa/' . $datatagihan[0]['id_tagihan'] ); ?>" class="tombol primary" target="_blank">Export Tagihan Per Siswa</a>
    <button class="tombol green" onclick="onmodalTambah()">Kirim Tagihan</button>
</div>
-->
<div class="tombolgroup secondary">
    <span id="selectedCount"></span>
    <button id="export-tagihan" class="tombol primary">Export Tagihan</button>
    <button id="export-tagihan-siswa" class="tombol primary">Export Tagihan Per Siswa</button>
    <button class="tombol green" onclick="onmodalTambah()">Kirim Tagihan</button>
</div>

<form method="get">
    <div class="tombolgroup noborder">
        <input class="input" type="text" name="q" placeholder="Cari nama siswa..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
        <button type="submit" class="tombol secondary">Cari</button>
    </div>
</form>



</div>
<div class="divider"></div>

<?php
$result = [];

foreach ($tagihanbaru as $row) {
    $nis = $row['nis'];
    if (!isset($result[$nis])) {
        $result[$nis] = [
            'nis' => $nis,
            'nama_siswa' => $row['nama_siswa'],
            'kelas' => $row['kelas'],
            'id_tagihan' => $row['id_tagihan'],
            'total_sisa' => 0
        ];
    }
    $result[$nis]['total_sisa'] += $row['sisa_tagihan'];
}

?>

<div class="tablemobile">
    <table>
        <thead>
            <tr>
                <th>
                    <div class="cbkelas">
                        <input type="checkbox" id="selectAllSiswa">
                    </div> 
                </th>
                <!--th>No</th-->
                <th>NIS</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Total Tagihan</th>
                <th>Status</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody id="hasilcari">
    <?php
    //$i = 1;
    //$status_filter = $this->request->getGet('status') ?? [];

    $filteredResult = [];

    if (!empty($result)) {
        foreach ($result as $t) {
            $status = ($t['total_sisa'] == 0) ? "L" : "B";

            // Filter jika ada status_filter
            if (!empty($status_filter) && !in_array($status, $status_filter)) {
                continue;
            }

            // Filter kelas
            if (!empty($kelas_filter) && !in_array($t['kelas'], $kelas_filter)) {
                continue;
            }

            /* next
            if (!empty($cariNama)) {
            $filteredResult = array_filter($filteredResult, function($row) use ($cariNama) {
                return stripos($row->nama, $cariNama) !== false;
            });
            }*/

            $filteredResult[] = $t; // simpan yang lolos filter
        }
    }


    // --- Pencarian Nama ---
    $search_name = $_GET['q'] ?? '';
if (!empty($search_name)) {
    $filteredResult = array_filter($filteredResult, function($item) use ($search_name) {
        return stripos($item['nama_siswa'], $search_name) !== false;
    });
}

    // ===== SORTING =====
if (!empty($filteredResult) && !empty($urutkan)) {
    switch ($urutkan) {
        case 1: // Nama A-Z
            usort($filteredResult, function($a, $b) {
                return strcmp($a['nama_siswa'], $b['nama_siswa']);
            });
            break;

        case 2: // Nama Z-A
            usort($filteredResult, function($a, $b) {
                return strcmp($b['nama_siswa'], $a['nama_siswa']);
            });
            break;

        case 3: // Tagihan tertinggi
            usort($filteredResult, function($a, $b) {
                return $b['total_sisa'] <=> $a['total_sisa'];
            });
            break;

        case 4: // Tagihan terendah
            usort($filteredResult, function($a, $b) {
                return $a['total_sisa'] <=> $b['total_sisa'];
            });
            break;
    }
}

    if (!empty($filteredResult)) :
        foreach ($filteredResult as $t) :
            $status = ($t['total_sisa'] == 0) ? "L" : "B";
    ?>
        <tr>
            <td>
                <div class="cbkelas">
                    <input type="checkbox" id="<?= $t['nis'] ?>" value="<?= $t['nis'] ?>" class="listsiswa">
                </div> 
            </td>
            <!-- td><?//= $i++ ; ?></td-->
            <td><?= $t['nis'] ?></td>
            <td style="text-align:left"><?= $t['nama_siswa'] ?></td>
            <td><?= $t['kelas'] ?></td>
            <td><?= number_format($t['total_sisa']) ?></td>
            <td><?= ($status == "L") ? "Lunas" : "Belum Lunas" ?></td>
            <td>
                <div class="td-action">
                    <a class="tombol primary-outline" href="/tagihan/requestdetail?id=<?= $t['nis'] ?>&request=<?= $t['id_tagihan'] ?>">Detail Tagihan</a>
                </div>
            </td>
        </tr>
    <?php
        endforeach;
    else :
    ?>
        <tr>
            <td colspan="7" style="text-align:center;">Tidak ada data</td>
        </tr>
    <?php endif; ?>
</tbody>

    </table> 
    </div>
    <!-- pagination -->
    </div>


<!-- Modal kirim tagihan-->

<div id="modalTambah" class="black-board">
        <div class="pop">
            <div class="group-action"><h2 class="data-title">Kirim Tagihan</h2><a onclick="offmodalTambah()"> <i class="i" onclick="offmodalTambah()">&#xe14c</i></a> </div>
            <div class="divider"></div>
            <div class="overflow-content">
            <!--form action="" method="post"-->
                
            <div class="tombol green">DATA PESAN</div>
   
    <table id="">
                    <tbody>
                        <tr>
                            <td>Kalimat Pembuka</td>
                            <td id="textArea">
                                <textarea name="header" id="headerwa" value="<?= old('header') ?>" placeholder="Salam, maksud dan tujuan, dsb." required oninvalid="this.setCustomValidity('Kalimat pembuka harus diisi')" oninput="this.setCustomValidity('')"></textarea>
                                <br> <span class="txtdanger data-subtitle"><?= session()->getFlashdata('errors') ['header'] ?? '' ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Kalimat Penutup</td>
                            <td id="textArea">
                                <textarea name="footer" id="footerwa" value="<?= old('footer') ?>" placeholder="Terima kasih, info pembayaran, dsb." required oninvalid="this.setCustomValidity('Kalimat penutup harus diisi')" oninput="this.setCustomValidity('')"></textarea>
                                <br> <span class="txtdanger data-subtitle"><?= session()->getFlashdata('errors') ['footer'] ?? '' ?></span>
                            </td>
                        </tr>
                        <!--<tr>
                            <td>Pilih Penerima</td>
                            <td>
                                <span class="txtdanger data-subtitle"><?//= session()->getFlashdata('errors') ['siswa_id'] ?? '' ?></span>                           
                            <?//php foreach ($penerima as $p) : ?>
                                <div class="cbkelas">
                                    <input class="" type="checkbox" name="siswa_id[]" id="<?//= $p['nis'] ?>" value="<?//= $p['nis'] ?>">
                                    <label for="<?//= $p['nis'] ?>"><?//= $p['name'] ?> - <?//= $p['phonenumber'] ?></label><br>
                                </div>
                            <?//php endforeach ?>                           
                           </td>
                        </tr>
                            -->
                        
                    </tbody>
                </table>
                <!--<div class="divider"></div>-->
                <div class="group-action">
                <!--<a class="tombol disable" onclick="offmodalTambah()">Close</a> -->
                <div></div>
                <button class="tombol primary" id="kirim_tagihan">Kirim</button>
                </div>
                
    <!--/form-->
    </div>
    </div>
</div>

<!-- Modal Sort & Filter-->

<div id="modalFilter" class="black-board">
        <div class="pop">
            <div class="group-action"><h2 class="data-title">Filter & Urutkan</h2><a onclick="offmodalFilter()"> <i class="i" onclick="offmodalFilter()">&#xe14c</i></a> </div>
            <div class="divider"></div>
            <div class="overflow-content">
            <form method="get" action="">
                
            <div class="tombol green">Filter Berdasarkan</div>
                <table id="">
                    <tbody>                        
                        <tr>
                            <td>Kelas</td>
                            <td>
                            <div class="cbkelas">
                                <input type="checkbox" id="7" value="7" name="kelas[]" <?= (!empty($kelas_filter) && in_array('7', $kelas_filter)) ? 'checked' : '' ?>><label for="7">7</label><br>
                            </div>     
                            <div class="cbkelas">
                                <input type="checkbox" id="8" value="8" name="kelas[]" <?= (!empty($kelas_filter) && in_array('8', $kelas_filter)) ? 'checked' : '' ?>><label for="8">8</label><br>
                            </div>     
                            <div class="cbkelas">
                                <input type="checkbox" id="9" value="9" name="kelas[]" <?= (!empty($kelas_filter) && in_array('9', $kelas_filter)) ? 'checked' : '' ?>><label for="9">9</label><br>
                            </div>
                           </td>
                        </tr>
                        <tr>
                            <td>Status Tagihan</td>
                            <td>
                                <div class="cbkelas">
                                    <input type="checkbox" id="L" value="L" name="status[]"
                                        <?= (!empty($status_filter) && in_array('L', $status_filter)) ? 'checked' : '' ?>>
                                    <label for="L">Lunas</label><br>
                                </div>     
                                <div class="cbkelas">
                                    <input type="checkbox" id="B" value="B" name="status[]"
                                        <?= (!empty($status_filter) && in_array('B', $status_filter)) ? 'checked' : '' ?>>
                                    <label for="B">Belum Lunas</label><br>
                                </div>  
                            </td>

                        </tr>
                        
                    </tbody>
                </table>
            <div class="tombol green">Urut Berdasarkan</div>
                <table id="">
                    <tbody>                        
                        <tr>
                            
                            <td colspan="2">
                                <div class="cbkelas">
                                    <input type="radio" id="1" name="urutkan" value="1" <?= (isset($urutkan) && $urutkan == 1) ? 'checked' : '' ?>>
                                    <label for="1">Nama A-Z</label><br>
                                </div>  
                                <div class="cbkelas">
                                    <input type="radio" id="2" name="urutkan" value="2" <?= (isset($urutkan) && $urutkan == 2) ? 'checked' : '' ?>>
                                    <label for="2">Nama Z-A</label><br>
                                </div>  
                                <div class="cbkelas">
                                    <input type="radio" id="3" name="urutkan" value="3" <?= (isset($urutkan) && $urutkan == 3) ? 'checked' : '' ?>>
                                    <label for="3">Tagihan Tertinggi</label><br>
                                </div>  
                                <div class="cbkelas">
                                    <input type="radio" id="4" name="urutkan" value="4" <?= (isset($urutkan) && $urutkan == 4) ? 'checked' : '' ?>>
                                    <label for="4">Tagihan Terendah</label><br>
                                </div>  
                            </td>
                        </tr> 
                    </tbody>
                </table>
                

                <div class="divider"></div>
                <div class="group-action">
                <a class="tombol disable" onclick="offmodalFilter()">Close</a>
                <button class="tombol primary" type="submit">Terapkan</button>
                </div>
                
    </form>
    </div>
    </div>
</div>




<?= $this->include('closing') ?>