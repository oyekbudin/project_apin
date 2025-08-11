    
        <span>Aplikasi Pengelola Infaq </span><span class="txtwarning">Versi 1.2.0 </span><span>, Arvin Noer Hakim | 215720010 STMIK KOMPUTAMA MAJENANG 2025</span>
    </footer>
    <script> /*
  if (typeof navigator.serviceWorker !== 'undefined') {
    navigator.serviceWorker.register('sw.js')
  } */
</script>

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
    function onmodalFilter()
    {
        document.getElementById("modalFilter").style.display = "flex";
        document.querySelectorAll('#modalFilter input[type="text"], #modalFilter input[type="number"], #modalFilter select').forEach(function(element)
    {
        if (element.type === 'select-one')
    {
        element.selectedIndex = 0;
    } else {
        element.value = '';
    }
    });
        
    }

    function offmodalFilter()
    {
        document.getElementById("modalFilter").style.display = "none";
        document.querySelectorAll('#modalFilter input[type="text"], #modalFilter input[type="number"], #modalFilter select').forEach(function(element)
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
    document.getElementById('selectAllSiswa').addEventListener('change', function()
{
    var checkboxes = document.querySelectorAll('.listsiswa');
    checkboxes.forEach(function(checkbox)
{
    checkbox.checked = document.getElementById('selectAllSiswa').checked;
});
});
</script>


<!-- checkbox tabel -->
<script>
    let selectedItems = [];
    
    function updateSelectedCount()
    {
        var checkboxes = document.querySelectorAll('.listsiswa');
        selectedItems = [];
        var selectedCount = 0;
        checkboxes.forEach(function(checkbox)
    {
        if (checkbox.checked)
        {
            selectedItems.push(checkbox.value);
            selectedCount++;
        }
    });
        document.getElementById('selectedCount').innerText = selectedCount + ' terpilih';
    }

    document.getElementById('selectAllSiswa').addEventListener('change', function()
    {
    var checkboxes = document.querySelectorAll('.listsiswa');
    checkboxes.forEach(function(checkbox)
        {
            checkbox.checked = document.getElementById('selectAllSiswa').checked;
        });

        updateSelectedCount();
    });

    var checkboxes = document.querySelectorAll('.listsiswa');
    checkboxes.forEach(function(checkbox)
{
    checkbox.addEventListener('change', updateSelectedCount);
});

updateSelectedCount();

// button export-tagihan
document.getElementById('export-tagihan').addEventListener('click', function()
{
    if (selectedItems.length >0)
    {
        fetch('/pdf/tagihanlist', 
            {
                method: 'POST',
                headers: 
                {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({selectedItems: selectedItems})
            }
        )
        
        .then(response => response.json())
        .then(data => {
            window.open(data.pdf_url, '_blank');
        })
        .catch(error => console.error(error))
    } else {
        alert('Tidak ada data yang dipilih');
    }
});

// button export-tagihan-siswa
document.getElementById('export-tagihan-siswa').addEventListener('click', function()
{
    if (selectedItems.length >0)
    {
        fetch('/pdf/tagihansiswalist', 
            {
                method: 'POST',
                headers: 
                {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({selectedItems: selectedItems})
            }
        )
        
        .then(response => response.json())
        .then(data => {
            window.open(data.pdf_url, '_blank');
        })
        .catch(error => console.error(error))
    } else {
        alert('Tidak ada data yang dipilih');
    }
});

// button kirim-tagihan
    
document.getElementById('kirim_tagihan').addEventListener('click', function()
{
    const header = document.getElementById('headerwa').value;
    const footer = document.getElementById('footerwa').value;
    if (selectedItems.length >0)
    {
        if (header.length > 0)
        {
            if (footer.length > 0)
            {
                        fetch('/tagihan/listkirim', 
                    {
                        method: 'POST',
                        headers: 
                        {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({header: header, footer: footer, selectedItems: selectedItems})
                    }
                )
                
                .then(response => response.json())
                .then(data => {
                    window.open(data.kirim_url, '_blank');
                })
                .catch(error => console.error(error))
            } else {
                alert('Kalimat penutup tidak boleh kosong');
            }
        } else {
            alert('Kalimat pembuka tidak boleh kosong');
        }
        
    } else {
        alert('Tidak ada data yang dipilih');
    }
});

</script>

<!-- clear search in tagihan -->
 <script>
    document.getElementById('clear-search').addEventListener('click', function(e)
{
    e.preventDefault();
    document.getElementById('search').value = '';
    //document.getElementById('search').focus();

    fetch('?keyword=', {        
            method: 'GET',
        })
        .then(response => response.json())
        .then(data => console.log(data))
        .catch(error => console.error(error));
    
});
 </script>





