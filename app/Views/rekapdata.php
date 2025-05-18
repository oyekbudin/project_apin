<?= $this->include('dashboardadministrator') ?>

<?php $session = session(); 
            $name = $session->get('name');
            $role = $session->get('role');
            ?>

<div class="grid-board">
    <div class="board-1">
        <div class="board-wrap">
        <h3>Rekap Data</h3>
        <div class="divider"></div>
        <div class="wrap-rekap">
            <div class="card-3 green">
                <div><i class="i">&#xEB70</i></div>
                <span class="data-title"><?= 'Rp ' . number_format($total_pembayaran, 0, ',', '.') ?></span>
                <span class="data-subtitle">Total Pembayaran</span>
            </div>
            <div class="card-3 blue">
                <div><i class="i">&#xE916</i></div>
                <span class="data-title"><?= 'Rp ' . number_format($kredit_bulan_ini, 0, ',', '.') ?></span>
                <span class="data-subtitle">Kredit Bulan Ini</span>
            </div>
            <div class="card-3 red">
                <div><i class="i">&#xF187</i></div>
                <span class="data-title"><?= 'Rp ' . number_format($sisa_tagihan, 0, ',', '.') ?></span>
                <span class="data-subtitle">Sisa Tagihan</span>
            </div>
            <div class="card-3 black">
                <div><i class="i">&#xE7FB</i></div>
                <span class="data-title"><?= $totalsiswa; ?></span>
                <span class="data-subtitle">Jumlah Siswa</span>
            </div>
            <div class="card-3 purple">
                <div><i class="i">&#xE80C</i></div>
                <span class="data-title">3</span>
                <span class="data-subtitle">Jumlah Kelas</span>
            </div>
            <div class="card-3 orange">
                <div><i class="i">&#xE6B3</i></div>
                <span class="data-title"><?= $totalinfaq; ?></span>
                <span class="data-subtitle">Jumlah Infaq</span>
            </div>
        </div>
        </div>
    </div>

    <div class="board-2">
        <div class="board-wrap">
        <h3>Manual Aplikasi Pengelola Infaq dan Panduan</h3>
        <div class="divider"></div>
        <div class="wrap-manual">
            <div class="bar blue">
                <div class="data-info">
                    <span class="txtwarning">Manual Penggunaan Aplikasi <br><span class="txtsecondary">Untuk Sistem Admin</span></span>
                    <i class="i">&#xE887</i>
                </div>
                <div class="data-subtitle"><i class="i">&#xE895</i><span>Simak dan Pahami Manual Aplikasi Sebelum Bekerja</span></div>
            </div>
            <div class="bar darkpurple">
                <div class="data-info">
                    <span class="txtwarning">Panduan Pengelolaan dan Pelaporan</span>
                    <i class="i">&#xE88E</i>
                </div>
                <div class="data-subtitle"><i class="i">&#xE895</i><span>Simak dan Pahami Panduan Pengelolaan dan Pelaporan</span></div>
            </div>
        </div>
        </div>
    </div>
</div>

<?= $this->include('closing') ?>