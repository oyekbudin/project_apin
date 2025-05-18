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
    </div>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?= config('Midtrans')->clientKey ?>"></script>
<script>
    document.getElementById('pay-button').onclick = function() {
        snap.pay('<?= $snapToken ?>', {
            language: 'id',
            onSuccess: function(result) {
                console.log(result);
            },
            onPending: function(result) {
                console.log(result);
            },
            onError: function(result) {
                console.log(result);
            }
        });
    };
</script>
<?= $this->include('closing') ?>