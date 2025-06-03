<?php

namespace App\Controllers;

use App\Models\KuesionerModel;

class Kuesioner extends BaseController
{
    public function index()
    {
        $data = [
            'jenis' => ['BDI-II', 'FSQ', 'RAS']
        ];

        return view('kuesioner_list', $data);
    }

    public function tampilkan($jenis)
    {
        // Redirect to specific controllers based on kuesioner type
        switch ($jenis) {
            case 'BDI-II':
                return redirect()->to(site_url('bdi/tampilkan/1'));
            case 'FSQ':
                return redirect()->to(site_url('fsq'));
            case 'RAS':
                return redirect()->to(site_url('ras'));
            default:
                throw new \Exception('Jenis kuesioner tidak valid');
        }
    }

    public function nilai()
    {
        $pernyataan = $this->request->getPost('pernyataan');
        
        // Simpan atau proses jawaban sesuai kebutuhan Anda
        // Misalnya, simpan ke database atau tampilkan hasil

        // Redirect atau tampilkan pesan konfirmasi
        return redirect()->to(site_url('kuesioner'))->with('message', 'Jawaban Anda telah dikirim.');
    }
}
