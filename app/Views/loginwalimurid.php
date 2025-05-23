<?= $this->include('header') ?>
<body class="grid-login">
    <header class="header-desktop header-login">
        <h1>Aplikasi Pengelola Infaq SMP Ma'arif NU 01 Wanareja</h1>
        <ul>
            <li class="tombol secondary">Panduan Aplikasi</li>
            <!--li class="tombol primary">Masuk</li>
            <li class="tombol secondary">Reset Password</li-->
        </ul>
    </header>
    <main class="main-desktop main-login">
        <div class="container-login">
            <div class="item-login1">
                <img class="banner-login" src="<?= base_url('/assets/banner.webp') ?>" alt="">
            </div>
            <div class="item-login2">
                <div class="wrap-login">
                    <h2>MASUK</h2>
                    <div class="divider"></div>
                    <h5>Selamat Datang Bapak/Ibu Wali Murid! <br>Silahkan masukkan NIS dan Nomor Whatsapp untuk mulai menjalankan aplikasi</h5>
                    
                    <form action="/loginwalimurid/auth" method="post" class="form-login">
                        <label for="nis">Nomor Induk Siswa / NIS</label>
                        <input class="input" type="text" name="nis" id="" value="<?= set_value('nis') ?>" placeholder="Masukkan NIS" required oninvalid="this.setCustomValidity('Masukkan NIS')" oninput="this.setCustomValidity('')">
                        <label for="phonenumber">Nomor Whatsapp</label>
                        <input class='input' type="text" name="phonenumber" id="" placeholder="Masukkan Nomor Whatsapp" required oninvalid="this.setCustomValidity('Masukkan Nomor Whatsapp')" oninput="this.setCustomValidity('')">
                        <?php if(session()->getFlashdata('msg')):?>
                        <span class="txtdanger"><?= session()->getFlashdata('msg') ?></span>
                        <?php endif;?>
                        <button type="submit" class="tombol primary">Masuk</button>
                    </form>
                    <a class="tombol primary-outline" href="<?= base_url('loginadministrator') ?>">Masuk Sebagai Guru</a>
                </div>
            </div>
        </div>
        </main>
    <footer class="footer-desktop footer-login">
<?= $this->include('footer') ?>