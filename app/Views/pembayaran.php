<?= $this->include('dashboardadministrator') ?>
<div class="board-wrap">
<div class="group-action">
<button class="tombol green" onclick="onmodalTambah()">Tambah Pembayaran</button>

</div>
<div class="divider"></div>
<div class="tablemobile">
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <!--th>Nama Infaq</th-->
                <th>Total Nominal</th>
                <!--th>Status</th-->
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
            <!--  data -->
            <?php if(!empty($pembayaran)) : ?>
            <?php foreach ($pembayaran as $row) : ?>
            <tr>
                <td><?= $row['tanggal'] ?></td>
                <td><?= $row['nis'] ?></td>
                <td><?= $row['nama_siswa'] ?></td>
                <td><?= $row['kelas'] ?></td>
                <!--td><//?= $row['nama_infaq'] ?></td-->
                <td><?= number_format($row['total_nominal'])  ?></td>
                <!--td><//?= $row['status'] ?></td-->
                <td>
                    <div class="td-action">
                    <!--a class="tombol primary-outline" href="/pembayaran/detail/<//?= $row['order_id'] ?>">Detail Pembayaran</a-->
                    <a class="tombol primary-outline" href="/pembayaran/detail/<?= $row['order_id'] ?>">Detail Pembayaran</a>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="8">Tidak ada data</td>
                </tr>
                <?php endif; ?>
        </tbody>
    </table>
    </div>
    <!-- pagination -->
    <!--?= $this->include('pagination') ?-->
    </div> <!-- end board wrap -->
    <!-- Modal -->
    <div id="modalTambah" class="black-board">
    <div class="pop">
        <div class="group-action"><h2 class="data-title">Tambah Pembayaran</h2><i class="i" onclick="offmodalTambah()">&#xe14c</i></div>
        <div class="divider"></div>
        <form action="/pembayaran/save" method="post">
        <div class="overflow-content">
        <div class="tombol green">IDENTITAS SISWA</div>
    
                <table>
                    <tbody>
                        <tr>
                            <td>Cari siswa</td>
                            <td>
                                <input class="input" type="text" name="cari" id="search-siswa" value="<?= old('cari') ?>"  placeholder="Masukkan nama siswa" required oninvalid="this.setCustomValidity('Data siswa harus diisi')" oninput="this.setCustomValidity('')">
                                <div id="result-siswa"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>NIS</td>
                            <td><input class="input" type="text" name="id_siswa" id="nis" readonly  placeholder="-" required oninvalid="this.setCustomValidity('NIS harus diisi')" oninput="this.setCustomValidity('')"></td>
                        </tr>
                        <tr>
                            <td>Nama Siswa</td>
                            <td><input class="input" type="text" name="name" id="name" readonly placeholder="-" required oninvalid="this.setCustomValidity('Nama siswa harus diisi')" oninput="this.setCustomValidity('')"></td>
                        </tr>
                            <td>Kelas</td>
                            <td><input class="input" type="text" name="kelas" id="kelas" readonly placeholder="-" required oninvalid="this.setCustomValidity('Nama siswa harus diisi')" oninput="this.setCustomValidity('')"></td>
                        </tr>
                        </tbody>
                </table>
                
                <table class="mini">
                    <thead>
                        <tr>
                            <th><div class="tombol green">Jenis Infaq</div></th>
                            <th><div class="tombol green">Tagihan</div></th>
                            <th><div class="tombol green">Nominal Pembayaran</div></th>                            
                        </tr>
                    </thead>
                    <tbody id="jenis-infaq">
                        <tr><td colspan="3" style="text-align: center;">Data Akan Ditampilkan disini</td></tr>                        
                    </tbody>
                </table>
                </div>
                <div class="divider"></div>
                <div class="group-action">
                    <a class="tombol disable" onclick="offmodalTambah()">Close</a>
                    <button class="tombol primary" type="submit">Simpan</button>
                </div>
    </form>
    </div> <!-- end pop -->
    </div> <!-- end modalTambah -->

    <!-- OLD
        <input type="text" name="idsiswa" id="inputidsiswa" value="<//?= set_value('idsiswa') ?>" placeholder="idsiswa">
        <input type="text" name="idinfaq" id="inputidinfaq" value="<//?= set_value('idinfaq') ?>" placeholder="idinfaq">
        <input type="text" name="nominal" id="inputnominal" value="<//?= set_value('nominal') ?>" placeholder="nominal">
        <button type="submit">Tambah Pembayaran</button>
    -->
        <!-- script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function(){
                $("#search-siswa").keyup(function(){
                    let keyword = $(this).val();
                    if(keyword.length > 0){
                        $.ajax({
                            url: "<?= base_url('pembayaran/searchSiswa') ?>",
                            type: "GET",
                            data: {keyword: keyword}, 
                            success: function(data){
                                if (data == '' || data.length == 0 || $.trim(data) == '')
                                {
                                    let resultHtml = `<tr><td colspan="3" style="text-align:center;">Tidak ada data</td></tr> `;
                                    $("#result-siswa").html('<table><thead><tr><th>NIS</th><th>Nama Siswa</th><th>Kelas</th></tr></thead><tbody>'+resultHtml+'</tbody></table>');
                                } else
                                {
                                    let resultHtml = ``;
                                    $.each(data, function(index, siswa){
                                                        //resultHtml += `<li class="siswa-item" data-nis="${siswa.nis}" data-name="${siswa.name}" data-kelas="${siswa.kelas}"> ${siswa.nis} - ${siswa.name} (${siswa.kelas}) </li>`;
                                    resultHtml += `<tr class="siswa-item" data-nis="${siswa.nis}" data-name="${siswa.name}" data-kelas="${siswa.kelas}"><td>${siswa.nis}</td><td>${siswa.name}</td><td>${siswa.kelas}</td></tr>`;
                                    });
                                                    //$("#result-siswa").html('<ul>'+resultHtml+'</ul>');
                                    $("#result-siswa").html('<table><thead><th>NIS</th><th>Nama Siswa</th><th>Kelas</th></thead><tbody>'+resultHtml+'</tbody></table>');
                                }                          
                            }
                        });
                    } else {
                            $("#result-siswa").html('');
                            }
                            });

                                    $(document).on("click", ".siswa-item", function(){
                                        let nis = $(this).data("nis");
                                        let name = $(this).data("name");
                                        let kelas = $(this).data("kelas");

                                        $("#nis").val(nis);
                                        $("#name").val(name);
                                        $("#kelas").val(kelas);
                                        $("#result-siswa").html("");

                                        /*
                                        $.ajax({
                                            url: "<//?= base_url('pembayaran/getInfaqByKelas') ?>",
                                            type: "GET",
                                            data: {kelas: kelas},
                                            success: function(data){
                                                let infaqOptions = `<option value="">Pilih Jenis Infaq</option>`;
                                                $.each(data, function(index, infaq){
                                                    infaqOptions += `<option value="${infaq.id}">${infaq.name} (${infaq.harga}) </option>`;
                                                });
                                                $("#jenis-infaq").html(infaqOptions);
                                            }
                                        });
                                        */

                                        //ajax baru new database
                                        $.ajax({
                                            url: "<?= base_url('pembayaran/getTagihanForPembayaran') ?>",
                                            type: "GET",
                                            data: {nis: nis},
                                            success: function(data){
                                                let infaqOptions = ``;
                                                $.each(data, function(index, infaq){
                                                    infaqOptions += `<tr><td>${infaq.nama_infaq}</td><td>${infaq.sisa_tagihan}</td><td><input type="hidden" name="id_infaq[]" value="${infaq.id_infaq}"><input class="input" type="number" name="nominal[]" min="0" max="${infaq.sisa_tagihan}" oninvalid="this.setCustomValidity('Nominal pembayaran ' + this.min + '-' + this.max)" oninput="this.setCustomValidity('')" ></td></tr>`;
                                                    //infaqOptions += `<option value="${infaq.id}">${infaq.name} (${infaq.harga}) </option>`;
                                                });
                                                $("#jenis-infaq").html(infaqOptions);
                                            }
                                        });
                                        //sampai sini
                                    });
                                });
                            </script>
                            <!-- script -->
    <?= $this->include('closing') ?>