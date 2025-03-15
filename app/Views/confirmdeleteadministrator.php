<?= $this->include('dashboardadministrator') ?>
<div id="modalTambah" class="black-board">
        <div class="pop">
            <div class="group-action"><h2 class="data-title">Apakah anda yakin ingin menghapus data berikut?</h2><a href="<?= base_url('registeradministrator') ?>"> <i class="i" onclick="offmodalTambah()">&#xe14c</i></a> </div>
            <div class="divider"></div>
            <span class="tombol green">DATA USER</span>

    <form action="/registeradministrator/delete/<?= $user['idadmin'] ?>" method="post">
    <table>
                    <tbody>
                        <tr>
                            <td>Nama Lengkap</td>
                            <td>: <?= $user['name'] ?></td>
                        </tr>
                            <td>Username</td>
                            <td>: <?= $user['adminname'] ?></td>
                        </tr>
                        <tr>
                            <td>Roles</td>
                            <td>: <?= $user['role'] ?></td>
                        </tr>
                    </tbody>
                </table>
                <div class="divider"></div>
                <div class="group-action">
                <a class="tombol disable" href="<?= base_url('registeradministrator') ?>">Batal</a>
                <button class="tombol danger" type="submit">Hapus</button>
                </div>
    </form>
    </div>
</div>

<?= $this->include('closing') ?>