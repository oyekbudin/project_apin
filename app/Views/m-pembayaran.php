<?= $this->include('dashboard-walimurid') ?>

<?php $session = session(); 
            $name = $session->get('name');
            ?>

<div class="grid-board">
    <div class="board-1">
        <div class="list-tagihan">
            <ul>
                <?php foreach($tagihan as $t) : ?>
                <li>
                    <input class="cek-tagihan" type="checkbox" name="infaq_id[]" id="<?= $t['id_infaq'] ?>" value="<?= $t['id_infaq'] ?>" data-sisa="<?= $t['sisa_tagihan'] ?>">
                    <label for="<?= $t['id_infaq'] ?>"><span><?= $t['nama_infaq'] ?></span><span class="txtbold"><?= 'Rp ' . number_format($t['sisa_tagihan'], 0, ',', '.') ?></span></label>
                </li>
                <?php endforeach; ?>
            </ul>       
        </div>
        <div class="checkout">
            <div id="selectAll">
                <input class="" type="checkbox" name="#" id="checkAll" value="#">
            <label for="checkAll"><span>Pilih semua</span></label>
            </div>
            <div id="bayar">
                <span class="">Total<br><span id="totalBayar">Rp. 0</span></span>
                <button class="tombol primarylight">Bayar</button>
            </div>
        </div>
    </div>
</div>

<?= $this->include('closing') ?>