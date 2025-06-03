<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Files\File;

class Uploads extends Controller
{
    public function serve($filename)
    {
        $path = WRITEPATH . 'uploads/' . $filename; // Path to the file
    
        if (is_file($path)) {
            // If file exists, serve it to the client
            return $this->response->download($path, null)->setFileName($filename);
        }
    
        // If file doesn't exist, throw an error
        throw new \CodeIgniter\Exceptions\PageNotFoundException("File not found: " . $filename);
    }
    
}
