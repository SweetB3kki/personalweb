<?php
declare(strict_types=1);
require_once __DIR__ . '/../core/base_active_record.php';
class UserModel extends BaseActiveRecord
{
    protected static string $table = 'users';
    protected static array $fields = ['fio', 'email', 'login', 'password_hash', 'created_at'];
    public string $fio = '';
    public string $email = '';
    public string $login = '';
    public string $password_hash = '';
    public string $created_at = '';
    public static function byLogin(string $login): ?self
    {
        $query = Database::connection()->prepare('SELECT * FROM users WHERE login = ?');
        $query->execute([$login]);
        $row = $query->fetch();
        return $row ? self::hydrate($row) : null;
    }
}
