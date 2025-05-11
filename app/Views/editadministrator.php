<?= $this->include('dashboardadministrator') ?>
<div id="modalTambah" class="black-board">
        <div class="pop">
            <div class="group-action"><h2 class="data-title">Ubah Data User</h2><a onclick="history.back()"> <i class="i" onclick="offmodalTambah()">&#xe14c</i></a> </div>
            <div class="divider"></div>
            <span class="tombol green">DATA USER</span>
    <form action="/registeradministrator/update/<?= $user['idadmin']?>" method="post">
    <table>
                    <tbody>
                        <tr>
                            <td>Nama Lengkap</td>
                            <td>
                                <input class="input" type="text" name="name" id="inputname" value="<?= $user['name'] ?>" placeholder="Nama Lengkap"required oninvalid="this.setCustomValidity('Nama Lengkap harus diisi')" oninput="this.setCustomValidity('')">
                                <span class="txtdanger data-subtitle"><?= session()->getFlashdata('errors') ['name'] ?? '' ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Username</td>
                            <td>
                                <input class="input" type="text" name="adminname" id="inputadminname" value="<?= $user['adminname'] ?>" placeholder="Username"required oninvalid="this.setCustomValidity('Username harus diisi')" oninput="this.setCustomValidity('')" >
                                <span class="txtdanger data-subtitle"><?= session()->getFlashdata('errors') ['adminname'] ?? '' ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Ubah Password</td>
                            <td><input class="input" type="text" name="password" id="inputpassword" value="" placeholder="Masukkan Password Baru">
                            <span class="txtdanger data-subtitle"><?= session()->getFlashdata('errors') ['password'] ?? '' ?></span></td>
                        </tr>
                        <tr>
                            <td>Roles</td>
                            <td><select class="input" name="role" id="inputrole">
                                <option value="SistemAdmin" <?= $user['role'] == "SistemAdmin" ? "selected" : "" ?>>Sistem Admin</option>
                                <option value="KepalaSekolah" <?= $user['role'] == "KepalaSekolah" ? "selected" : "" ?>>Kepala Sekolah</option>
                                <option value="Bendahara" <?= $user['role'] == "Bendahara" ? "selected" : "" ?>>Bendahara</option>
                            </select></td>
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