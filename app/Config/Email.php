<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Email extends BaseConfig
{
    public $SMTPHost = 'smtp.gmail.com';
    public $SMTPUser = 'carebotservices@gmail.com';
    public $SMTPPass = 'sftb yoch uypi tusm'; // Jika menggunakan akun Gmail, gunakan App Passwords!
    public $SMTPPort = 587;
    public $SMTPCrypto = 'tls'; 
    public $protocol = 'smtp';
    public $mailType = 'html';
    public $SMTPAuth = true;    
}
