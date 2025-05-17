<?php $session = session(); 
    $name = $session->get('name');
    $role = $session->get('role');
?>
<?= $this->include('header') ?>
<body class="grid-dashboard-1">
    <main class="grid-dashboard-2">
        <div class="dashboard-mobile" id="<?= $title ?>">
            <?php if($title === 'Home') : ?>
            <div class="logo">
                <img src="<?= base_url('/assets/pic.webp') ?>" alt="">
            </div>            
            <div class="nama-mobile">
                <span class="t"><?php echo $name ?></span>
            </div>
            <div class="bantuan-mobile">
                <i class="i">&#xE24C</i>
                <span class="t">Pusat<br>bantuan</span>
            </div>
            <?php else : ?>
                <div class="group-action">
                    <a onclick="history.back()">
                        <i class="i">&#xE5C4</i>
                    </a>            
                    <h2 class="data-title"><?= $title ?></h2>
                </div>
            <?php endif; ?>
        </div>
        <aside class="aside-dashboard">
            <div class="logo">
                <img src="<?= base_url('/assets/icon.webp') ?>" alt="">
            </div>          
            <ul>
                <a href="<?= base_url('dashboard-walimurid') ?>">
                    <li <?= ($menu == 'Home') ? 'class="on"' : 'class=""' ?>>
                        <i class="i">&#xE88A</i>
                        <span class="t">Home</span>
                        <i class="i"></i>
                    </li>
                </a>
                <a href="<?= base_url('m-pembayaran') ?>">
                    <li <?= ($menu == 'Pembayaran') ? 'class="on"' : 'class=""' ?>>
                        <i class="i">&#xE850</i>
                        <span class="t">Pembayaran</span>
                        <i class="i"></i>
                    </li>
                </a> 
                <a href="/m-profil/edit/<?= session()->get('nis') ?>">
                    <li <?= ($menu == 'Profil') ? 'class="on"' : 'class=""' ?>>
                        <i class="i">&#xE7FD</i>
                        <span class="t">Profil</span>
                        <i class="i"></i>
                    </li>
                </a> 
                
            </ul>
    </aside>
    <div class="grid-dashboard-3">
        <header class="header-desktop header-dashboard mobile">
            <h1>Aplikasi Pengelola Infaq SMP Ma'arif NU 01 Wanareja</h1>
            <div>
                <button id="profilButton" class="tombol secondary"><img src="<?= base_url('/assets/pic.webp') ?>" alt=""><span class="t"><?php echo $name ?></span></button>
            <div id="profil">
                <ul>
                    <a href="/profil/edit/<?= session()->get('idadmin') ?>"><li><i class="i">&#xF02E</i><span class="t">Edit Profil</span></li></a>
                    <a href="<?= base_url('logout') ?>"><li><i class="i">&#xE9BA</i><span class="t">Keluar</span></li></a>
                </ul>
            </div>
            </div>
            
        </header>
        <div class="content">
            
            
            


