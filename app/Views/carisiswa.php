<!DOCTYPE html>
<html>
<head>
    <title>Pencarian Siswa</title>
</head>
<body>

<h2>Pencarian Siswa</h2>

<form method="GET" action="<?= base_url('siswa'); ?>">
    <input type="text" name="keyword" placeholder="Cari nama atau kelas..." value="<?= isset($_GET['keyword']) ? $_GET['keyword'] : '' ?>">
    <button type="submit">Cari</button>
</form>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>NIS</th>
        <th>Nama</th>
        <th>Kelas</th>
    </tr>
    <?php foreach ($siswa as $s) : ?>
        <tr>
            <td><?= $s['id']; ?></td>
            <td><?= $s['nis']; ?></td>
            <td><?= $s['name']; ?></td>
            <td><?= $s['kelas']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
