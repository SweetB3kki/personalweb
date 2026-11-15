<?php
declare(strict_types=1);
require_once __DIR__ . '/page_model.php';

class GuestbookModel extends Model
{
    public array $messages = [];
    public function getProfile(): array { return PageModel::profile(); }
    private function path(): string { return dirname(__DIR__, 2) . '/storage/messages.inc'; }

    public function load(): void
    {
        $this->messages = [];
        if (!is_file($this->path())) return;
        $file = fopen($this->path(), 'r');
        flock($file, LOCK_SH);
        while (($row = fgetcsv($file, 0, ';', '"', '')) !== false) {
            if (count($row) === 4) $this->messages[] = $row;
        }
        flock($file, LOCK_UN);
        fclose($file);
        usort($this->messages, fn($a, $b) => strtotime($b[0]) <=> strtotime($a[0]));
    }

    public function submit(array $data): bool
    {
        $this->formData = [];
        foreach (['surname', 'name', 'patronymic', 'email', 'message'] as $field) {
            $this->formData[$field] = trim((string)($data[$field] ?? ''));
            $this->validator->SetRule($field, 'isNotEmpty');
        }
        $this->validator->SetRule('email', 'isEmail');
        $this->validator->Validate($this->formData);
        if ($this->validator->Errors) return false;
        $d = $this->formData;
        $this->append([[date('d.m.Y H:i:s'), "$d[surname] $d[name] $d[patronymic]", $d['email'], $d['message']]]);
        $this->successMessage = 'Отзыв добавлен.';
        $this->formData = [];
        return true;
    }

    private function append(array $rows): void
    {
        $directory = dirname($this->path());
        if (!is_dir($directory)) mkdir($directory, 0775, true);
        $file = fopen($this->path(), 'a');
        if (!$file || !flock($file, LOCK_EX)) throw new RuntimeException('Не удалось открыть гостевую книгу.');
        foreach ($rows as $row) fputcsv($file, $row, ';', '"', '');
        flock($file, LOCK_UN);
        fclose($file);
    }

    public function import(string $path): bool
    {
        $file = fopen($path, 'r');
        $rows = [];
        $line = 0;
        while (($row = fgetcsv($file, 0, ';', '"', '')) !== false) {
            $line++;
            if ($row === [null]) continue;
            if (count($row) !== 4 || str_contains($row[0], "\0") || strtotime($row[0]) === false || trim($row[1]) === '' || trim($row[3]) === '' || filter_var($row[2], FILTER_VALIDATE_EMAIL) === false) {
                $this->validator->Errors['file'][] = "Строка $line: неверный формат сообщения.";
            } else $rows[] = $row;
        }
        fclose($file);
        if (!$rows && !$this->validator->Errors) $this->validator->Errors['file'][] = 'Нет сообщений для загрузки.';
        if ($this->validator->Errors) return false;
        $this->append($rows);
        $this->successMessage = 'Сообщения загружены: ' . count($rows) . '.';
        return true;
    }
}
