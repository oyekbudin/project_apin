<?= $this->include('dashboardadministrator') ?>
<div id="modalTambah" class="black-board">
        <div class="pop">
            <div class="group-action"><h2 class="data-title">Detail Pesan</h2><a onclick="history.back()"> <i class="i" onclick="offmodalTambah()">&#xe14c</i></a> </div>
            <div class="divider"></div>
            <div class="overflow-content">
            <form action="#" method="post">
                
            <div class="tombol green">DATA PESAN</div>
   
    <table id="">
                    <tbody>
                        <tr>
                            <td>Nama Penerima</td>
                            <td><?= $pesanwa['nama_penerima'] ?></td>
                        </tr>                                               
                        <tr>
                            <td>Nomor Penerima</td>
                            <td><?= $pesanwa['nomor_penerima'] ?></td>
                        </tr>                                               
                        <tr>
                            <td>Waktu pengiriman</td>
                            <td><?= $pesanwa['waktu_kirim'] ?></td>
                        </tr>                                               
                        <tr>
                            <td>Status</td>
                            <td><?= $pesanwa['status'] ?></td>
                        </tr>                                               
                        <tr>
                            <td>Isi Pesan</td>
                            <td id="detailpesan"><?= nl2br($pesanwa['pesan']) ?></td>
                        </tr>                                                
                    </tbody>
                </table>
                <div class="divider"></div>
                <div class="group-action">
                <a class="tombol disable" onclick="history.back()">Close</a>
                </div>
                
    </form>
    </div>
    </div>
</div>

<?= $this->include('closing') ?>