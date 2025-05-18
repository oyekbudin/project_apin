<?= $this->include('dashboardadministrator') ?>
<div class="board-wrap">
<div class="group-action-tombol">
<button class="tombol secondary" onclick="history.back()">Kembali</button>
</div>
<div class="divider"></div>
<div class="tablemobile">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Order ID</th>
                <th>Status</th>
                <th>Total pembayaran</th>
                <th>Jenis pembayaran</th>
                <th>Waktu transaksi</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="7">Notifikasi akan ditampilkan di sini</td>
            </tr>
        </tbody>
    </table> 
    </div>
    </div>
<!-- Modal -->
<?= $this->include('closing') ?>