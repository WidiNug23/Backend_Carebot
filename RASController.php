<?php

namespace App\Controllers;

use App\Models\RASModel;

class RASController extends BaseController
{
    public function tampilkan()
    {
        $model = new RASModel();
        $kuesioner = $model->findAll();

        $data = [
            'kuesioner' => $kuesioner
        ];

        return view('ras_kuesioner', $data);
    }
}
