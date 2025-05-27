<?= $this->include('dashboardadministrator') ?>
<div class="board-wrap">
    <div class="dataonly">
        <?php if(isset($user)) : ?>
    <table>
        <tr>
            <td style="font-weight: bold;">Nama Lengkap</td>
            <td>: <?= $user['name']?></td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Username</td>
            <td>: <?= $user['adminname']?></td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Password</td>
            <td>: *****</td>
        </tr>        
        <tr>
            <td colspan="2"><div class="td-action"><a class="tombol primary-outline" onclick="onmodalEdit()">Edit Profil</a></div></td>
        </tr>        
    </table>
    <?php endif; ?>
    </div>
</div>
<!-- modal -->
 <div id="modalTambah" class="black-board">
        <div class="pop">
            <div class="group-action"><h2 class="data-title">Ubah Profil</h2><a onclick="offmodalEdit()"> <i class="i" onclick="offmodalTambah()">&#xe14c</i></a> </div>
            <div class="divider"></div>
            <span class="tombol green">DATA PROFIL</span>
    <form action="/profil/update/<?= $user['idadmin']?>" method="post">
    <table>
                    <tbody>
                        <tr>
                            <td>Nama Lengkap</td>
                            <td>
                                <input class="input" type="text" name="name" id="inputname" value="<?= $user['name'] ?>" placeholder="Nama Lengkap"required oninvalid="this.setCustomValidity('Nama Lengkap harus diisi')" oninput="this.setCustomValidity('')">
                                <br> <span class="txtdanger data-subtitle"><?= session()->getFlashdata('errors') ['name'] ?? '' ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Username</td>
                            <td>
                                <input class="input" type="text" name="adminname" id="inputadminname" value="<?= $user['adminname'] ?>" placeholder="Username"required oninvalid="this.setCustomValidity('Username harus diisi')" oninput="this.setCustomValidity('')" >
                                <br> <span class="txtdanger data-subtitle"><?= session()->getFlashdata('errors') ['adminname'] ?? '' ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Ubah Password</td>
                            <td><input class="input" type="text" name="password" id="inputpassword" value="" placeholder="Masukkan Password Baru">
                            <br> <span class="txtdanger data-subtitle"><?= session()->getFlashdata('errors') ['password'] ?? '' ?></span></td>
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