</div>
    </div>
    <?php if(isset($role)) : ?>
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
    <?php endif; ?>
    </main>
    <script>
    document.querySelectorAll('ul li').forEach(function(li) {
        li.addEventListener('click', function() {
            li.querySelector('ul').style.display = li.querySelector('ul').style.display === 'block' ? 'none' : 'block';
        });
    });
</script>
    <footer class="footer-desktop footer-dashboard mobile">
<?= $this->include('footer') ?>