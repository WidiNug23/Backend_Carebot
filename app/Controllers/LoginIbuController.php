<?php

namespace App\Controllers;

use App\Models\IbuModel;
use CodeIgniter\RESTful\ResourceController;

class LoginIbuController extends ResourceController
{
    protected $modelName = 'App\Models\IbuModel';
    protected $format    = 'json';

    public function login()
    {
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        // Check if the email exists
        $ibu = $this->model->where('email', $email)->first();

        if (!$ibu) {
            // Email not found
            return $this->failNotFound('Email not found');
        }

        // Verify the password
        if (!password_verify($password, $ibu['password'])) {
            return $this->fail('Invalid password');
        }

        // Successful login response
        return $this->respond([
            'message' => 'Login successful',
            'ibu' => [
                'id' => $ibu['id'],
                'nama' => $ibu['nama'],
                'email' => $ibu['email'],
                'kategori' => $ibu['kategori'],
                'gender' => $ibu['gender'],
                'umur' => $ibu['umur'],
                'trimester' => $ibu['trimester'],
                'umurMenyusui' => $ibu['umurMenyusui'],
                'riwayatPenyakit' => $ibu['riwayatPenyakit'],
                'tanggal_signup' =>$ibu['tanggal_signup']
            ]
        ]);
    }
}
