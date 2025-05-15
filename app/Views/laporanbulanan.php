<?= $this->include('dashboardadministrator') ;?>
<div class="board-wrap">
<div class="group-action">
    <div>
    <span>Pilih Bulan :</span>
    <select name="bulan" id="bulan" class="input">
        <option value="">Pilih Bulan</option>
        <option value="01">Januari</option>
        <option value="02">Februari</option>
        <option value="03">Maret</option>
        <option value="04">April</option>
        <option value="05">Mei</option>
        <option value="06">Juni</option>
        <option value="07">Juli</option>
        <option value="08">Agustus</option>
        <option value="09">September</option>
        <option value="10">Oktober</option>
        <option value="11">November</option>
        <option value="12">Desember</option>
    </select>
    </div>


</div>
<!-- PDF -->
 <div class="" id="pdf-preview">
 </div>
<!--iframe id="iframe-laporan" src="" frameborder="0" width="100%" height="400px"></iframe-->
    
    </div>

    <script>/*
document.getElementById('bulan').addEventListener('change', function() {
    let bulan = this.value;
    if (bulan !== '') {
        document.getElementById('iframe-laporan').src = '/pdf/laporanbulanan/' + bulan;
    }
}); */
</script>
<script>
document.getElementById('bulan').addEventListener('change', function () {
    const bulan = this.value;
    const container = document.getElementById('pdf-preview');

    if (bulan) {
        container.innerHTML = `<iframe src="/pdf/laporanbulanan/${bulan}" width="100%" height="400px" frameborder="0"></iframe>`;
    } else {
        container.innerHTML = '<p>Silakan pilih bulan untuk melihat laporan.</p>';
    }
});
</script>
<?= $this->include('closing') ;?>