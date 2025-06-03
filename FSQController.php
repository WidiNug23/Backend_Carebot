<?php

namespace App\Controllers;

use App\Models\FSQModel;

class FSQController extends BaseController
{
    public function tampilkan()
    {
        $model = new FSQModel();
        $kuesioner = $model->findAll();

        $data = [
            'kuesioner' => $kuesioner
        ];

        return view('fsq_kuesioner', $data);
    }
}
