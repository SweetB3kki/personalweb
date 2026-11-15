<?php
declare(strict_types=1);

require_once __DIR__ . '/../models/validators/form_validation.php';

class Model
{
    public FormValidation $validator;
    public array $formData = [];
    public string $successMessage = '';

    public function __construct()
    {
        $this->validator = new FormValidation();
    }

    public function validate(array $postData): bool
    {
        $this->formData = $postData;
        $this->validator->Validate($postData);

        return count($this->validator->Errors) === 0;
    }
}
