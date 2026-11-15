<?php
require_once __DIR__ . '/../models/blog_model.php';
class CommentController extends Controller
{
    public function save(): void
    {
        header('Content-Type: text/html; charset=UTF-8');
        require_once __DIR__ . '/../views/partials/helpers.php';
        if (!Auth::user()) { http_response_code(401); echo 'Для комментария нужно войти.'; return; }
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); return; }
        $message = trim((string)($_POST['message'] ?? ''));
        $this->model->validator->SetRule('message', 'isNotEmpty');
        $this->model->validator->Validate(['message' => $message]);
        $post = BlogModel::find((int)($_POST['post_id'] ?? 0));
        if (!$post || $this->model->validator->Errors) {
            http_response_code(422); echo $post ? 'Введите комментарий.' : 'Запись не найдена.'; return;
        }
        $this->model->post_id = $post->id;
        $this->model->user_id = Auth::user()['id'];
        $this->model->message = $message;
        $this->model->created_at = date('Y-m-d H:i:s');
        $this->model->save();
        $comment = ['message' => $message, 'fio' => Auth::user()['fio'], 'created_at' => $this->model->created_at];
        include __DIR__ . '/../views/partials/comment.php';
    }
}
