<?= $this->include('dashboard-walimurid') ?>

<?php $session = session(); 
            $name = $session->get('name');
            $role = $session->get('role');
            ?>

<div class="grid-board">
    <div class="board-1">
        <div class="list-tagihan">
            <ul>
                <li>
                    <input class="" type="checkbox" name="#" id="#" value="#">
                    <label for="#"><span>Infaq Juli</span><span class="txtbold">Rp. 45.000</span></label>
                </li>
                <li>
                    <input class="" type="checkbox" name="#" id="#" value="#">
                    <label for="#"><span>Infaq Juli</span><span class="txtbold">Rp. 45.000</span></label>
                </li>
                <li>
                    <input class="" type="checkbox" name="#" id="#" value="#">
                    <label for="#"><span>Infaq Juli</span><span class="txtbold">Rp. 45.000</span></label>
                </li>
                <li>
                    <input class="" type="checkbox" name="#" id="#" value="#">
                    <label for="#"><span>Infaq Juli</span><span class="txtbold">Rp. 45.000</span></label>
                </li>
                <li>
                    <input class="" type="checkbox" name="#" id="#" value="#">
                    <label for="#"><span>Infaq Juli</span><span class="txtbold">Rp. 45.000</span></label>
                </li>
                <li>
                    <input class="" type="checkbox" name="#" id="#" value="#">
                    <label for="#"><span>Infaq Juli</span><span class="txtbold">Rp. 45.000</span></label>
                </li>
                <li>
                    <input class="" type="checkbox" name="#" id="#" value="#">
                    <label for="#"><span>Infaq Juli</span><span class="txtbold">Rp. 45.000</span></label>
                </li>
                <li>
                    <input class="" type="checkbox" name="#" id="#" value="#">
                    <label for="#"><span>Infaq Juli</span><span class="txtbold">Rp. 45.000</span></label>
                </li>
            </ul>       
        </div>
        <div class="checkout">
            <div id="selectAll">
                <input class="" type="checkbox" name="#" id="#" value="#">
            <label for="#"><span>Pilih semua</span></label>
            </div>
            <div id="bayar">
                <span class="">Total<br>Rp. 195.000</span>
                <button class="tombol primarylight">Bayar</button>
            </div>
        </div>
    </div>
</div>

<?= $this->include('closing') ?>