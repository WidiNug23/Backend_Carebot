<?php

namespace App\Controllers;

use App\Models\IbuModel;
use CodeIgniter\RESTful\ResourceController;

class SignUpIbuController extends ResourceController
{
    protected $modelName = 'App\Models\IbuModel';
    protected $format    = 'json';

    public function post()
    {
        // Get input data from the request
        $data = $this->request->getJSON(true); // Try to get JSON input as an associative array

        // If JSON input is null, fall back to form-data
        if (is_null($data)) {
            $data = $this->request->getPost();
        }

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama' => 'required',
            'email' => 'required|valid_email|is_unique[ibu.email]',
            'password' => 'required|min_length[6]',
            'kategori' => 'required|in_list[Remaja,Lansia,Ibu Hamil,Ibu Menyusui]',
            'gender' => 'permit_empty|in_list[Laki-laki,Perempuan]',
            'umur' => 'permit_empty',
            'trimester' => 'permit_empty|in_list[Trimester 1,Trimester 2,Trimester 3]',
            'umurMenyusui' => 'permit_empty|in_list[6 Bulan Pertama,6 Bulan Kedua]',
        ]);

        if (!$validation->run($data)) {
            // Log if validation fails
            log_message('error', 'Validation failed: ' . json_encode($validation->getErrors()));
            return $this->fail($validation->getErrors());
        }

        // Hash the password
        try {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

            // Save the data to the database
            $ibuModel = new IbuModel();
            $ibuModel->save($data);

            // If successful
            return $this->respondCreated(['message' => 'Account created successfully']);
        } catch (\Exception $e) {
            // Log any errors that occur during data saving
            log_message('error', 'Error during sign up: ' . $e->getMessage());
            return $this->failServerError('Internal server error. Please try again later.');
        }
    }
}
