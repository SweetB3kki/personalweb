<?php
declare(strict_types=1);
class BlogController extends Controller
{
    public function index(): void { $this->show(false); }
    public function edit(): void { Auth::requireAdmin(); $this->show(true); }
    private function show(bool $editor): void
    {
        $this->model->loadPage((int)($_GET['page'] ?? 1));
        $this->model->editor = $editor;
        $this->view->render('blog_view.php', $editor ? 'Редактор блога' : 'Мой блог', $this->model, $editor ? 'admin_layout.php' : 'layout.php');
    }
    public function save(): void
    {
        Auth::requireAdmin();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); return; }
        $this->model->submit($_POST, $_FILES);
        $this->show(true);
    }
    public function upload(): void
    {
        Auth::requireAdmin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $file = $_FILES['file'] ?? [];
            if (($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK || ($file['size'] ?? 0) > 2 * 1024 * 1024) {
                $this->model->validator->Errors['file'][] = 'Выберите CSV до 2 МБ.';
            } else $this->model->importCsv($file['tmp_name']);
        }
        $this->view->render('upload_view.php', 'Загрузка сообщений блога', $this->model);
    }
}
