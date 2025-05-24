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
                    <h5>Silahkan Masuk Untuk Memulai Aplikasi</h5>
                    
                    
                    <form action="/loginadministrator/auth" method="post" class="form-login">
                        <label for="adminname">User Name</label>
                        <input class="input" type="text" name="adminname" id="inputadminname" value="<?= set_value('adminname') ?>" placeholder="User Name" required oninvalid="this.setCustomValidity('Masukkan Username')" oninput="this.setCustomValidity('')">
                        <label for="Password">Password</label>
                        <input class='input' type="password" name="password" id="inputpassword" placeholder="Password" required oninvalid="this.setCustomValidity('Masukkan Password')" oninput="this.setCustomValidity('')">
                        <?php if(session()->getFlashdata('msg')):?>
                        <span class="txtdanger"><?= session()->getFlashdata('msg') ?></span>
                        <?php endif;?>
                        <button type="submit" class="tombol primary">Masuk</button>
                    </form>
                    <a class="tombol primary-outline" href="<?= base_url('/') ?>">Masuk Sebagai Wali Murid</a>
                </div>
            </div>
        </div>
        </main>
    <footer class="footer-desktop footer-login">
<?= $this->include('footer') ?>