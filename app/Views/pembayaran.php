<?= $this->include('dashboardadministrator') ?>
<div class="board-wrap">
<div class="group-action">
<button class="tombol green" onclick="onmodalTambah()">Tambah Pembayaran</button>
<!--a href="<//?= base_url('/export-pdf/infaq'); ?>" class="tombol secondary" target="_blank">Export PDF</a-->
<!--div class="search">
    
    <form method="GET" action="<//?= base_url('registeradministrator'); ?>">
        <span>Search :</span>
    <div class="input">
    <input class="search" type="text" id="search" name="keyword" placeholder="Cari Administrator" value="<//?= isset($_GET['keyword']) ? $_GET['keyword'] : '' ?>" >
    <//?php if ($keyword) : ?>
    <a href="<//?= base_url('registeradministrator')?>"><i class="i">&#xE14C</i></a>
    <//?php endif; ?>
    </div>
</form>
</div-->
</div>
<div class="divider"></div>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Nama Infaq</th>
                <th>Nominal</th>
                <th>Status</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
            <!--  data -->
            <?php if(!empty($pembayaran)) : ?>
            <?php foreach ($pembayaran as $row) : ?>
            <tr>
                <td><?= $row['date'] ?></td>
                <td><?= $row['nis'] ?></td>
                <td><?= $row['nama_siswa'] ?></td>
                <td><?= $row['kelas'] ?></td>
                <td><?= $row['nama_infaq'] ?></td>
                <td><?= $row['nominal'] ?></td>
                <td><?= $row['status'] ?></td>
                <td>
                    <a class="tombol primary-outline" href="/pembayaran/confirmdeletepembayaran/<?= $row['id'] ?>">Detail</a>
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
    <!-- pagination -->
    <!--?= $this->include('pagination') ?-->
    </div> <!-- end board wrap -->
    <!-- Modal -->
    <!--h2>Tambah Pembayaran</h2-->
    <div id="modalTambah" class="black-board">
    <div class="pop">
        <div class="group-action"><h2 class="data-title">Tambah Pembayaran</h2><i class="i" onclick="offmodalTambah()">&#xe14c</i></div>
        <div class="divider"></div>
        <span class="tombol green">DATA PEMBAYARAN</span>
    <!--?php if(isset($validation)) :?>
        <span><//?= $validation->listErrors() ?></span>
    <//?php endif;?-->
    <form action="/pembayaran/save" method="post">
                <table>
                    <tbody>
                        <tr>
                            <td>Search</td>
                            <td>
                                <input class="input" type="text" name="#" id="search-siswa" value="" placeholder="Cari Siswa">
                                <div id="result-siswa"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>NIS</td>
                            <td><input class="input" type="text" name="idsiswa" id="nis" readonly placeholder="-"></td>
                        </tr>
                        <tr>
                            <td>Nama Siswa</td>
                            <td><input class="input" type="text" name="" id="name" readonly placeholder="-"></td>
                        </tr>
                            <td>Kelas</td>
                            <td><input class="input" type="text" name="" id="kelas" readonly placeholder="-"></td>
                        </tr>
                        <tr>
                            <td>Jenis Infaq</td>
                            <td><select class="input" name="idinfaq" id="jenis-infaq">
                                <option value="">Pilih Jenis Infaq</option>
                            </select></td>
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
                                                    let resultHtml = "";
                                                    $.each(data, function(index, siswa){
                                                        //resultHtml += `<li class="siswa-item" data-nis="${siswa.nis}" data-name="${siswa.name}" data-kelas="${siswa.kelas}"> ${siswa.nis} - ${siswa.name} (${siswa.kelas}) </li>`;
                                                        resultHtml += `<tr class="siswa-item" data-nis="${siswa.nis}" data-name="${siswa.name}" data-kelas="${siswa.kelas}"><td>${siswa.nis}</td><td>${siswa.name}</td><td>${siswa.kelas}</td></tr>`;
                                                    });
                                                    //$("#result-siswa").html('<ul>'+resultHtml+'</ul>');
                                                    $("#result-siswa").html('<table><thead><th>NIS</th><th>Nama Siswa</th><th>Kelas</th></thead><tbody>'+resultHtml+'</tbody></table>');
                                                }
                                            });
                                        } else {
                                            $("#result-siswa").html("");
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

                                        //perbaiki disini untuk jenis infaq
                                        $.ajax({
                                            url: "<?= base_url('pembayaran/getInfaqByKelas') ?>",
                                            type: "GET",
                                            data: {kelas: kelas},
                                            success: function(data){
                                                let infaqOptions = `<option value="">Pilih Jenis Infaq</option>`;
                                                $.each(data, function(index, infaq){
                                                    infaqOptions += `<option value="${infaq.id}">${infaq.name} ${infaq.harga} </option>`;
                                                });
                                                $("#jenis-infaq").html(infaqOptions);
                                            }
                                        });
                                        //sampai sini
                                    });
                                });
                            </script>
                            <!-- script -->
                        </tr>
                        <tr>
                            <td>Nominal</td>
                            <td>
                                <input class="input" type="number" name="nominal" id="input#" value="" placeholder="Masukkan Nominal">
                                <span class="txtdanger data-subtitle"><?= isset($validation) ? $validation->getError('#') : "" ?></span>
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
    </div> <!-- end pop -->
    </div> <!-- end modalTambah -->

    <!-- OLD
        <input type="text" name="idsiswa" id="inputidsiswa" value="<//?= set_value('idsiswa') ?>" placeholder="idsiswa">
        <input type="text" name="idinfaq" id="inputidinfaq" value="<//?= set_value('idinfaq') ?>" placeholder="idinfaq">
        <input type="text" name="nominal" id="inputnominal" value="<//?= set_value('nominal') ?>" placeholder="nominal">
        <button type="submit">Tambah Pembayaran</button>
    -->
    <?= $this->include('closing') ?>