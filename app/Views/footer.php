    
        <span>Aplikasi Pengelola Infaq </span><span class="txtwarning">Versi Alpha </span><span>, Arvin Noer Hakim | 215720010 STMIK KOMPUTAMA MAJENANG 2025</span>
    </footer>
</body>
</html>



<script>
    function onmodalTambah()
    {
        document.getElementById("modalTambah").style.display = "flex";
    }

    function offmodalTambah()
    {
        document.getElementById("modalTambah").style.display = "none";
        document.querySelectorAll('#modalTambah input, #modalTambah select').forEach(function(element)
    {
        if (element.type === 'select-one')
    {
        element.selectedIndex = 0;
    } else {
        element.value = '';
    }
    });
    }
</script>

<?php if (isset($on) && $on): ?>
    <script>
        document.addEventListener("DOMContentLoaded", function ()
    {
        document.getElementById("modalTambah").style.display = "flex";
    });
    </script>
<?php endif; ?>

