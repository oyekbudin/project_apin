<?php $session = session(); 
    $name = $session->get('name');
    $role = $session->get('role');
?>
<?= $this->include('header') ?>
<body class="grid-dashboard-1">
    <main class="grid-dashboard-2">
        <aside class="aside-dashboard">
            <div class="logo">
                <img src="<?= base_url('/assets/icon.webp') ?>" alt="">
            </div>          
            <ul>
                <a href="<?= base_url('dashboardadministrator') ?>"><li <?= ($menu == 'Dashboard') ? 'class="on"' : 'class=""' ?>><i class="i">&#xE88A</i><span class="t">Dashboard</span></li></a> 
                <?php if ($role != 'KepalaSekolah' && $role !='Bendahara') : ?>
                <li <?= ($menu == 'Perencanaan') ? 'class="on"' : 'class=""' ?>><i class="i">&#xeb6f</i><span class="t">Perencanaan</span><i class="i">&#xE313</i>
                    <ul <?= ($menu == 'Perencanaan') ? 'style="display:block;"' : 'style="display:none;"' ?>>
                        <a href="<?= base_url('atursiswa')?>"><li <?= ($title == 'Atur Siswa') ? 'class="on"' : 'class=""' ?>><i class="i">&#xE5CC</i><span class="t">Atur Siswa</span></li></a>
                        <a href="<?= base_url('aturinfaq') ?>"><li <?= ($title == 'Atur Jenis Infaq') ? 'class="on"' : 'class=""' ?>><i class="i">&#xE5CC</i><span class="t">Atur Jenis Infaq</span></li></a>
                    </ul>
                </li>
                <?php endif ?>
                <li <?= ($menu == 'Pengelolaan') ? 'class="on"' : 'class=""' ?>><i class="i">&#xEB86</i><span class="t">Pengelolaan</span><i class="i">&#xE313</i>
                <ul <?= ($menu == 'Pengelolaan') ? 'style="display:block;"' : 'style="display:none;"' ?>>
                    <a href="<?= base_url('pembayaran') ?>"><li <?= ($title == 'Input Pembayaran') ? 'class="on"' : 'class=""' ?>><i class="i">&#xE5CC</i><span class="t">Input Pembayaran</span></li></a>
                    <li><i class="i">&#xE5CC</i><span class="t">Tagihan</span></li>
                </ul>
                </li>
                <li><i class="i">&#xE555</i><span class="t">Pelaporan</span><i class="i">&#xE313</i>
                <ul <?= ($menu == 'Pelaporan') ? 'style="display:block;"' : 'style="display:none;"' ?>>
                    <li><i class="i">&#xE5CC</i><span class="t">Laporan Bulanan</span></li>
                    <li><i class="i">&#xE5CC</i><span class="t">Laporan Tahunan</span></li>
                </ul>
                </li>
                <?php if ($role != 'KepalaSekolah' && $role !='Bendahara') : ?>
                <li <?= ($menu == 'Pengaturan') ? 'class="on"' : 'class=""' ?>><i class="i">&#xE8B8</i><span class="t">Pengaturan</span><i class="i">&#xE313</i>
                <ul <?= ($menu == 'Pengaturan') ? 'style="display:block;"' : 'style="display:none;"' ?>>
                    <a href="<?= base_url('registeradministrator') ?>"><li <?= ($title == 'Atur User') ? 'class="on"' : 'class=""' ?>><i class="i">&#xE5CC</i><span class="t">Atur User</span></li></a>
                    <li><i class="i">&#xE5CC</i><span class="t">Atur Rekening</span></li>
                </ul>
                </li>
                <?php endif ?>
                <a href="<?= base_url('logout') ?>"><li><i class="i">&#xE9BA</i><span class="t">Keluar</span></li></a>
            </ul>
    </aside>
    <div class="grid-dashboard-3">
        <header class="header-desktop header-dashboard">
            <h1>Aplikasi Pengelola Infaq SMP Ma'arif NU 01 Wanareja</h1>
            <button class="tombol secondary"><img src="<?= base_url('/assets/pic.webp') ?>" alt=""><?php echo $name ?></button>
        </header>
        <div class="content">
            <div class="breadcrumb">
                <h1><?= $title ?></h1>
                <div class="spacer"></div>
            </div>
            
            
            


