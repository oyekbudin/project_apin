<?= $this->include('dashboard-walimurid') ?>

<?php $session = session(); 
            $name = $session->get('name');
            ?>

<div class="grid-board">
    <div class="board-1">
        <form action="m-pembayaran/checkout">
            <div class="list-tagihan">
                <ul>
                    <?php $adaTagihan = false; ?>
                    <?php foreach($tagihan as $t) : ?>
                        <?php if($t['sisa_tagihan'] != 0) : ?>
                            <?php $adaTagihan = true; ?>
                    <li>
                        <input class="cek-tagihan" type="checkbox" name="infaq_id[]" id="<?= $t['id_infaq'] ?>" value="<?= $t['id_infaq'] ?>" data-sisa="<?= $t['sisa_tagihan'] ?>">
                        <label for="<?= $t['id_infaq'] ?>"><span><?= $t['nama_infaq'] ?></span><span class="txtbold"><?= 'Rp ' . number_format($t['sisa_tagihan'], 0, ',', '.') ?></span></label>
                    </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>       
            </div>
            <?php if($adaTagihan == true) : ?>
            <div class="checkout">
                <div id="selectAll">
                    <input class="" type="checkbox" name="#" id="checkAll" value="#">
                <label for="checkAll"><span>Pilih semua</span></label>
                </div>
                <div id="bayar">
                    <span class="">Total<br><span id="totalBayar">Rp. 0</span></span>
                    <button class="tombol primarylight" id="pay-button">Bayar</button>
                    <input type="hidden" id="nilaiTotal" name="nilaiTotal">
                </div>
            </div>
        </form>
        <?php else : ?>
            <div class="list-tagihan">
            <ul>
                <li><span class="txtdisable no-tagihan">Belum ada tagihan terbaru</span></li>
            </ul>
            
        <?php endif; ?>
    </div>
</div>

<script>/*
    document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = document.querySelectorAll('.cek-tagihan');
        const totalDisplay = document.getElementById('totalBayar');
        const checkAll = document.getElementById('checkAll');

        // Fungsi untuk menghitung total
        function hitungTotal() {
            let total = 0;
            checkboxes.forEach(cb => {
                if (cb.checked) {
                    total += parseInt(cb.dataset.sisa);
                }
            });
            totalDisplay.textContent = 'Rp ' + total.toLocaleString('id-ID');
        }

        // Event setiap checkbox berubah
        checkboxes.forEach(cb => {
            cb.addEventListener('change', function () {
                // Update total
                hitungTotal();

                // Jika semua dicentang, otomatis centang "Pilih Semua"
                checkAll.checked = [...checkboxes].every(c => c.checked);
            });
        });

        // Event untuk "Pilih Semua"
        checkAll.addEventListener('change', function () {
            checkboxes.forEach(cb => cb.checked = this.checked);
            hitungTotal();
        });
    });*/
</script>


<script> 
    document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = document.querySelectorAll('.cek-tagihan');
        const totalDisplay = document.getElementById('totalBayar');
        const checkAll = document.getElementById('checkAll');
        const hiddenTotal = document.getElementById('nilaiTotal');

        function hitungTotal() {
            let total = 0;
            checkboxes.forEach(cb => {
                if (cb.checked) {
                    total += parseInt(cb.dataset.sisa);
                }
            });
            totalDisplay.textContent = 'Rp ' + total.toLocaleString('id-ID');
            hiddenTotal.value = total;
        }

        checkboxes.forEach(cb => {
            cb.addEventListener('change', function () {
                hitungTotal();
                checkAll.checked = [...checkboxes].every(c => c.checked);
            });
        });

        checkAll.addEventListener('change', function () {
            checkboxes.forEach(cb => cb.checked = this.checked);
            hitungTotal();
        });
/*
        // Event klik tombol Bayar
        document.getElementById('pay-button').addEventListener('click', function () {
            const totalTagihan = parseInt(hiddenTotal.value);

            if (!totalTagihan || totalTagihan <= 0) {
                alert('Silakan pilih tagihan yang ingin dibayar.');
                return;
            }

            // Kirim ke controller untuk generate SnapToken
            $.post("<?//= base_url('m-pembayaran/snap_token') ?>", { total_tagihan: totalTagihan }, function (snapToken) {
                snap.pay(snapToken, {
                    onSuccess: function (result) {
                        alert("Pembayaran berhasil!");
                        console.log(result);
                    },
                    onPending: function (result) {
                        alert("Menunggu pembayaran...");
                        console.log(result);
                    },
                    onError: function (result) {
                        alert("Pembayaran gagal.");
                        console.log(result);
                    }
                });
            });
        });*/
    }); 
</script>



<?= $this->include('closing') ?>