<?php
declare(strict_types=1);

class Router
{
    public static function bootstrapRequest(): void
    {
        if (!empty($_REQUEST['controller']) || !empty($_REQUEST['action'])) {
            return;
        }

        $path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
        $segments = array_values(array_filter(explode('/', trim($path, '/'))));

        if (($segments[0] ?? '') === 'index.php') {
            array_shift($segments);
        }

        if (($segments[0] ?? '') === 'admin') {
            $_REQUEST['admin_area'] = 1;
            array_shift($segments);
        }

        $_REQUEST['controller'] = $segments[0] ?? 'page';
        $_REQUEST['action'] = $segments[1] ?? 'index';
        $_GET['controller'] = $_REQUEST['controller'];
        $_GET['action'] = $_REQUEST['action'];
    }

    public static function route(): void
    {
        $controllerName = self::sanitizeName($_REQUEST['controller'] ?? 'page');
        $actionName = self::sanitizeName($_REQUEST['action'] ?? 'index');

        if ($controllerName === '') {
            $controllerName = 'page';
        }

        if ($actionName === '') {
            $actionName = 'index';
        }

        if ($controllerName === 'indexphp') {
            $controllerName = 'page';
            $actionName = 'index';
        }

        $admin = str_starts_with(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/admin/');
        $controllerFile = __DIR__ . ($admin ? '/../admin/controllers/admin_' : '/../controllers/') . $controllerName . '_controller.php';
        if (!file_exists($controllerFile)) {
            self::errorPage404('Файл контроллера не найден: ' . $controllerFile);
            return;
        }

        require_once $controllerFile;

        $controllerClassName = ($admin ? 'Admin' : '') . ucfirst($controllerName) . 'Controller';
        if (!class_exists($controllerClassName)) {
            self::errorPage404('Класс контроллера не найден: ' . $controllerClassName);
            return;
        }

        $controller = new $controllerClassName();

        $modelFile = __DIR__ . '/../models/' . $controllerName . '_model.php';
        if (!file_exists($modelFile)) {
            self::errorPage404('Файл модели не найден: ' . $modelFile);
            return;
        }

        require_once $modelFile;

        $modelClassName = ucfirst($controllerName) . 'Model';
        if (!class_exists($modelClassName)) {
            self::errorPage404('Класс модели не найден: ' . $modelClassName);
            return;
        }

        $controller->model = new $modelClassName();

        if (!method_exists($controller, $actionName) || !(new ReflectionMethod($controller, $actionName))->isPublic() || str_starts_with($actionName, '__')) {
            self::errorPage404('Метод контроллера не найден: ' . $actionName);
            return;
        }

        $controller->{$actionName}();
    }

    private static function sanitizeName(string $name): string
    {
        return strtolower((string) preg_replace('/[^a-zA-Z0-9_]/', '', $name));
    }

    private static function errorPage404(string $message): void
    {
        http_response_code(404);
        echo '<h1>404</h1><p>' . htmlspecialchars($message, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</p>';
    }
}
