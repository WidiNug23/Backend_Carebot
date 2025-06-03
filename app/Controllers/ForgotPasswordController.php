<?php

namespace App\Controllers;

use App\Models\IbuModel;
use CodeIgniter\RESTful\ResourceController;
use Config\Services;

class ForgotPasswordController extends ResourceController
{
    protected $modelName = 'App\Models\IbuModel';
    protected $format    = 'json';

    // Request reset password
    public function requestReset()
    {
        $email = $this->request->getVar('email');
        $ibuModel = new IbuModel();
        $ibu = $ibuModel->where('email', $email)->first();

        if (!$ibu) {
            return $this->failNotFound('Email tidak ditemukan');
        }

        // Buat token unik
        $token = bin2hex(random_bytes(50));
        $ibuModel->update($ibu['id'], ['reset_token' => $token]);

        // Kirim email dengan link reset password
        $emailService = Services::email();
        $emailService->setTo($email);
        $emailService->setSubject('Reset Password');
        $emailService->setMessage("Klik link berikut untuk reset password: " . base_url("reset-password/$token"));
        $emailService->send();

        return $this->respond(['message' => 'Link reset password telah dikirim ke email']);
    }

    // Reset password berdasarkan token
    public function resetPassword($token)
    {
        $ibuModel = new IbuModel();
        $ibu = $ibuModel->where('reset_token', $token)->first();

        if (!$ibu) {
            return $this->fail('Token tidak valid atau sudah digunakan');
        }

        $newPassword = $this->request->getVar('password');
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $ibuModel->update($ibu['id'], ['password' => $hashedPassword, 'reset_token' => null]);

        return $this->respond(['message' => 'Password berhasil diperbarui']);
    }
}
