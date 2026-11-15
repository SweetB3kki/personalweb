<?php
declare(strict_types=1);
require_once __DIR__ . '/../core/base_active_record.php';
require_once __DIR__ . '/../core/pagination.php';
require_once __DIR__ . '/page_model.php';

class BlogModel extends BaseActiveRecord
{
    protected static string $table = 'posts';
    protected static array $fields = ['title', 'message', 'author', 'image', 'created_at'];
    public string $title = '';
    public string $message = '';
    public string $author = '';
    public ?string $image = null;
    public string $created_at = '';
    public array $posts = [];
    public bool $editor = false;
    public ?Pagination $pagination = null;

    public function __construct()
    {
        parent::__construct();
        $this->validator->SetRule('title', 'isNotEmpty');
    }

    public function getProfile(): array { return PageModel::profile(); }

    public function loadPage(int $page): void
    {
        $total = (int) Database::connection()->query('SELECT COUNT(*) FROM posts')->fetchColumn();
        $this->pagination = new Pagination($total, $page);
        $query = Database::connection()->prepare('SELECT * FROM posts ORDER BY created_at DESC, id DESC LIMIT ? OFFSET ?');
        $query->bindValue(1, Pagination::PER_PAGE, PDO::PARAM_INT);
        $query->bindValue(2, $this->pagination->offset, PDO::PARAM_INT);
        $query->execute();
        $this->posts = array_map(fn($row) => self::hydrate($row), $query->fetchAll());
    }

    public function submit(array $data, array $files): bool
    {
        $this->formData = ['title' => trim((string)($data['title'] ?? '')), 'message' => trim((string)($data['message'] ?? ''))];
        $this->validator->Validate($this->formData);
        if (mb_strlen($this->formData['title']) > 255) $this->validator->Errors['title'][] = 'Тема: не более 255 символов.';
        $this->image = null;
        $file = $files['image'] ?? null;
        if ($file && $file['error'] !== UPLOAD_ERR_NO_FILE) {
            $types = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];
            $mime = $file['error'] === UPLOAD_ERR_OK ? (new finfo(FILEINFO_MIME_TYPE))->file($file['tmp_name']) : '';
            if (!isset($types[$mime]) || $file['size'] > 5 * 1024 * 1024) {
                $this->validator->Errors['image'][] = 'Изображение: JPG, PNG или WebP, до 5 МБ.';
            } elseif (!$this->validator->Errors) {
                $name = bin2hex(random_bytes(12)) . '.' . $types[$mime];
                $directory = dirname(__DIR__, 2) . '/public/uploads';
                if (!is_dir($directory)) mkdir($directory, 0775, true);
                if (!move_uploaded_file($file['tmp_name'], "$directory/$name")) {
                    $this->validator->Errors['image'][] = 'Не удалось сохранить изображение.';
                } else $this->image = '/public/uploads/' . $name;
            }
        }
        if ($this->validator->Errors) return false;
        $this->title = $this->formData['title'];
        $this->message = $this->formData['message'];
        $this->author = PageModel::PROFILE['name'];
        $this->created_at = date('Y-m-d H:i:s');
        $this->save();
        $this->formData = [];
        $this->successMessage = 'Запись добавлена.';
        return true;
    }

    public function importCsv(string $path): bool
    {
        $file = fopen($path, 'r');
        $rows = [];
        $line = 0;
        while (($row = fgetcsv($file, 0, ',', '"', '')) !== false) {
            $line++;
            if ($row === [null]) continue;
            if ($line === 1) {
                $row[0] = preg_replace('/^\xEF\xBB\xBF/', '', $row[0]);
                if ($row === ['title', 'message', 'author', 'created_at']) continue;
            }
            if (count($row) !== 4) {
                $this->validator->Errors['csv'][] = "Строка $line: ожидаются четыре поля.";
                continue;
            }
            $validation = new FormValidation();
            foreach (['title', 'author', 'created_at'] as $field) $validation->SetRule($field, 'isNotEmpty');
            $data = array_combine(['title', 'message', 'author', 'created_at'], $row);
            $validation->Validate($data);
            foreach (['title', 'author'] as $field) {
                if (mb_strlen($data[$field]) > 255) $validation->Errors[$field][] = 'Поле ' . $field . ': не более 255 символов.';
            }
            $date = preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}$/D', $data['created_at']) ? DateTimeImmutable::createFromFormat('!Y-m-d H:i', $data['created_at']) : false;
            if (!$date || $date->format('Y-m-d H:i') !== $data['created_at']) $validation->Errors['created_at'][] = 'Дата должна иметь формат YYYY-MM-DD HH:MM.';
            if ($validation->Errors) {
                $this->validator->Errors['csv'][] = "Строка $line: " . implode(' ', array_merge(...array_values($validation->Errors)));
            } else {
                $data['created_at'] = $date->format('Y-m-d H:i:s');
                $rows[] = $data;
            }
        }
        fclose($file);
        if (!$rows && !$this->validator->Errors) $this->validator->Errors['csv'][] = 'Файл не содержит записей.';
        if ($this->validator->Errors) return false;
        $pdo = Database::connection();
        $pdo->beginTransaction();
        try {
            $statement = $pdo->prepare('INSERT INTO posts (title, message, author, created_at) VALUES (?, ?, ?, ?)');
            foreach ($rows as $row) $statement->execute(array_values($row));
            $pdo->commit();
        } catch (Throwable $error) { $pdo->rollBack(); throw $error; }
        $this->successMessage = 'Импортировано записей: ' . count($rows) . '.';
        return true;
    }
}
