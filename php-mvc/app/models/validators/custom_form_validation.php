<?php
declare(strict_types=1);

require_once __DIR__ . '/form_validation.php';

class CustomFormValidation extends FormValidation
{
    protected array $allowedGroups = [];
    protected array $question2Options = [];
    protected array $question3Options = [];

    public function setAllowedGroups(array $allowedGroups): void
    {
        $this->allowedGroups = $allowedGroups;
    }

    public function setAllowedOptions(array $question2Options, array $question3Options): void
    {
        $this->question2Options = $question2Options;
        $this->question3Options = $question3Options;
    }

    public function Validate(array $postArray): void
    {
        parent::Validate($postArray);

        if (isset($postArray['group']) && $postArray['group'] !== '' && !in_array($postArray['group'], $this->allowedGroups, true)) {
            $this->Errors['group'][] = 'Выбрана группа, отсутствующая в учебном списке.';
        }

        if (isset($postArray['question2']) && $postArray['question2'] !== '' && !in_array($postArray['question2'], $this->question2Options, true)) {
            $this->Errors['question2'][] = 'Получено недопустимое значение второго вопроса.';
        }

        if (isset($postArray['question3'])) {
            $question3 = (array) $postArray['question3'];
            if (count($question3) === 0) {
                $this->Errors['question3'][] = 'Для третьего вопроса необходимо выбрать минимум один вариант.';
            }

            foreach ($question3 as $item) {
                if (!in_array($item, $this->question3Options, true)) {
                    $this->Errors['question3'][] = 'Получено недопустимое значение третьего вопроса.';
                    break;
                }
            }
        }
    }
}
