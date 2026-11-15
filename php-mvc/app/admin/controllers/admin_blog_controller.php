<?php
require_once __DIR__ . '/../../controllers/blog_controller.php';
class AdminBlogController extends BlogController
{
    public function __construct() { parent::__construct(); Auth::requireAdmin(); }
    public function update(): void
    {
        header('Content-Type: application/json; charset=UTF-8');
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); echo json_encode(['error' => 'Требуется POST']); return; }
        $post = BlogModel::find((int)($_POST['id'] ?? 0));
        if (!$post) { http_response_code(404); echo json_encode(['error' => 'Запись не найдена']); return; }
        $data = ['title' => trim((string)($_POST['title'] ?? '')), 'message' => trim((string)($_POST['message'] ?? ''))];
        $post->validator->Validate($data);
        if ($post->validator->Errors || mb_strlen($data['title']) > 255) {
            http_response_code(422); echo json_encode(['error' => 'Укажите тему сообщения длиной до 255 символов.'], JSON_UNESCAPED_UNICODE); return;
        }
        $post->title = $data['title'];
        $post->message = $data['message'];
        $post->save();
        echo json_encode(['id' => $post->id, 'title' => $post->title, 'message' => $post->message], JSON_UNESCAPED_UNICODE);
    }
}
