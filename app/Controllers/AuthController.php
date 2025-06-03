<?php

namespace App\Controllers;

use App\Models\IbuModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Email\Email;

class AuthController extends ResourceController
{
    public function forgotPassword()
    {
        log_message('info', "Memulai proses forgot password...");
    
        $json = $this->request->getJSON();
        if (!$json || !isset($json->email)) {
            return $this->respond(['message' => 'Format request tidak valid'], 400);
        }
    
        $email = trim($json->email);
    
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->respond(['message' => 'Format email tidak valid'], 400);
        }
    
        $ibuModel = new IbuModel();
        $ibu = $ibuModel->where('LOWER(email)', strtolower($email))->first();
    
        if (!$ibu) {
            return $this->respond(['message' => 'Email tidak ditemukan'], 404);
        }
    
        $token = bin2hex(random_bytes(32));
        $ibuModel->update($ibu['id'], ['reset_token' => $token]);
    
        log_message('info', "Token reset password untuk $email: $token");
    
        // **Mengirim email reset password**
        $emailService = \Config\Services::email();
        $emailService->setFrom('carebotservices@gmail.com', 'CareBot Services');
        $emailService->setTo($email);
        $emailService->setSubject('Reset Password Anda');
        $emailService->setMessage("
            <p>Halo,</p>
            <p>Kami menerima permintaan untuk mereset password Anda. Klik link di bawah ini untuk mengatur ulang password Anda:</p>
            <p><a href='http://localhost:3000/reset-password/$token'>Reset Password</a></p>
            <p>Apabila Pesan Masuk Ke Spam, Pilih 'Laporkan Bukan Phising'</p>
            <p>Jika Anda tidak meminta reset password, abaikan email ini.</p>
        ");
    
        if ($emailService->send()) {
            log_message('info', "Email reset password berhasil dikirim ke $email");
            return $this->respond(['message' => 'Link reset password telah dikirim ke email Anda.'], 200);
        } else {
            log_message('error', "Gagal mengirim email ke $email: " . $emailService->printDebugger(['headers']));
            return $this->respond(['message' => 'Gagal mengirim email. Coba lagi nanti.'], 500);
        }
    }
    

    public function resetPassword($token)
    {
        log_message('info', "Memulai proses reset password dengan token: $token");
    
        $ibuModel = new IbuModel();
        $ibu = $ibuModel->where('reset_token', $token)->first();
    
        if (!$ibu) {
            log_message('error', "Token tidak valid atau sudah kadaluarsa.");
            return $this->respond(['message' => 'Token tidak valid atau sudah kadaluarsa'], 400);
        }
    
        // Pastikan request dalam format JSON
        $json = $this->request->getJSON();
        if (!$json || !isset($json->password)) {
            log_message('error', "Request tidak valid atau password tidak dikirim.");
            return $this->respond(['message' => 'Format request tidak valid'], 400);
        }
    
        $newPassword = trim($json->password);
    
        if (strlen($newPassword) < 8) {
            log_message('error', "Password terlalu pendek.");
            return $this->respond(['message' => 'Password minimal 8 karakter'], 400);
        }
    
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        $ibuModel->update($ibu['id'], ['password' => $hashedPassword, 'reset_token' => null]);
    
        log_message('info', "Password berhasil diubah untuk email: " . $ibu['email']);
    
        return $this->respond(['message' => 'Password berhasil diubah']);
    }
    
}
