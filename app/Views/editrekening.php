<?= $this->include('dashboardadministrator') ?>
<!-- Modal Edit -->
<div id="modalTambah" class="black-board">
        <div class="pop">
            <div class="group-action"><h2 class="data-title">Edit Data Rekening</h2><a href="/aturrekening"><i class="i">&#xe14c</i></a></div>
            <div class="divider"></div>
            <div class="overflow-content">
            <span class="tombol green">DATA REKENING</span>
            <?php
            if (isset($rekening)) :
            ?>
             <form action="/aturrekening/update/<?= $rekening['id']?>" method="post">
                <table>
                    <tbody>
                        <tr>
                            <td>Nama Sekolah</td>
                            <td>
                                <input class="input" type="text" name="nama_sekolah" id="" value="<?= $rekening['nama_sekolah'] ?>" placeholder="Nama Sekolah" required oninvalid="this.setCustomValidity('Nama sekolah harus diisi')" oninput="this.setCustomValidity('')">
                                <br> <span class="txtdanger data-subtitle"><?= session()->getFlashdata('errors') ['nama_sekolah'] ?? '' ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Nama Pemilik Rekening</td>
                            <td>
                                <input class="input" type="text" name="nama_pemilik_rekening" id="" value="<?= $rekening['nama_pemilik_rekening'] ?>" placeholder="Nama Pemilik Rekening" required oninvalid="this.setCustomValidity('Nama pemilik rekening harus diisi')" oninput="this.setCustomValidity('')">
                                <br> <span class="txtdanger data-subtitle"><?= session()->getFlashdata('errors') ['nama_pemilik_rekening'] ?? '' ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Nama Bank</td>
                            <td>
                            <select class="input" name="nama_bank" required oninvalid="this.setCustomValidity('Pilih bank')" oninput="this.setCustomValidity('')">
                                <option value="">Pilih Bank</option>

                                <!-- Bank Nasional -->
                                <option value="Bank Mandiri">Bank Mandiri</option>
                                <option value="Bank BRI">Bank BRI</option>
                                <option value="Bank BCA">Bank BCA</option>
                                <option value="Bank BNI">Bank BNI</option>
                                <option value="Bank BTN">Bank BTN</option>
                                <option value="Bank Syariah Indonesia">Bank Syariah Indonesia (BSI)</option>
                                <option value="Bank CIMB Niaga">Bank CIMB Niaga</option>
                                <option value="Bank Danamon">Bank Danamon</option>
                                <option value="Bank Permata">Bank Permata</option>
                                <option value="Bank Panin">Bank Panin</option>
                                <option value="Bank Mega">Bank Mega</option>
                                <option value="Bank OCBC NISP">Bank OCBC NISP</option>
                                <option value="Bank Sinarmas">Bank Sinarmas</option>
                                <option value="Bank Jago">Bank Jago</option>
                                <option value="Bank BTPN">Bank BTPN</option>
                                <option value="Bank Maybank">Bank Maybank</option>
                                <option value="Bank Bukopin">Bank Bukopin</option>
                                <option value="Bank Commonwealth">Bank Commonwealth</option>

                                <!-- Bank Pembangunan Daerah (BPD) -->
                                <option value="Bank DKI">Bank DKI</option>
                                <option value="Bank BJB">Bank BJB (Bank Jawa Barat dan Banten)</option>
                                <option value="Bank Jateng">Bank Jateng (Bank Jawa Tengah)</option>
                                <option value="Bank Jatim">Bank Jatim (Bank Jawa Timur)</option>
                                <option value="Bank BPD DIY">Bank BPD DIY</option>
                                <option value="Bank BPD Bali">Bank BPD Bali</option>
                                <option value="Bank BPD NTT">Bank NTT (Nusa Tenggara Timur)</option>
                                <option value="Bank BPD NTB Syariah">Bank NTB Syariah</option>
                                <option value="Bank Kalbar">Bank Kalbar (Kalimantan Barat)</option>
                                <option value="Bank Kaltimtara">Bank Kaltimtara (Kalimantan Timur & Utara)</option>
                                <option value="Bank Kalsel">Bank Kalsel (Kalimantan Selatan)</option>
                                <option value="Bank Kalteng">Bank Kalteng (Kalimantan Tengah)</option>
                                <option value="Bank Sulselbar">Bank Sulselbar (Sulawesi Selatan & Barat)</option>
                                <option value="Bank SulutGo">Bank SulutGo (Sulawesi Utara & Gorontalo)</option>
                                <option value="Bank Sulteng">Bank Sulteng (Sulawesi Tengah)</option>
                                <option value="Bank Sultra">Bank Sultra (Sulawesi Tenggara)</option>
                                <option value="Bank Maluku Malut">Bank Maluku Malut</option>
                                <option value="Bank Papua">Bank Papua</option>
                                <option value="Bank Aceh Syariah">Bank Aceh Syariah</option>
                                <option value="Bank Sumut">Bank Sumut (Sumatera Utara)</option>
                                <option value="Bank Nagari">Bank Nagari (Sumatera Barat)</option>
                                <option value="Bank Riau Kepri">Bank Riau Kepri</option>
                                <option value="Bank Sumsel Babel">Bank Sumsel Babel (Sumatera Selatan & Bangka Belitung)</option>
                                <option value="Bank Bengkulu">Bank Bengkulu</option>
                                <option value="Bank Lampung">Bank Lampung</option>

                            </select>

                            </td>
                        </tr>
                        <tr>
                            <td>Nomor Rekening</td>
                            <td><input class="input" type="text" name="nomor_rekening" id="" value="<?= $rekening['nomor_rekening'] ?>" placeholder="Nomor Rekening" required oninvalid="this.setCustomValidity('Nomor rekening harus diisi')" oninput="this.setCustomValidity('')">
                            <br> <span class="txtdanger data-subtitle"><?= session()->getFlashdata('errors') ['nomor_rekening'] ?? '' ?></span></td>
                        </tr>
                        <tr>
                            <td>Nama Kepala Sekolah</td>
                            <td>
                                <input class="input" type="text" name="nama_kepsek" id="" value="<?= $rekening['nama_kepsek'] ?>" placeholder="Nama Kepala Sekolah" required oninvalid="this.setCustomValidity('Nama kepala sekolah harus diisi')" oninput="this.setCustomValidity('')">
                                <br> <span class="txtdanger data-subtitle"><?= session()->getFlashdata('errors') ['nama_kepsek'] ?? '' ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>NIM</td>
                            <td><input class="input" type="text" name="nim_kepsek" id="" value="<?= $rekening['nim_kepsek'] ?>" placeholder="NIM" required oninvalid="this.setCustomValidity('NIM harus diisi')" oninput="this.setCustomValidity('')">
                            <br> <span class="txtdanger data-subtitle"><?= session()->getFlashdata('errors') ['nim_kepsek'] ?? '' ?></span></td>
                        </tr>
                        <tr>
                            <td>Nama Bendahara</td>
                            <td>
                                <input class="input" type="text" name="nama_bendahara" id="" value="<?= $rekening['nama_bendahara'] ?>" placeholder="Nama Bendahara" required oninvalid="this.setCustomValidity('Nama bendahara harus diisi')" oninput="this.setCustomValidity('')">
                                <br> <span class="txtdanger data-subtitle"><?= session()->getFlashdata('errors') ['nama_bendahara'] ?? '' ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Nomor Whatsapp</td>
                            <td><input class="input" type="text" name="phonenumber" id="" value="<?= $rekening['phonenumber'] ?>" placeholder="Nomor Whatsapp" required oninvalid="this.setCustomValidity('Nomor Whatsapp harus diisi')" oninput="this.setCustomValidity('')">
                            <br> <span class="txtdanger data-subtitle"><?= session()->getFlashdata('errors') ['phonenumber'] ?? '' ?></span></td>
                        </tr>
                    </tbody>
                </table>
                <?php endif; ?>
                <div class="divider"></div>
                <div class="group-action">
                <a class="tombol disable" href="/aturrekening">Close</a>
                <button class="tombol primary" type="submit">Simpan</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <?= $this->include('closing') ?>