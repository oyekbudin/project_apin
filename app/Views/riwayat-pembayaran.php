<?= $this->include('dashboard-walimurid') ?>

<?php $session = session(); 
            $name = $session->get('name');
            ?>

<div class="grid-board">
    <div class="board-1">
        <div class="board-wrap primarylight">
        <div class="wrap-rekap">
            <div class="card-3 primarydark">
                <span class="data-subtitle">Sisa tagihan</span>
                <span class="data-title">Rp. 8.238.000</span>                
            </div>
        </div>
        </div>
    </div>

    <div class="board-2">
        <div class="board-wrap">
        <h3>Catatan Pembayaran</h3>
        <div class="divider"></div>
            <div class="tablemobile">
                <table>
                    <tbody>
                        <tr>
                            <td>10/05/2025</td>
                            <td>Infaq Mei</td>
                            <td class="txtgreen">45.000</td>
                        </tr>
                        <tr>
                            <td>10/05/2025</td>
                            <td>Infaq Mei</td>
                            <td class="txtgreen">45.000</td>
                        </tr>
                        <tr>
                            <td>10/05/2025</td>
                            <td>Infaq Mei</td>
                            <td class="txtgreen">45.000</td>
                        </tr>
                        <tr>
                            <td>10/05/2025</td>
                            <td>Infaq Mei</td>
                            <td class="txtgreen">45.000</td>
                        </tr>
                        <tr>
                            <td>10/05/2025</td>
                            <td>Infaq Mei</td>
                            <td class="txtgreen">45.000</td>
                        </tr>
                        <tr>
                            <td>10/05/2025</td>
                            <td>Infaq Mei</td>
                            <td class="txtgreen">45.000</td>
                        </tr>
                        <tr>
                            <td>10/05/2025</td>
                            <td>Infaq Mei</td>
                            <td class="txtgreen">45.000</td>
                        </tr>
                        <tr>
                            <td>10/05/2025</td>
                            <td>Infaq Mei</td>
                            <td class="txtgreen">45.000</td>
                        </tr>
                        <tr>
                            <td>10/05/2025</td>
                            <td>Infaq Mei</td>
                            <td class="txtgreen">45.000</td>
                        </tr>
                        <tr>
                            <td>10/05/2025</td>
                            <td>Infaq Mei</td>
                            <td class="txtgreen">45.000</td>
                        </tr>
                        <tr>
                            <td>10/05/2025</td>
                            <td>Infaq Mei</td>
                            <td class="txtgreen">45.000</td>
                        </tr>
                        <tr>
                            <td>10/05/2025</td>
                            <td>Infaq Mei</td>
                            <td class="txtgreen">45.000</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->include('closing') ?>