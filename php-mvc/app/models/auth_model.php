<?php
declare(strict_types=1);
require_once __DIR__ . '/user_model.php';
class AuthModel extends Model
{
    public function register(array $data): bool
    {
        $this->formData = $data;
        foreach (['fio', 'email', 'login'] as $field) $data[$field] = trim((string)($data[$field] ?? ''));
        foreach (['fio', 'email', 'login', 'password'] as $field) $this->validator->SetRule($field, 'isNotEmpty');
        $this->validator->SetRule('email', 'isEmail');
        foreach (['fio' => 255, 'email' => 255, 'login' => 100] as $field => $limit) $this->validator->SetRule($field, 'isMaxLength', $limit);
        $this->validator->SetRule('password', 'isMaxBytes', 72);
        $this->validator->Validate($data);
        if (trim($data['login'] ?? '') === Auth::ADMIN_LOGIN) $this->validator->Errors['login'][] = 'Этот логин зарезервирован для администратора.';
        if (UserModel::byLogin(trim($data['login'] ?? ''))) $this->validator->Errors['login'][] = 'Логин занят.';
        if ($this->validator->Errors) return false;
        $user = new UserModel();
        $user->fio = trim($data['fio']);
        $user->email = trim($data['email']);
        $user->login = trim($data['login']);
        $user->password_hash = password_hash($data['password'], PASSWORD_DEFAULT);
        $user->created_at = date('Y-m-d H:i:s');
        try { $user->save(); } catch (PDOException $e) {
            if ($e->getCode() !== '23000') throw $e;
            $this->validator->Errors['login'][] = 'Логин занят.';
            return false;
        }
        $this->successMessage = 'Регистрация завершена. Теперь можно войти.';
        return true;
    }
}
