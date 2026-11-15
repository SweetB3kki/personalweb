<?php
class Csrf
{
    public static function token(): string { return $_SESSION['csrf'] ??= bin2hex(random_bytes(24)); }
    public static function verify(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !hash_equals(self::token(), (string)($_POST['csrf'] ?? ''))) {
            http_response_code(403); exit('Обновите страницу и повторите отправку формы.');
        }
    }
}
