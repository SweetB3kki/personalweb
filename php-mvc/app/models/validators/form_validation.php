<?php
declare(strict_types=1);

class FormValidation
{
    public array $Rules = [];
    public array $Errors = [];

    public function isNotEmpty($data): string
    {
        if (is_array($data)) {
            return count($data) > 0 ? '' : 'Поле обязательно для заполнения.';
        }

        return trim((string) $data) !== '' ? '' : 'Поле обязательно для заполнения.';
    }

    public function isInteger($data): string
    {
        return filter_var($data, FILTER_VALIDATE_INT) !== false ? '' : 'Значение должно быть целым числом.';
    }

    public function isLess($data, $value): string
    {
        if (filter_var($data, FILTER_VALIDATE_INT) === false || (int) $data < (int) $value) {
            return 'Значение должно быть не меньше ' . (int) $value . '.';
        }

        return '';
    }

    public function isGreater($data, $value): string
    {
        if (filter_var($data, FILTER_VALIDATE_INT) === false || (int) $data > (int) $value) {
            return 'Значение должно быть не больше ' . (int) $value . '.';
        }

        return '';
    }

    public function isEmail($data): string
    {
        return filter_var($data, FILTER_VALIDATE_EMAIL) !== false ? '' : 'Укажите корректный email.';
    }

    public function SetRule(string $fieldName, string $validatorName, $value = null): void
    {
        $this->Rules[] = [
            'field' => $fieldName,
            'validator' => $validatorName,
            'value' => $value,
        ];
    }

    public function isMaxLength($data, $value): string
    {
        return is_string($data) && mb_strlen($data) <= (int)$value ? '' : 'Поле должно содержать не более ' . (int)$value . ' символов.';
    }

    public function isMaxBytes($data, $value): string
    {
        return is_string($data) && strlen($data) <= (int)$value ? '' : 'Пароль должен занимать не более ' . (int)$value . ' байт в UTF-8.';
    }

    public function Validate(array $postArray): void
    {
        $this->Errors = [];

        foreach ($this->Rules as $rule) {
            $fieldName = $rule['field'];
            $validatorName = lcfirst((string) $rule['validator']);
            $fieldValue = $postArray[$fieldName] ?? null;

            if (!method_exists($this, $validatorName)) {
                continue;
            }

            $message = $rule['value'] !== null
                ? $this->{$validatorName}($fieldValue, $rule['value'])
                : $this->{$validatorName}($fieldValue);

            if ($message !== '') {
                $this->Errors[$fieldName][] = $message;
            }
        }
    }

    public function ShowErrors(): string
    {
        if (count($this->Errors) === 0) {
            return '';
        }

        $html = '<div class="message-box message-box--error"><h3 class="pixel-text">Ошибки валидации</h3><ul>';
        foreach ($this->Errors as $fieldErrors) {
            foreach ($fieldErrors as $error) {
                $html .= '<li>' . htmlspecialchars($error, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</li>';
            }
        }

        $html .= '</ul></div>';
        return $html;
    }
}
