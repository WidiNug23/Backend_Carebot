<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

/**
 * Cross-Origin Resource Sharing (CORS) Configuration
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
 */
class Cors extends BaseConfig
{
    /**
     * The default CORS configuration.
     *
     * @var array{
     *      allowedOrigins: list<string>,
     *      allowedOriginsPatterns: list<string>,
     *      supportsCredentials: bool,
     *      allowedHeaders: list<string>,
     *      exposedHeaders: list<string>,
     *      allowedMethods: list<string>,
     *      maxAge: int,
     *  }
     */
    public array $default = [
        'allowedOrigins' => ['http://localhost:3000'],
        'allowedOriginsPatterns' => [],
        'supportsCredentials' => true,
        'allowedHeaders' => ['Content-Type', 'Authorization'],
        'exposedHeaders' => ['Content-Type', 'Authorization'],
        'allowedMethods' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
        'maxAge' => 3600,
        /**
         * Origins for the `Access-Control-Allow-Origin` header.
         *
         * E.g.:
         *   - ['http://localhost:3000']
         */
        'allowedOrigins' => ['http://localhost:3000'],

        /**
         * Origin regex patterns for the `Access-Control-Allow-Origin` header.
         *
         * E.g.:
         *   - ['https://\w+\.example\.com']
         */
        'allowedOriginsPatterns' => [],

        /**
         * Whether to send the `Access-Control-Allow-Credentials` header.
         *
         * @see https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Access-Control-Allow-Credentials
         */
        'supportsCredentials' => true,

        /**
         * Set headers to allow.
         *
         * E.g.:
         *   - ['Content-Type', 'Authorization']
         */
        'allowedHeaders' => ['Content-Type', 'Authorization'],

        /**
         * Set headers to expose.
         *
         * E.g.:
         *   - ['Content-Type', 'Authorization']
         */
        'exposedHeaders' => [],

        /**
         * Set methods to allow.
         *
         * E.g.:
         *   - ['GET', 'POST', 'PUT', 'DELETE']
         */
        'allowedMethods' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],

        /**
         * Set how many seconds the results of a preflight request can be cached.
         *
         * @see https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Access-Control-Max-Age
         */
        'maxAge' => 7200,
    ];
    
    
}
