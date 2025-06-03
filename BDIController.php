<?php

namespace App\Controllers;

use App\Models\BDIModel;

class BDIController extends BaseController
{
    public function tampilkan($start = 1)
    {
        $model = new BDIModel();

        // Define ranges for categories
        $pernyataanPerKategori = [
            'Kesedihan' => range(1, 4),
            'Pesimisme' => range(5, 8),
            'Kegagalan Masa Lalu' => range(9, 12),
            'Kehilangan Kesenangan' => range(13, 16),
            'Perasaan Bersalah' => range(17, 20),
            'Perasaan Dihukum' => range(21, 24),
            'Kekecewaan terhadap Diri Sendiri' => range(25, 28),
            'Kritik Diri' => range(29, 32),
            'Pikiran Bunuh Diri' => range(33, 36),
            'Menangis' => range(37, 40),
            'Gelisah' => range(41, 44),
            'Kehilangan Minat' => range(45, 48),
            'Keputusan yang Tertunda' => range(49, 52),
            'Perasaan Tidak Berharga' => range(53, 56),
            'Kehilangan Energi' => range(57, 60),
            'Perubahan Pola Tidur' => range(61, 64),
            'Gugup' => range(65, 68),
            'Perubahan Pola Makan' => range(69, 78),
            'Kehilangan Berat Badan' => range(79, 82),
            'Kehilangan Konsentrasi' => range(83, 86),
            'Kehilangan Minat dalam Seks' => range(87, 90),
        ];

        $currentCategory = null;
        $currentStatements = [];

        foreach ($pernyataanPerKategori as $kategori => $range) {
            if ($start >= $range[0] && $start <= end($range)) {
                $currentCategory = $kategori;
                $currentStatements = $model->getPernyataanInRange($range[0], end($range));
                break;
            }
        }

        $data = [
            'kategori' => $currentCategory,
            'kuesioner' => $currentStatements,
            'start' => $start
        ];

        return view('bdi_kuesioner', $data);
    }
}
