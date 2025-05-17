<?= $this->include('dashboard-walimurid') ?>

<div class="board-wrap">
    <div class="dataonly">
        <?php if(isset($user)) : ?>
    <table>
        <tr>
            <td style="font-weight: bold;">Nama Lengkap</td>
            <td><?= $user['name']?></td>
        </tr>
        <tr>
            <td style="font-weight: bold;">NIS</td>
            <td><?= $user['nis']?></td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Kelas</td>
            <td><?= $user['kelas']?></td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Jenis Kelamin</td>
            <td><?= $user['gender']?></td>
        </tr>  
        <tr>
            <td style="font-weight: bold;">Nomor Whatsapp</td>
            <td><?= $user['phonenumber']?></td>
        </tr>       
    </table>
    <?php endif; ?>
    <a class="tombol primary-outline" onclick="onmodalEdit()"><i class="i">&#xF097</i>Edit Nomor Whatsapp</a>
    <a class="tombol primary-outline" href="<?= base_url('logout') ?>"><i class="i">&#xE9BA</i>Keluar dari aplikasi</a>

    </div>
</div>
<!-- modal -->
 <div id="modalTambah" class="black-board">
        <div class="pop">
            <div class="group-action"><h2 class="data-title">Ubah Profil</h2><a onclick="offmodalEdit()"> <i class="i" onclick="offmodalTambah()">&#xe14c</i></a> </div>
            <div class="divider"></div>
            <span class="tombol green">DATA PROFIL</span>
    <form action="/m-profil/update/<?= $user['nis']?>" method="post">
    <table>
                    <tbody>
                        <tr>
                            <td>Ubah No Whatsapp</td>
                            <td><input class="input" type="number" name="phonenumber" id="" value="" placeholder="Masukkan No Whatsapp Baru">
                            <span class="txtdanger data-subtitle"><?= session()->getFlashdata('errors') ['phonenumber'] ?? '' ?></span></td>
                        </tr>                     
                    </tbody>
                </table>
                <div class="divider"></div>
                <div class="group-action">
                <a class="tombol disable" onclick="offmodalEdit()">Close</a>
                <button class="tombol primary" type="submit">Simpan</button>
                </div>
    </form>
    </div>
</div>

<?= $this->include('closing') ?>