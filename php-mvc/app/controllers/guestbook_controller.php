<?php
declare(strict_types=1);
class GuestbookController extends Controller
{
    public function index(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') $this->model->submit($_POST);
        $this->model->load();
        $this->view->render('guestbook_view.php', 'Гостевая книга', $this->model);
    }
    public function upload(): void
    {
        Auth::requireAdmin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $file = $_FILES['file'] ?? [];
            if (($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK || ($file['size'] ?? 0) > 2 * 1024 * 1024) {
                $this->model->validator->Errors['file'][] = 'Выберите messages.inc до 2 МБ.';
            } else $this->model->import($file['tmp_name']);
        }
        $this->view->render('upload_view.php', 'Загрузка сообщений гостевой книги', $this->model);
    }
}
