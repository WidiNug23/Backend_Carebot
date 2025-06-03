<?php

namespace App\Controllers;

use App\Models\VideoModel;
use CodeIgniter\RESTful\ResourceController;

class VideoController extends ResourceController
{
    protected $modelName = 'App\Models\VideoModel';
    protected $format    = 'json';

    // GET: Ambil semua video
    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function show($id = null)
    {
        $video = $this->model->find($id);
        if (!$video) {
            return $this->failNotFound('Video tidak ditemukan.');
        }
        return $this->respond($video);
    }

    public function getByCategory($category)
{
    $videos = $this->model->where('category', $category)->findAll();
    if (!$videos) {
        return $this->failNotFound('Tidak ada video untuk kategori ini.');
    }
    return $this->respond($videos);
}


    // POST: Tambah video baru
    public function create()
    {
        $json = $this->request->getJSON();
        $this->model->insert([
            'category' => $json->category,
            'youtube_url' => $json->youtube_url
        ]);
        return $this->respondCreated(['message' => 'Video berhasil ditambahkan']);
    }

    // DELETE: Hapus video berdasarkan ID
    public function delete($id = null)
    {
        if ($this->model->delete($id)) {
            return $this->respondDeleted(['message' => 'Video berhasil dihapus']);
        }
        return $this->failNotFound('Video tidak ditemukan');
    }
}
