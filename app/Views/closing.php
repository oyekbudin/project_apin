</div>
    </div>
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