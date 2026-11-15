<?php
require_once __DIR__ . '/../app/core/database.php';
$config = require __DIR__ . '/../config/database.php';
preg_match('/dbname=([a-zA-Z0-9_]+)/', $config['dsn'], $match);
if (!$match) throw new RuntimeException('В DSN требуется имя базы.');
$serverDsn = preg_replace('/;dbname=[^;]+/', '', $config['dsn']);
$pdo = new PDO($serverDsn, $config['user'], $config['password'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
$pdo->exec('CREATE DATABASE IF NOT EXISTS `' . $match[1] . '` CHARACTER SET utf8mb4');
Database::connection()->exec(file_get_contents(__DIR__ . '/schema.sql'));
echo "Schema installed\n";
