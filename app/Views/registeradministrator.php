<?= $this->include('dashboardadministrator') ?>
    <h2>List User</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Username</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($lihatdata as $user) : ?>
            <tr>
                <td><?= $i++ ; ?></td>
                <td><?= $user['name'] ?></td>
                <td><?= $user['adminname'] ?></td>
                <td><?= $user['role'] ?></td>
                <td>
                    <a href="/registeradministrator/edit/<?= $user['id'] ?>">Edit</a>
                    <a href="/registeradministrator/delete/<?= $user['id'] ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <h2>Tambah User</h2>
    <?php if(isset($validation)) :?>
        <span><?= $validation->listErrors() ?></span>
    <?php endif;?>
    <form action="/registeradministrator/save" method="post">
        <input type="text" name="name" id="inputname" value="<?= set_value('name') ?>" placeholder="Nama Lengkap">
        <input type="text" name="adminname" id="inputadminname" value="<?= set_value('adminname') ?>" placeholder="Username">
        <input type="text" name="role" id="inputrole" value="<?= set_value('role') ?>" placeholder="Roles">
        <input type="password" name="password" id="inputpassword" placeholder="Password">
        <button type="submit">Register Administrator</button>
    </form>
    <?= $this->include('closing') ?>