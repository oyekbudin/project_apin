<?= $this->include('dashboardadministrator') ?>
<div id="modalTambah" class="black-board">
        <div class="pop">
            <div class="group-action"><h2 class="data-title">Persetujuan Tagihan</h2><a onclick="history.back()"> <i class="i" onclick="offmodalTambah()">&#xe14c</i></a> </div>
            <div class="divider"></div>
            <div class="overflow-content">
            <form action="/request_tagihan/update/<?= $datarequest['id'] ?>" method="post">
                
                    <div class="tombol green">DATA TAGIHAN</div>    
                    <table>
                    <tbody>
                        <tr>
                            <td>Judul Tagihan</td>
                            <td>
                                : <?= $datarequest['title'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td>
                                : <?= $datarequest['date'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Dibuat oleh</td>
                            <td>
                                : <?= $datarequest['nama_admin'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>
                                <?php
                                switch ($datarequest['status']) {
                                    case 'pending' :
                                        $label = 'Menunggu Persetujuan';
                                        $color = 'txtwarning';
                                        break;
                                    case 'accepted' :
                                        $label = 'Disetujui';
                                        $color = 'txtgreen';
                                        break;
                                    case 'rejected' :
                                        $label = 'Ditolak';
                                        $color = 'txtred';
                                        break;
                                };
                                ?>
                                : <span class="<?= $color ?>"><?= $label ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Data Infaq</td>
                            <td>
                                : <ol>
                            <?php
                            $nama_infaq = explode(',',str_replace(['{', '}', '"'], '', $datarequest['nama_infaq']));
                            foreach ($nama_infaq as $infaq) {
                                echo "<li>$infaq</li>";
                            }
                            ?>
                                </ol>
                           </td>
                        </tr>
                    </tbody>
                    </table>
                
                <div class="divider"></div>
                <div class="group-action">
                <?php
                    $role = $session['role'];
                    if ($datarequest['status'] == 'pending') {
                        switch ($role) {
                            case 'Bendahara' :
                                $action =
                                [
                                    '<a class="tombol disable" onclick="history.back()">Close</a>'
                                ];
                                break;
                            case 'SistemAdmin' || 'KepalaSekolah' :
                                $action =
                                [
                                    '<a class="tombol disable" onclick="history.back()">Close</a>
                                    <button class="tombol red" type="submit" name="status" value="rejected">Tolak</button>
                                    <button class="tombol primary" type="submit" name="status" value="accepted">Setujui</button>'
                                ];
                                break;
                        };
                    } else {
                        $action =
                                [
                                    '<a class="tombol disable" onclick="history.back()">Close</a>'
                                ];
                    };

                    foreach ($action as $act) {
                        echo $act;
                        //echo $role;
                    };
                    ?>
                
                </div>
                
            </form>
            </div>
    </div>
</div>
<?= $this->include('closing') ?>