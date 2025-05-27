<?= $this->include('dashboardadministrator') ?>

<?php 
        $idadmin = $session['idadmin'];
        $role = $session['role'];

        //Jika yang membuat tagihan bendahara = 'pending', jika yang membuat sistem admin/kepala sekolah ='accepted'
        if ($role == 'Bendahara') {
            $status = 'pending';
        } elseif (in_array($role, array('SistemAdmin','KepalaSekolah'))) {
                $status = 'accepted';
        };
        
        

?>

<div class="board-wrap">
<div class="group-action">
<button class="tombol green" onclick="onmodalTambah()">Buat Tagihan</button>
</div>
<div class="divider"></div>
<div class="tablemobile">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Status</th>
                <th>Judul Tagihan</th>
                <th>Tanggal</th>
                <th>Dibuat oleh</th>
                <th>Persetujuan</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
            
<!--  data -->
            <?php if(!empty($datarequest)) : ?>
            <?php 
            $startNumber = ($currentPage - 1) * $perpage + 1;
            $i = $startNumber;
            ?>
            <!--?php $i = 1; ?-->
            <?php
            //$tagihan_aktif = $datarequest('tagihan_aktif');
            foreach ($datarequest as $dr) : 
                switch ($dr['status']) {
                    case 'pending' :
                        $label = 'Menunggu Persetujuan';
                        $color = 'txtwarning';
                        $view = '';
                        break;
                    case 'accepted' :
                        $label = 'Disetujui';
                        $color = 'txtgreen';
                        $view = '<a class="tombol primary-outline" href="/tagihan/request/'.$dr['id'].'">Lihat Tagihan</a>';
                        break;
                    case 'rejected' :
                        $label = 'Ditolak';
                        $color = 'txtred';
                        $view = '';
                        break;
                };
                
                if($dr['id'] === $tagihan_aktif) {
                    $aktif = 'Aktif';
                    $coloraktif = 'txtgreen';
                } else {
                    $aktif = 'Nonaktif';
                    $coloraktif = 'txtdisable';
                };
            ?>
            <tr>
                <td><?= $i++ ; ?></td>
                <td><span class="<?= $coloraktif ?>"><?= $aktif ?></span></td>
                <td style="text-align:left"><?= $dr['title'] ?></td>
                <td><?= $dr['date'] ?></td>
                <td><?= $dr['nama_admin'] ?></td>
                <td><span class="<?= $color ?>"><?= $label ?></span></td>
                <td>                    
                    <?php
                    $role = $session['role'];
                    switch ($role) {
                        case 'SistemAdmin' :
                            $action =
                            [
                                '<a class="tombol warning-outline" href="/request_tagihan/edit/'.$dr['id'].'">Detail</a>',
                                '<a class="tombol danger-outline" href="/request_tagihan/delete/'.$dr['id'].'" onclick="return confirm(`Apakah anda yakin ingin menghapus data tagihan ini?`)">Hapus</a>'
                            ];
                            break;
                        case 'KepalaSekolah' || 'Bendahara' :
                            $action =
                            [
                                '<a class="tombol warning-outline" href="/request_tagihan/edit/'.$dr['id'].'">Detail</a>'
                            ];
                            break;
                    };
                    //echo $role;
                    ?>
                    <div class="td-action">
                        <?php 
                        echo $view;
                        foreach ($action as $act) {
                            echo $act;
                        };                        
                        ?>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="7">Tidak ada data tagihan</td>
                </tr>
                <?php endif; ?>
        </tbody>
    </table>
    </div>
    <!-- pagination -->
    <?= $this->include('pagination') ?>
    </div>
<!-- Modal -->
<div id="modalTambah" class="black-board">
    <div class="pop">
        <div class="group-action"><h2 class="data-title">Buat Tagihan</h2><i class="i" onclick="offmodalTambah()">&#xe14c</i></div>
        <div class="divider"></div>
        <div class="overflow-content">
        <form action="/request_tagihan/save" method="post" id="myForm">
            
        <div class="tombol green">DATA TAGIHAN</div>

        
        <input type="hidden" name="idadmin" value="<?= $idadmin ?>">
        <input type="hidden" name="status" value="<?= $status ?>">
            <table>
                    <tbody>
                        <tr>
                            <td>Judul Tagihan</td>
                            <td>
                                <input class="input" type="text" name="title" id="" value="<?= old('title') ?>" placeholder="Judul Tagihan" required oninvalid="this.setCustomValidity('Judul Tagihan harus diisi')" oninput="this.setCustomValidity('')">
                                <br> <span class="txtdanger data-subtitle"><?= session()->getFlashdata('errors') ['title'] ?? '' ?></span>
                            </td>
                        </tr>                        
                        <tr>
                            <td>Data Infaq Tagihan</td>
                           <td>
                           <span class="txtdanger data-subtitle"><?= session()->getFlashdata('errors') ['infaq_id'] ?? '' ?></span>
                            <?php foreach ($infaq as $in) : ?>
                                <div class="cbkelas">
                                    <input class="" type="checkbox" name="infaq_id[]" id="<?= $in['id'] ?>" value="<?= $in['id'] ?>">
                                    <label for="<?= $in['id'] ?>"><?= $in['name'] ?></label><br>
                                </div>
                            <?php endforeach ?>
                            
                           </td>
                        </tr>
                    </tbody>
                </table>
                
                <div class="divider"></div>
                <div class="group-action">
                <a class="tombol disable" onclick="offmodalTambah()">Close</a>
                <button class="tombol primary" type="submit">Simpan</button>
                </div>
    </form>
    </div>
    </div>
    </div>

<?= $this->include('closing') ?>


