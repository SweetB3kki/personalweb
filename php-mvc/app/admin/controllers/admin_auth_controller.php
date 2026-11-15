<?php
class AdminAuthController extends Controller
{
    public function index(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (Auth::loginAdmin(trim((string)($_POST['login'] ?? '')), (string)($_POST['password'] ?? ''))) {
                header('Location: ' . Auth::afterLogin('/admin/blog/edit')); return;
            }
            $this->model->validator->Errors['login'][] = 'Неверный логин или пароль.';
        }
        $this->view->render('auth_view.php', 'Вход администратора', $this->model);
    }
    public function logout(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); return; }
        unset($_SESSION['isAdmin']);
        session_regenerate_id(true);
        header('Location: /page/index');
    }
}
