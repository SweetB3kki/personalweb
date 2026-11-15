<?php
declare(strict_types=1);
class AuthController extends Controller
{
    public function check(): void
    {
        header('Content-Type: application/javascript; charset=UTF-8');
        header('Cache-Control: no-store');
        $login = trim((string)($_GET['login'] ?? ''));
        $available = $login !== '' && $login !== Auth::ADMIN_LOGIN && mb_strlen($login) <= 100 && !UserModel::byLogin($login);
        $xml = '<login><value>' . htmlspecialchars($login, ENT_XML1 | ENT_QUOTES, 'UTF-8') . '</value><available>' . ($available ? 'true' : 'false') . '</available></login>';
        // Script transport must return JavaScript; its payload is an XML document.
        echo 'window.loginChecked(' . json_encode($xml, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) . ');';
    }
    public function index(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (Auth::loginAdmin(trim((string)($_POST['login'] ?? '')), (string)($_POST['password'] ?? ''))) {
                header('Location: ' . Auth::afterLogin('/page/index')); return;
            }
            $user = UserModel::byLogin(trim((string)($_POST['login'] ?? '')));
            if ($user && password_verify((string)($_POST['password'] ?? ''), $user->password_hash)) {
                session_regenerate_id(true);
                $_SESSION['user'] = ['id' => $user->id, 'fio' => $user->fio];
                header('Location: ' . Auth::afterLogin('/page/index')); return;
            }
            $this->model->validator->Errors['login'][] = 'Неверный логин или пароль.';
        }
        $this->view->render('auth_view.php', 'Вход', $this->model);
    }
    public function register(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') $this->model->register($_POST);
        $this->view->render('register_view.php', 'Регистрация', $this->model);
    }
    public function logout(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); return; }
        $_SESSION = [];
        session_regenerate_id(true);
        header('Location: /page/index');
    }
}
