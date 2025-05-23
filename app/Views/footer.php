    
        <span>Aplikasi Pengelola Infaq </span><span class="txtwarning">Versi 1.1.0 </span><span>, Arvin Noer Hakim | 215720010 STMIK KOMPUTAMA MAJENANG 2025</span>
    </footer>
</body>
</html>

<?php if (session()->getFlashdata('success')) : ?>
<script>
    toastr.success("<?= session()->getFlashdata('success') ?>");
</script>
<?php endif; ?>

<?php if (session()->getFlashdata('msg')) : ?>
<script>
    toastr.error("<?= session()->getFlashdata('msg') ?>");
</script>
<?php endif; ?>



<script>
    function onmodalTambah()
    {
        document.getElementById("modalTambah").style.display = "flex";
        document.querySelectorAll('#modalTambah input[type="text"], #modalTambah input[type="number"], #modalTambah select').forEach(function(element)
    {
        if (element.type === 'select-one')
    {
        element.selectedIndex = 0;
    } else {
        element.value = '';
    }
    });
        
    }

    function offmodalTambah()
    {
        document.getElementById("modalTambah").style.display = "none";
        document.querySelectorAll('#modalTambah input[type="text"], #modalTambah input[type="number"], #modalTambah select').forEach(function(element)
    {
        if (element.type === 'select-one')
    {
        element.selectedIndex = 0;
    } else {
        element.value = '';
    }
    });
    }

    function onmodalEdit() {
        document.getElementById("modalTambah").style.display = "flex";
    }

    function offmodalEdit() {
        document.getElementById("modalTambah").style.display = "none";
    }
</script>
<script>
    /*function onProfil()
    {
        document.getElementById("profil").style.display = "flex";        
    }

    function offProfil()
    {
        
    }
    if (document.getElementById("profil").style.display === "flex") {
        document.body.addEventListener("click", function() {
        document.getElementById("profil").style.display = "none";
    });
    }*/
    

    /*if (document.getElementById("profil").style.display === "flex")
    {
        document.addEventListener("click", function() {
            offProfil();
        });
    }*/

   /*const profilElement = document.getElementById("profil");

   const observer = new MutationObserver((mutations) => {
    if (profilElement.style.display === "flex") {
        profilElement.addEventListener("click", offProfil);
    } else {
        profilElement.removeEventListener("click", offProfil);
    }
   });

   observer.observe(profilElement, {
    attributes: true,
   }); */
</script>

<script>
    document.getElementById("profilButtonDesktop").addEventListener("click", function() {
        const profilMenu = document.getElementById("profil");
        if (profilMenu.style.display === 'flex') {
            profilMenu.style.display = "none";
        } else {
            profilMenu.style.display = "flex";
        }
    });

    document.addEventListener("click", function(event) {
        const profilButton = document.getElementById("profilButtonDesktop");
        const profilMenu = document.getElementById("profil");
        if (!profilButton.contains(event.target) && !profilMenu.contains(event.target)) {
            profilMenu.style.display = "none";
        }
    });
</script>

<?php if (isset($on) && $on): ?>
    <script>
        document.addEventListener("DOMContentLoaded", function ()
    {
        document.getElementById("modalTambah").style.display = "flex";
    });
    </script>
<?php endif; ?>

<?php if (session()->getFlashdata('show_modal')) : ?>
    <script>
        document.addEventListener("DOMContentLoaded", function ()
    {
        document.getElementById("modalTambah").style.display = "flex";
    });
    </script>
<?php endif ?>


<script>/*
    document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = document.querySelectorAll('.cek-tagihan');
        const totalDisplay = document.getElementById('totalBayar');

        function hitungTotal() {
            let total = 0;
            checkboxes.forEach(cb => {
                if (cb.checked) {
                    total += parseInt(cb.dataset.sisa);
                }
            });
            totalDisplay.textContent = 'Rp ' + total.toLocaleString('id-ID');
        }

        checkboxes.forEach(cb => {
            cb.addEventListener('change', hitungTotal);
        });
    });*/
</script>

<script> /*
    const checkAll = document.getElementById('checkAll');
checkAll.addEventListener('change', function () {
    checkboxes.forEach(cb => cb.checked = this.checked);
    hitungTotal();
}); */

</script>

<script>
  if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/service-worker.js')
      .then(() => console.log('Service Worker registered'))
      .catch(error => console.log('Service Worker registration failed:', error));
  }
</script>





