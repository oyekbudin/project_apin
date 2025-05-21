<?= $this->include('dashboard-walimurid') ?>

<div class="board-wrap">
    <div class="dataonly">
    <table>
        <tbody>
            <tr>
            <td style="font-weight: bold;">Nama Lengkap</td>
            <td><?= $nama?></td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Kelas</td>
            <td><?= $kelas?></td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Total Pembayaran</td>
            <td class="data-title"><?= 'Rp ' . number_format($total_pembayaran, 0, ',', '.') ?></td>
        </tr> 
        </tbody>         
    </table>
     <button class="tombol primarydark" id="pay-button">Bayar Sekarang</button>
     <a href="<?= base_url('m-pembayaran/checkout/cancel/' . $order_id) ?>" class="tombol primary-outline">Batalkan Transaksi</a>   
    </div>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?= config('Midtrans')->clientKey ?>"></script>
<script>
    document.getElementById('pay-button').onclick = function() {
        snap.pay('<?= $snaptoken ?>', {
            language: 'id',
            onSuccess: function(result) {
                //console.log(result);
                window.location.href = '<?= base_url('dashboard-walimurid') ?>';
            },
            onPending: function(result) {
                console.log(result);
            },
            onError: function(result) {
                fetch('<?= base_url('midtrans/log-error') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify(result)
                })
                .then(response => response.text())
                .then(data => {
                    alert("Terjadi kesalahan saat pembayaran. Silakan coba lagi.");
                    console.log("Server response:", data);
                })
                .catch(err => console.error("Fetch error:", err));
            }
        });
    };
</script>
<?= $this->include('closing') ?>