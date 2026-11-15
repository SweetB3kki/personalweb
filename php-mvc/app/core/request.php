<?php
declare(strict_types=1);

class Request
{
    public static function validate(): void
    {
        foreach ([$_GET, $_POST] as $source => $fields) {
            foreach ($fields as $name => $value) {
                if (is_string($value)) continue;
                if ($source === 1 && $name === 'question3' && is_array($value)) {
                    $valid = count($value) <= 3;
                    foreach ($value as $answer) $valid = $valid && is_string($answer);
                    if ($valid) continue;
                }
                self::reject();
            }
        }
        foreach ($_FILES as $file) {
            if (!is_array($file) || !is_int($file['error'] ?? null) || !is_string($file['tmp_name'] ?? null)) self::reject();
        }
    }

    private static function reject(): never
    {
        http_response_code(422);
        $message = 'Некорректный формат полей формы.';
        if (parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) === '/admin/blog/update') {
            header('Content-Type: application/json; charset=UTF-8');
            exit(json_encode(['error' => $message], JSON_UNESCAPED_UNICODE));
        }
        header('Content-Type: text/plain; charset=UTF-8');
        exit($message);
    }
}
