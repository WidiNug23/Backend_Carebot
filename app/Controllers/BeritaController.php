<?php

namespace App\Controllers;

use App\Models\BeritaModel;

class BeritaController extends BaseController
{
    public function index()
    {
        $model = new BeritaModel();
        $data = $model->findAll();

        $allowedCategories = ['remaja', 'lansia', 'ibu hamil', 'ibu menyusui'];
        foreach ($data as &$item) {
            if (isset($item['kategori']) && !in_array($item['kategori'], $allowedCategories)) {
                $item['kategori'] = 'Tidak diketahui';
            }
        }

        return $this->response->setJSON($data);
    }

    public function show($id = null)
    {
        $model = new BeritaModel();
        $data = $model->find($id);

        if ($data) {
            return $this->response->setJSON($data);
        } else {
            return $this->response->setStatusCode(404)->setJSON(['message' => 'Data not found']);
        }
    }

    public function post()
    {
        $model = new BeritaModel();
        $data = $this->request->getPost();
        $file = $this->request->getFile('image');

        $allowedCategories = ['remaja', 'lansia', 'ibu hamil', 'ibu menyusui'];
        if (empty($data['judul']) || empty($data['isi']) || empty($data['kategori']) || !in_array($data['kategori'], $allowedCategories)) {
            return $this->response->setStatusCode(400)->setJSON(['message' => 'Invalid input data']);
        }

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads', $fileName);
            $data['image'] = $fileName;
        }

        $model->insert($data);
        $data['id'] = $model->getInsertID();

        return $this->response->setStatusCode(201)->setJSON($data);
    }

    public function update($id = null)
    {
        $model = new BeritaModel();
        $data = $model->find($id);
    
        if (!$data) {
            return $this->response->setStatusCode(404)->setJSON(['message' => 'Data not found']);
        }
    
        // Get the raw input data
        $updatedData = $this->request->getRawInput();
        $file = $this->request->getFile('image');  // Get the uploaded file
    
        // Validate input fields
        $allowedCategories = ['remaja', 'lansia', 'ibu hamil', 'ibu menyusui'];
        if (empty($updatedData['judul'])) {
            return $this->response->setStatusCode(400)->setJSON(['message' => 'Judul is required']);
        }
        if (empty($updatedData['isi'])) {
            return $this->response->setStatusCode(400)->setJSON(['message' => 'Isi is required']);
        }
        if (empty($updatedData['kategori']) || !in_array($updatedData['kategori'], $allowedCategories)) {
            return $this->response->setStatusCode(400)->setJSON(['message' => 'Kategori is invalid']);
        }
    
        // Cek dan proses file image
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Validate file type
            if ($file->getClientMimeType() === 'image/png' || $file->getClientMimeType() === 'image/jpeg' || $file->getClientMimeType() === 'image/jpg') {
                $imageFileName = $file->getRandomName();
    
                // Ensure uploads directory exists
                $uploadPath = ROOTPATH . 'public/uploads';
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }
    
                // Move the new image
                $file->move($uploadPath, $imageFileName);
    
                // Delete old image if exists
                if (!empty($data['image']) && file_exists($uploadPath . '/' . $data['image'])) {
                    unlink($uploadPath . '/' . $data['image']);
                }
    
                // Add new image name to the updated data
                $updatedData['image'] = $imageFileName;
            } else {
                return $this->response->setStatusCode(400)->setJSON(['message' => 'File image must be in JPG or PNG format']);
            }
        }
    
        // Update the data in the database
        $model->update($id, $updatedData);
        return $this->response->setStatusCode(200)->setJSON($updatedData);  // Return the updated data
    }
    
    public function delete($id = null)
    {
        $model = new BeritaModel();
        $data = $model->find($id);

        if (!$data) {
            return $this->response->setStatusCode(404)->setJSON(['message' => 'Data not found']);
        }

        if (!empty($data['image'])) {
            $filePath = ROOTPATH . 'public/uploads/' . $data['image'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $model->delete($id);
        return $this->response->setStatusCode(204);
    }
}
