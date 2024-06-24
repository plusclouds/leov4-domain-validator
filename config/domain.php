<?php

return [
    'token_expiration' => env("TOKEN_EXPIRATION", 86400),
    'http_validation_file_path' => env("HTTP_VALIDATION_FILE_PATH", "/.well-known/validation.txt")
];
