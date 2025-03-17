<?= $this->include('dashboardadministrator') ?>
    <div class="board-wrap">
<div class="group-action">
<button class="tombol green" onclick="onmodalTambah()">Tambah User</button>
<!--a href="<//?= base_url('/export-pdf/infaq'); ?>" class="tombol secondary" target="_blank">Export PDF</a-->
<div class="search">
    
    <form method="GET" action="<?= base_url('registeradministrator'); ?>">
        <span>Search :</span>
    <div class="input">
    <input class="search" type="text" id="search" name="keyword" placeholder="Cari Administrator" value="<?= isset($_GET['keyword']) ? $_GET['keyword'] : '' ?>" >
    <?php if ($keyword) : ?>
    <a href="<?= base_url('registeradministrator')?>"><i class="i">&#xE14C</i></a>
    <?php endif; ?>
    </div>
</form>
</div>
</div>
<div class="divider"></div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Username</th>
                <th>Roles</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
            <!--  data -->
            <?php if(!empty($dataadministrator)) : ?>
            <?php 
            $startNumber = ($currentPage - 1) * $perpage + 1;
            $i = $startNumber;
            ?>
            <?php foreach ($dataadministrator as $user) : ?>
            <tr>
                <td><?= $i++ ; ?></td>
                <td style="text-align:left"><?= $user['name'] ?></td>
                <td><?= $user['adminname'] ?></td>
                <td><?= $user['role'] ?></td>
                <td>
                    <a class="tombol warning-outline" href="/registeradministrator/edit/<?= $user['idadmin'] ?>">Edit</a>
                    <a class="tombol danger-outline" href="/registeradministrator/confirmdeleteadministrator/<?= $user['idadmin'] ?>">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="5">Tidak ada data</td>
                </tr>
                <?php endif; ?>
        </tbody>
    </table>
    <!-- pagination -->
    <?= $this->include('pagination') ?>
    </div>
    <!-- Modal -->
    <div id="modalTambah" class="black-board">
    <div class="pop">
        <div class="group-action"><h2 class="data-title">Tambah User</h2><i class="i" onclick="offmodalTambah()">&#xe14c</i></div>
        <div class="divider"></div>
        <span class="tombol green">DATA USER</span>
    <form action="/registeradministrator/save" method="post">
            <table>
                    <tbody>
                        <tr>
                            <td>Nama Lengkap</td>
                            <td>
                                <input class="input" type="text" name="name" id="inputname" value="" placeholder="Nama Lengkap">
                                <span class="txtdanger data-subtitle"><?= isset($validation) ? $validation->getError('name') : "" ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Username</td>
                            <td>
                                <input class="input" type="text" name="adminname" id="inputadminname" value="" placeholder="Username">
                                <span class="txtdanger data-subtitle"><?= isset($validation) ? $validation->getError('adminname') : "" ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td><input class="input" type="password" name="password" id="inputpassword" value="" placeholder="Password">
                            <span class="txtdanger data-subtitle"><?= isset($validation) ? $validation->getError('password') : "" ?></span></td>
                        </tr>
                        <tr>
                            <td>Roles</td>
                            <td><select class="input" name="role" id="inputrole">
                                <option value="">Pilih Roles</option>
                                <option value="SistemAdmin" >Sistem Admin</option>
                                <option value="KepalaSekolah">Kepala Sekolah</option>
                                <option value="Bendahara">Bendahara</option>
                            </select></td>
                        </tr>                        
                    </tbody>
                </table>
                <div class="divider"></div>
                <div class="group-action">
                <a class="tombol disable" onclick="offmodalTambah()">Close</a>
                <button class="tombol primary" type="submit">Simpan</button>
                </div>
    </form>
    </div>
    </div>

<!-- old -->
    <!--h2>Tambah User</h2>
    <//?php if(isset($validation)) :?>
        <span><//?= $validation->listErrors() ?></span>
    <//?php endif;?>
    <form action="/registeradministrator/save" method="post">
        <input type="text" name="name" id="inputname" value="<//?= set_value('name') ?>" placeholder="Nama Lengkap">
        <input type="text" name="adminname" id="inputadminname" value="<//?= set_value('adminname') ?>" placeholder="Username">
        <input type="text" name="role" id="inputrole" value="<//?= set_value('role') ?>" placeholder="Roles">
        <input type="password" name="password" id="inputpassword" placeholder="Password">
        <button type="submit">Register Administrator</button>
    </form-->
    <?= $this->include('closing') ?>