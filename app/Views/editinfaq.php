<?= $this->include('dashboardadministrator') ?>
<div id="modalTambah" class="black-board">
        <div class="pop">
            <div class="group-action"><h2 class="data-title">Ubah Data Infaq</h2><a onclick="history.back()"> <i class="i" onclick="offmodalTambah()">&#xe14c</i></a> </div>
            <div class="divider"></div>
            <span class="tombol green">DATA INFAQ</span>
    <form action="/aturinfaq/update/<?= $infaq[0]['id'] ?>" method="post">
<table>
                    <tbody>
                        <tr>
                            <td>Nama Jenis Infaq</td>
                            <td>
                                <input class="input" type="text" name="name" id="inputname" value="<?= $infaq[0]['name'] ?>" placeholder="Nama Jenis Infaq" required oninvalid="this.setCustomValidity('Nama jenis infaq harus diisi')" oninput="this.setCustomValidity('')">
                                <span class="txtdanger data-subtitle"><?= session()->getFlashdata('errors') ['name'] ?? '' ?></span>
                            </td>
                        </tr>
                        
                        <tr>
                            <td>Harga</td>
                            <td><input class="input" type="text" name="harga" id="inputharga" value="<?= $infaq[0]['harga'] ?>" placeholder="Harga" required oninvalid="this.setCustomValidity('Harga harus diisi')" oninput="this.setCustomValidity('')">
                            <span class="txtdanger data-subtitle"><?= session()->getFlashdata('errors') ['harga'] ?? '' ?></span></td>
                        </tr>
                        <tr>
                            <td>Kelas</td>
                            <td>
                            <?php 
                            $string = $infaq[0]['kelas'];
                            $string = str_replace(['{','}'],'',$string);
                            $kelasArray = explode(',',$string ) 
                            ?>
                            <?php foreach ($kelas as $k) : ?>
                                <div class="cbkelas">
                                    <input class="" type="checkbox" name="kelas_id[]" id="<?= $k['id'] ?>" value="<?= $k['id'] ?>"  <?= in_array($k['id'], $kelasArray) ? 'checked' : 'not-checked' ?>>
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
                <a class="tombol disable" onclick="history.back()">Close</a>
                <button class="tombol primary" type="submit">Simpan</button>
                </div>
    </form>
    </div>
</div>
<?= $this->include('closing') ?>