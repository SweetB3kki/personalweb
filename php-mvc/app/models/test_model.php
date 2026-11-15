<?php
declare(strict_types=1);

require_once __DIR__ . '/page_model.php';
require_once __DIR__ . '/validators/custom_form_validation.php';
require_once __DIR__ . '/validators/results_verification.php';

class TestModel extends Model
{
    public array $history = [];
    public const SUBJECT = 'Тест по дисциплине Физика';

    public const QUESTIONS = [
        'question1' => 'Напишите формулу второго закона Ньютона.',
        'question2' => 'Что из перечисленного является единицей измерения силы?',
        'question3' => 'Какие из следующих утверждений верны?',
    ];

    public const GROUPS = [
        '1 курс' => ['ПИ/б-21-1-о', 'ПИ/б-21-2-о'],
        '2 курс' => ['ПИ/б-22-1-о', 'ПИ/б-22-2-о'],
    ];

    public const QUESTION2_OPTIONS = [
        'Ньютон',
        'Джоуль',
        'Ватт',
    ];

    public const QUESTION3_OPTIONS = [
        'Скорость измеряется в м/с',
        'Сила измеряется в джоулях',
        'Масса измеряется в килограммах',
    ];

    public function __construct()
    {
        parent::__construct();

        $this->validator = new ResultsVerification();
        $this->formData = $this->getDefaultFormData();

        $this->validator->setAllowedGroups($this->flattenGroups());
        $this->validator->setAllowedOptions(self::QUESTION2_OPTIONS, self::QUESTION3_OPTIONS);
        $this->validator->SetRule('fio', 'IsNotEmpty');
        $this->validator->SetRule('fio', 'isMaxLength', 255);
        $this->validator->SetRule('group', 'IsNotEmpty');
        $this->validator->SetRule('question1', 'IsNotEmpty');
        $this->validator->SetRule('question2', 'IsNotEmpty');
        $this->validator->SetRule('question3', 'IsNotEmpty');
    }

    public function getProfile(): array
    {
        return PageModel::profile();
    }

    public function getQuestions(): array
    {
        return self::QUESTIONS;
    }

    public function getGroups(): array
    {
        return self::GROUPS;
    }

    public function getQuestion2Options(): array
    {
        return self::QUESTION2_OPTIONS;
    }

    public function getQuestion3Options(): array
    {
        return self::QUESTION3_OPTIONS;
    }

    public function getSubject(): string
    {
        return self::SUBJECT;
    }

    public function getDefaultFormData(): array
    {
        return [
            'fio' => '',
            'group' => '',
            'question1' => '',
            'question2' => '',
            'question3' => [],
        ];
    }

    public function submit(array $postData): bool
    {
        $this->formData = [
            'fio' => trim((string) ($postData['fio'] ?? '')),
            'group' => trim((string) ($postData['group'] ?? '')),
            'question1' => trim((string) ($postData['question1'] ?? '')),
            'question2' => trim((string) ($postData['question2'] ?? '')),
            'question3' => array_values(array_filter((array) ($postData['question3'] ?? []), 'is_string')),
        ];

        $this->validator->Validate($this->formData);
        if (count($this->validator->Errors) > 0) {
            return false;
        }

        $this->validator->CheckResults($this->formData);
        $this->successMessage = 'Форма «Тест» успешно обработана на стороне сервера.';
        return true;
    }

    private function flattenGroups(): array
    {
        return array_merge(...array_values(self::GROUPS));
    }
}
