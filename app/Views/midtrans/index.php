<button id="pay-button">Bayar Sekarang</button>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?= config('Midtrans')->clientKey ?>"></script>
<script>
    document.getElementById('pay-button').onclick = function() {
        snap.pay('<?= $snapToken ?>', {
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