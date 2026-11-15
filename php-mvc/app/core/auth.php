<?php
declare(strict_types=1);
class Auth
{
    public const ADMIN_LOGIN = 'admin';
    // Precomputed hash of the local demonstration password qwerty.
    public const ADMIN_HASH = 'd8578edf8458ce06fbc5bb76a58c5ca4';
    public static function admin(): bool { return ($_SESSION['isAdmin'] ?? false) === true; }
    public static function user(): ?array { return $_SESSION['user'] ?? null; }
    public static function authenticated(): bool { return self::admin() || self::user() !== null; }

    public static function loginAdmin(string $login, string $password): bool
    {
        if ($login !== self::ADMIN_LOGIN || !hash_equals(self::ADMIN_HASH, md5($password))) return false;
        session_regenerate_id(true);
        $_SESSION['isAdmin'] = true;
        return true;
    }

    public static function afterLogin(string $default): string
    {
        $target = $_SESSION['afterLogin'] ?? '';
        unset($_SESSION['afterLogin']);
        return in_array($target, ['/test/index', '/test/history'], true) ? $target : $default;
    }

    public static function requireAuthenticated(): void
    {
        if (self::authenticated()) return;
        $_SESSION['afterLogin'] = ($_SERVER['REQUEST_METHOD'] === 'GET' && parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) === '/test/history') ? '/test/history' : '/test/index';
        header('Location: /auth/index');
        exit;
    }
    public static function requireAdmin(): void
    {
        if (!self::admin()) { header('Location: /admin/auth/index'); exit; }
    }
    public static function requireUser(): void
    {
        if (!self::user()) { header('Location: /auth/index'); exit; }
    }
}
