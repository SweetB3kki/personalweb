<?php
return [
    'dsn' => getenv('DB_DSN') ?: 'mysql:host=127.0.0.1;port=3310;dbname=personal_lab11;charset=utf8mb4',
    'user' => getenv('DB_USER') ?: 'root',
    'password' => getenv('DB_PASSWORD') ?: '',
];
