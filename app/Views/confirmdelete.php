<?= $this->include('dashboardadministrator') ?>
<div id="modalTambah" class="black-board">
        <div class="pop">
            <div class="group-action"><h2 class="data-title">Apakah anda yakin ingin menghapus data berikut?</h2><a onclick="history.back()"> <i class="i" onclick="offmodalTambah()">&#xe14c</i></a> </div>
            <div class="divider"></div>
            <form action="/atursiswa/delete/<?= $siswa['nis'] ?>" method="post">
                <div class="overflow-content">
            <div class="tombol green">DATA SISWA</div>

    
    <table class="">
                    <tbody>
                        <tr>
                            <td>Nama Siswa</td>
                            <td>: <?= $siswa['name'] ?></td>
                        </tr>
                        <tr>
                            <td>NIS</td>
                            <td>: <?= $siswa['nis'] ?></td>
                        </tr>
                            <td>Kelas</td>
                            <td>: <?= $siswa['kelas'] ?></td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <!--td><input class="input" type="text" name="gender" id="inputgender" value="" placeholder="Jenis Kelamin">
                            </td-->
                            <td>: <?= ($siswa['gender'] == 'L') ? 'Laki-laki' : 'Perempuan' ?></td>
                        </tr>
                        <tr>
                            <td>No Whatsapp</td>
                            <td>: <?= $siswa['phonenumber'] ?></td>
                        </tr>
                    </tbody>
                </table>
                <div class="divider"></div>
                <div class="group-action">
                <a class="tombol disable" onclick="history.back()">Batal</a>
                <button class="tombol danger" type="submit">Hapus</button>
                </div>
                </div>
    </form>
    </div>
</div>

<?= $this->include('closing') ?>