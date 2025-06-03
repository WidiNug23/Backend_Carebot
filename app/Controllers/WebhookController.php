<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;

class WebhookController extends BaseController
{
    public function index()
    {
        // Ambil input JSON dari request Dialogflow
        $input = $this->request->getJSON(true);

        // Ambil parameter dari queryResult
        $parameters = $input['queryResult']['parameters'];
        $gender = $parameters['gender'];
        $berat = $parameters['berat'];
        $tinggi = $parameters['tinggi'];
        $usia = $parameters['usia'];
        $aktivitas_fisik = $parameters['aktivitas_fisik'];

        // Perhitungan BMR berdasarkan gender
        $bmr = 0;
        if ($gender == 'laki-laki') {
            $bmr = 66 + (13.7 * $berat) + (5 * $tinggi) - (6.8 * $usia);
        } else {
            $bmr = 655 + (9.6 * $berat) + (1.8 * $tinggi) - (4.7 * $usia);
        }

        // Kalori harian berdasarkan aktivitas fisik
        $kalori_harian = $bmr;
        switch ($aktivitas_fisik) {
            case 'sedentary':
                $kalori_harian *= 1.2;
                break;
            case 'light':
                $kalori_harian *= 1.375;
                break;
            case 'moderate':
                $kalori_harian *= 1.55;
                break;
            case 'active':
                $kalori_harian *= 1.725;
                break;
        }

        // Response untuk Dialogflow
        $response = [
            'fulfillmentMessages' => [
                [
                    'text' => [
                        'text' => [
                            "Berdasarkan data Anda:",
                            "Jenis Kelamin: $gender",
                            "Berat Badan: $berat kg",
                            "Tinggi Badan: $tinggi cm",
                            "Usia: $usia tahun",
                            "Aktivitas Fisik: $aktivitas_fisik",
                            "Kebutuhan kalori harian Anda adalah " . round($kalori_harian, 2) . " kcal."
                        ]
                    ]
                ]
            ]
        ];

        // Kembalikan response sebagai JSON
        return $this->response->setStatusCode(ResponseInterface::HTTP_OK)
                              ->setJSON($response);
    }
}
