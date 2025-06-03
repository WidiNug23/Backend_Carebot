<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;
use CodeIgniter\Filters\PageCache;
use App\Filters\CORS;

class Filters extends BaseConfig
{
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'cors'          => CORS::class,
        'auth' => \App\Filters\AuthFilter::class, // Filter autentikasi baru
    ];

    public array $globals = [
        'before' => [
            'cors',
        ],
        'after' => [
            'toolbar',
            // Optionally add other global after filters here
        ],
    ];

    public array $methods = [];

    public array $filters = [];
}