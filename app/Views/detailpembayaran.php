<?= $this->include('dashboardadministrator') ?>
<div id="modalTambah" class="black-board">
        <div class="pop">
            <div class="group-action"><h2 class="data-title">Detail Pembayaran</h2><a onclick="history.back()"> <i class="i" onclick="offmodalTambah()">&#xe14c</i></a> </div>
            <div class="divider"></div>
            <div class="overflow-content">
            <form action="/pembayaran/deleteall/<?= $pembayaran[0]['order_id'] ?>" method="post">
                
                    <div class="tombol green">Data Pembayaran</div>
                    <?php if(isset($pembayaran)) : ?>
                        <table>
                            <tbody>
                                <tr>
                                    <td>No Transaksi</td>
                                    <td>: <?= $pembayaran[0]['order_id'] ?></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Pembayaran</td>
                                    <td>: <?= $pembayaran[0]['date'] ?></td>
                                </tr>
                                <tr>
                                    <td>NIS</td>
                                    <td>: <?= $pembayaran[0]['nis'] ?></td>
                                </tr>
                                <tr>
                                    <td>Nama Siswa</td>
                                    <td>: <?= $pembayaran[0]['nama_siswa'] ?></td>
                                </tr>
                                <tr>
                                    <td>Kelas</td>
                                    <td>: <?= $pembayaran[0]['kelas'] ?></td>
                                </tr>
                                <tr>
                                    <td>Total Nominal</td>
                                    <td>: 
                                        <?php
                                        $total_nominal = 0;
                                        foreach($pembayaran as $p) {$total_nominal += $p['nominal'];}
                                        echo $total_nominal;
                                        ?> 
                                    </td>
                                </tr>
                                <tr>
                                    <td>Metode Pembayaran</td>
                                    <td>: <?= $pembayaran[0]['payment_method'] ?></td>
                                </tr>
                                <tr>
                                    <td>Status Pembayaran</td>
                                    <td>: <?= $pembayaran[0]['status'] ?></td>
                                </tr>
                            </tbody>
                        </table>
                    <?php endif; ?>                    
                        <table class="mini">
                            <thead>
                                <tr class="green">
                                    <th><div>Jenis Infaq</div></th>
                                    <th><div>Nominal</div></th>
                                    <th><div>Opsi</div></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($pembayaran as $p) : ?>
                                <tr>
                                    <td style="text-align: center;"><?= $p['nama_infaq'] ?></td>
                                    <td class="txtgreen" style="text-align: center;"><?= $p['nominal'] ?></td>
                                    <td style="text-align: center;">
                                        <div class="group-action">
                                            <a class="tombol danger-outline" href="/pembayaran/delete/<?= $p['id'] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data pembayaran ini?')">Hapus</a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    
                
                    <div class="divider"></div>
                    <div class="group-action">
                    <a class="tombol disable" onclick="history.back()">Close</a>
                    <button class="tombol danger" type="submit" onclick="return confirm('Apakah anda yakin ingin menghapus semua pembayaran ini?')">Hapus Semua Pembayaran</button>
                    </div>
                
            </form>
        </div>
    </div>
</div>

<?= $this->include('closing') ?>