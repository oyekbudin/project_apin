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
                <th>#</th>
                <th>Order ID</th>
                <th>Status</th>
                <th>Code</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <?php if($error) :
                $i = 1;
                foreach($error as $e) : ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= esc($l['order_id']) ?></td>
                        <td><?= esc($l['status_message']) ?></td>
                        <td><?= esc($l['status_code']) ?></td>
                        <td><?= date('d-m-Y H:i', strtotime($l['created_at'])) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
            <tr>
                <td colspan="5">Log Error akan ditampilkan di sini</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table> 
    </div>
    </div>
<!-- Modal -->
<?= $this->include('closing') ?>