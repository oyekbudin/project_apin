<?= $this->include('dashboardadministrator') ?>
<div id="modalTambah" class="black-board">
        <div class="pop">
            <div class="group-action"><h2 class="data-title">Kirim Tagihan</h2><a onclick="history.back()"> <i class="i" onclick="offmodalTambah()">&#xe14c</i></a> </div>
            <div class="divider"></div>
            <div class="overflow-content">
            <form action="/atursiswa/update/#" method="post">
                
            <div class="tombol green">DATA PESAN</div>
   
    <table id="">
                    <tbody>
                        <tr>
                            <td>Kalimat Pembuka</td>
                            <td id="textArea">
                                <textarea name="header" id=""></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Kalimat Penutup</td>
                            <td id="textArea">
                                <textarea name="header" id=""></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Pilih Penerima</td>
                            <td>                           
                            <div class="cbkelas">
                                <input type="checkbox" name="" id="">
                                <label for="">Aliya</label>
                            </div>                            
                            <div class="cbkelas">
                                <input type="checkbox" name="" id="">
                                <label for="">Aliya</label>
                            </div>                            
                            <div class="cbkelas">
                                <input type="checkbox" name="" id="">
                                <label for="">Aliya</label>
                            </div>                            
                           </td>
                        </tr>
                        
                    </tbody>
                </table>
                <div class="divider"></div>
                <div class="group-action">
                <a class="tombol disable" onclick="history.back()">Close</a>
                <button class="tombol primary" type="submit">Kirim</button>
                </div>
                
    </form>
    </div>
    </div>
</div>

<?= $this->include('closing') ?>