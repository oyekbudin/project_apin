<?php namespace App\Controllers;

      use App\Models\InfaqModel;
      use CodeIgniter\Controller;

class AturInfaq extends Controller
{
    public function index()
    {
        helper(['form']);
        $lihatmodel = new InfaqModel();
        $lihatdata = $lihatmodel->findAll();
        $data = [
            'menu' => 'Perencanaan',
            'title' => 'Atur Jenis Infaq',
            'lihatdata' => $lihatdata,
        ];

        return view('aturinfaq', $data);
    }

    public function save()
    {
        helper(['form']);
        $rules =
        [
            'name' => 'required|min_length[6]|max_length[40]',
            'kelas' => 'required|min_length[1]|max_length[3]|',
            'harga' => 'required|min_length[4]|max_length[7]|',
        ];

        if($this->validate($rules))
        {
            $model = new InfaqModel();
            $data =
            [
                'name' => $this->request->getVar('name'),
                'kelas' => $this->request->getVar('kelas'),
                'harga' => $this->request->getVar('harga'),
            ];
            $model->save($data);
            return redirect()->to('/aturinfaq');
        } else {
            //$data['validation'] = $this->validator;
            //echo view('aturinfaq', $data);

            $lihatmodel = new InfaqModel();
            $lihatdata = $lihatmodel->findAll();
            $data = [
                'menu' => 'Perencanaan',
                'title' => 'Atur Jenis Infaq',
                'lihatdata' => $lihatdata,
                'validation' => $this->validator,
                'on' => true,
            ];
            //$data['validation'] = $this->validator;
            return view('aturinfaq', $data);
        }
    }

    public function edit($id)
    {
        helper(['form']);
        $model = new InfaqModel();

        $data = [
            'menu' => 'Perencanaan',
            'title' => 'Atur Jenis Infaq',
            'infaq' => $model->find($id),
            'on' => true,
        ];
        return view('editinfaq', $data);
    }

    public function update($id)
    {
        $model = new InfaqModel();
        $data =
        [
            'name' => $this->request->getVar('name'),
            'kelas' => $this->request->getVar('kelas'),
            'harga' => $this->request->getVar('harga'),
        ];
        $model->update($id, $data);

        return redirect()->to('/aturinfaq');
    }

    public function confirmdeleteinfaq($id)
    {
        $model = new InfaqModel();
        $data['infaq'] = $model->find($id);

        $data = [
            'menu' => 'Perencanaan',
            'title' => 'Atur Jenis Infaq',
            'infaq' => $model->find($id),
            'on' => true,
        ];

        return view('confirmdeleteinfaq', $data);
    }

    public function delete($id)
    {
        $model = new InfaqModel();
        $model->delete($id);

        return redirect()->to('/aturinfaq');
    }
}