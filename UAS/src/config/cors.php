<?php

return [
    'paths' => ['api/*', 'sanctum/csrf-cookie', 'docs', 'api-docs'],
    'allowed_methods' => ['*'],
    'allowed_origins' => ['*'], // Ganti ke domain asli saat production
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => false,
];