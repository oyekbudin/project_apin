<?= $this->include('dashboardadministrator') ?>
<div class="board-wrap">
    <div class="dataonly">
        <table>
            <tr>
                <td>Untuk mencadangkan data, klik tombol Backup</td>
                <td>
                    <form action="<?= base_url('backuprestore/backup') ?>" method="get" enctype="multipart/form-data">
                        <div class="td-action">
                            <button type="submit" class="tombol primary-outline">Backup</button>
                        </div>
                    </form>                    
                </td>
            </tr>
            <tr>
                <td>Untuk mengembalikan data, cari file cadangan sebelumnya dan klik Restore</td>
                <td>               
                </td>
            </tr>
            <tr>
                <td>
                    <form action="<?= base_url('backuprestore/restore') ?>" method="post" enctype="multipart/form-data">
                        <input class="input" type="file" name="file" id="">
                </td>
                <td>
                    <div class="td-action">
                        <button type="submit" class="tombol primary-outline">Restore</button>
                    </div>
                    
                    </form>
                </td>
            </tr>
        </table>    
    </div>
</div>

<?= $this->include('closing') ?>