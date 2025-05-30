<?php $session = session(); 
    $name = $session->get('name');
    $role = $session->get('role');
?>
<?= $this->include('header') ?>
<body class="grid-dashboard-1">
    <main class="grid-dashboard-2">
        <div class="dashboard-mobile">
            <div class="logo">
                <img src="<?= base_url('/assets/icon.webp') ?>" alt="">
            </div>
            <div class="profil-mobile">
                <button id="profilButton" onclick="window.location.href='<?= base_url('profil/edit/' . session()->get('idadmin')) ?>'">
                    <img src="<?= base_url('/assets/pic.webp') ?>" alt="">
                </button>
            </div>
        </div>
        <aside class="aside-dashboard">
            <div class="logo">
                <img src="<?= base_url('/assets/icon.webp') ?>" alt="">
            </div>          
            <ul>
                <a href="<?= base_url('dashboardadministrator') ?>"><li <?= ($menu == 'Dashboard') ? 'class="on"' : 'class=""' ?>><i class="i">&#xE88A</i><span class="t">Dashboard</span><i class="i"></i></li></a> 
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
                    <a href="<?= base_url('request_tagihan') ?>"><li <?= ($title == 'Tagihan') ? 'class="on"' : 'class=""' ?>><i class="i">&#xE5CC</i><span class="t">Tagihan</span></li></a>
                </ul>
                </li>
                <li <?= ($menu == 'Pelaporan') ? 'class="on"' : 'class=""' ?>><i class="i">&#xE555</i><span class="t">Pelaporan</span><i class="i">&#xE313</i>
                <ul <?= ($menu == 'Pelaporan') ? 'style="display:block;"' : 'style="display:none;"' ?>>
                    <a href="<?= base_url('laporanbulanan') ?>"><li <?= ($title == 'Laporan Bulanan') ? 'class="on"' : 'class=""' ?>><i class="i">&#xE5CC</i><span class="t">Laporan Bulanan</span></li></a>
                    <a href="<?= base_url('laporantahunan') ?>"><li <?= ($title == 'Laporan Tahunan') ? 'class="on"' : 'class=""' ?>><i class="i">&#xE5CC</i><span class="t">Laporan Tahunan</span></li></a>
                </ul>
                </li>
                <?php if ($role != 'KepalaSekolah' && $role !='Bendahara') : ?>
                <li <?= ($menu == 'Pengaturan') ? 'class="on"' : 'class=""' ?>><i class="i">&#xE8B8</i><span class="t">Pengaturan</span><i class="i">&#xE313</i>
                <ul <?= ($menu == 'Pengaturan') ? 'style="display:block;"' : 'style="display:none;"' ?>>
                    <a href="<?= base_url('registeradministrator') ?>"><li <?= ($title == 'Atur User') ? 'class="on"' : 'class=""' ?>><i class="i">&#xE5CC</i><span class="t">Atur User</span></li></a>
                    <a href="<?= base_url('aturrekening') ?>"><li <?= ($title == 'Atur Rekening') ? 'class="on"' : 'class=""' ?>><i class="i">&#xE5CC</i><span class="t">Atur Rekening</span></li></a>
                </ul>
                </li>
                <?php endif ?>
                <a href="<?= base_url('logout') ?>"><li><i class="i">&#xE9BA</i><span class="t">Keluar</span><i class="i"></i></li></a>
            </ul>
    </aside>
    <div class="grid-dashboard-3">
        <header class="header-desktop header-dashboard mobile">
            <h1>Aplikasi Pengelola Infaq SMP Ma'arif NU 01 Wanareja</h1>
            <div>
                <button id="profilButtonDesktop" class="tombol secondary"><img src="<?= base_url('/assets/pic.webp') ?>" alt=""><span class="t"><?php echo $name ?></span></button>
            <div id="profil">
                <ul>
                    <a href="/profil/edit/<?= session()->get('idadmin') ?>"><li><i class="i">&#xF02E</i><span class="t">Edit Profil</span></li></a>
                    <a href="<?= base_url('logout') ?>"><li><i class="i">&#xE9BA</i><span class="t">Keluar</span></li></a>
                </ul>
            </div>
            </div>
            
        </header>
        <div class="content">
            <div class="breadcrumb">
                <h1><?= $title ?></h1>
                <div class="spacer"></div>
            </div>
            
            
            


