<?php
declare(strict_types=1);

require_once __DIR__ . '/page_model.php';

class ContactModel extends Model
{
    public const CONTACTS = [
        ['label' => 'Email', 'value' => 'demo@example.com', 'href' => 'mailto:demo@example.com'],
        ['label' => 'Телефон', 'value' => '+7 000 000 00 00', 'href' => ''],
        ['label' => 'Telegram', 'value' => '@sweet_b3kki', 'href' => 'https://example.com/'],
        ['label' => 'ВКонтакте', 'value' => '@sweet_b3kki', 'href' => 'https://example.com/'],
        ['label' => 'GitHub', 'value' => 'github.com/SweetB3kki', 'href' => 'https://github.com/SweetB3kki'],
    ];

    public function __construct()
    {
        parent::__construct();
        $this->formData = $this->getDefaultFormData();
        $this->validator->SetRule('fio', 'IsNotEmpty');
        $this->validator->SetRule('email', 'IsNotEmpty');
        $this->validator->SetRule('email', 'IsEmail');
        $this->validator->SetRule('subject', 'IsNotEmpty');
        $this->validator->SetRule('message', 'IsNotEmpty');
    }

    public function getProfile(): array
    {
        return PageModel::profile();
    }

    public function getContacts(): array
    {
        return self::CONTACTS;
    }

    public function getDefaultFormData(): array
    {
        return [
            'fio' => '',
            'email' => '',
            'subject' => '',
            'message' => '',
        ];
    }

    public function submit(array $postData): bool
    {
        $this->formData = [
            'fio' => trim((string) ($postData['fio'] ?? '')),
            'email' => trim((string) ($postData['email'] ?? '')),
            'subject' => trim((string) ($postData['subject'] ?? '')),
            'message' => trim((string) ($postData['message'] ?? '')),
        ];

        $isValid = $this->validate($this->formData);
        if (!$isValid) {
            return false;
        }

        $this->successMessage = 'Форма «Контакт» успешно прошла серверную валидацию.';
        return true;
    }
}
