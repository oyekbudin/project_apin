<?= $this->include('dashboardadministrator') ?>
<div id="modalTambah" class="black-board">
        <div class="pop">
            <div class="group-action"><h2 class="data-title">Ubah Data User</h2><a href="<?= base_url('registeradministrator') ?>"> <i class="i" onclick="offmodalTambah()">&#xe14c</i></a> </div>
            <div class="divider"></div>
            <span class="tombol green">DATA USER</span>
    <form action="/registeradministrator/update/<?= $user['idadmin']?>" method="post">
    <table>
                    <tbody>
                        <tr>
                            <td>Nama Lengkap</td>
                            <td>
                                <input class="input" type="text" name="name" id="inputname" value="<?= $user['name'] ?>" placeholder="Nama Lengkap">
                                <span class="txtdanger data-subtitle"><?= isset($validation) ? $validation->getError('name') : "" ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Username</td>
                            <td>
                                <input class="input" type="text" name="adminname" id="inputadminname" value="<?= $user['adminname'] ?>" placeholder="Username">
                                <span class="txtdanger data-subtitle"><?= isset($validation) ? $validation->getError('adminname') : "" ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td><input class="input" type="password" name="password" id="inputpassword" value="" placeholder="Masukkan Password Baru" required>
                            <span class="txtdanger data-subtitle"><?= isset($validation) ? $validation->getError('password') : "" ?></span></td>
                        </tr>
                        <tr>
                            <td>Roles</td>
                            <td><select class="input" name="role" id="inputrole">
                                <option value="">Pilih Roles</option>
                                <option value="SistemAdmin" <?= $user['role'] == "SistemAdmin" ? "selected" : "" ?>>Sistem Admin</option>
                                <option value="KepalaSekolah" <?= $user['role'] == "KepalaSekolah" ? "selected" : "" ?>>Kepala Sekolah</option>
                                <option value="Bendahara" <?= $user['role'] == "Bendahara" ? "selected" : "" ?>>Bendahara</option>
                            </select></td>
                        </tr>                        
                    </tbody>
                </table>
                <div class="divider"></div>
                <div class="group-action">
                <a class="tombol disable" href="<?= base_url('registeradministrator') ?>">Close</a>
                <button class="tombol primary" type="submit">Simpan</button>
                </div>
    <!-- old -->
    <!--input type="text" name="name" id="inputname" value="<//?= $user['name'] ?>">
        <input type="text" name="adminname" id="inputadminname" value="<//?= $user['adminname'] ?>">
        <input type="text" name="role" id="inputrole" value="<//?= $user['role'] ?>">
        <input type="text" name="password" id="inputpassword" placeholder="Masukkan password baru" required>
        <button type="submit">Simpan</button-->
    </form>
    </div>
</div>

<?= $this->include('closing') ?>