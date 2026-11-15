<?php
require_once __DIR__ . '/../core/base_active_record.php';
class CommentModel extends BaseActiveRecord
{
    protected static string $table = 'comments';
    protected static array $fields = ['post_id', 'user_id', 'message', 'created_at'];
    public int $post_id = 0;
    public int $user_id = 0;
    public string $message = '';
    public string $created_at = '';
    public static function forPost(int $id): array
    {
        $query = Database::connection()->prepare('SELECT comments.*, users.fio FROM comments JOIN users ON users.id = comments.user_id WHERE post_id = ? ORDER BY created_at, id');
        $query->execute([$id]);
        return $query->fetchAll();
    }
}
