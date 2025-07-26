<?php namespace App\Controllers;

      use App\Models\AdministratorModel;
use App\Models\RekeningModel;
use CodeIgniter\Controller;
use CodeIgniter\Encryption\Encryption;

class BackupRestore extends Controller
{
    //protected $rekeningModel;

    public function __construct()
    {
        //$this->rekeningModel = new RekeningModel;
    }

    public function index()
    {
        
        $data = [
            'menu' => 'Pengaturan',
            'title' => 'Backup & Restore',
        ];

        return view('backuprestore', $data);
    }

    public function backup()
    {
        $db = db_connect();
        $tables = ['siswa'];
        $filename = 'backup_' . date('Y-m-d_H-i-s') . '.bak';
        $filePath = WRITEPATH . 'backups/' . $filename;
        $fp = fopen($filePath, 'w');

        foreach ($tables as $table)
        {
            $query = $db->query("SELECT * FROM $table");
            $result = $query->getResultArray();

            foreach ($result as $row)
            {
                $sql = "INSERT INTO $table VALUES (";
                foreach ($row as $value)
                {
                    $sql .= "'" . $db->escapeString($value) . "', ";

                }
                $sql = rtrim($sql, ', ') . ");\n";
                fwrite($fp, $sql);
            }
        }
        fclose($fp);

        return $this->response->download($filePath, null)->setFileName($filename);
        

    }

    public function restore() 
    {
        $db = db_connect();
        $file = $this->request->getFile('file');
        if ($file->isValid() && !$file->hasMoved())
        {
            $sql = file_get_contents($file->getTempName());

            try
            {
                $db->query($sql);
                return redirect()->to('/backuprestore')->with('success', 'Data berhasil dikembalikan');
            } catch (\Exception $e) {
                return redirect()->to('/backuprestore')->with('msg', 'Terjadi kesalahan : ' . $e->getMessage());
            }
            //$newName = $file->getRandomName();
            //$file->move(WRITEPATH . 'uploads', $newName);

            //simpan ke database

            //return redirect()->to('/backuprestore')->with('success', 'Data berhasil dikembalikan');
        } else {
            return redirect()->to('/backuprestore')->with('msg', 'Terjadi kesalahan');
        }
    }
}