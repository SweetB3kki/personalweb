<?php
require_once __DIR__ . '/../core/base_active_record.php';
require_once __DIR__ . '/../core/pagination.php';
class VisitorModel extends BaseActiveRecord
{
    protected static string $table = 'visits';
    protected static array $fields = ['visited_at', 'page', 'ip', 'hostname', 'browser'];
    public string $visited_at = '';
    public string $page = '';
    public string $ip = '';
    public string $hostname = '';
    public string $browser = '';
    public array $visits = [];
    public ?Pagination $pagination = null;
    public static function track(): void
    {
        $visit = new self();
        $visit->visited_at = date('Y-m-d H:i:s');
        $visit->page = substr(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH), 0, 255);
        $visit->ip = $_SERVER['REMOTE_ADDR'] ?? '';
        $visit->hostname = gethostbyaddr($visit->ip) ?: $visit->ip;
        $visit->browser = substr($_SERVER['HTTP_USER_AGENT'] ?? '', 0, 500);
        $visit->save();
    }
    public function loadPage(int $page): void
    {
        $this->pagination = new Pagination((int)Database::connection()->query('SELECT COUNT(*) FROM visits')->fetchColumn(), $page);
        $query = Database::connection()->prepare('SELECT * FROM visits ORDER BY visited_at DESC, id DESC LIMIT ? OFFSET ?');
        $query->bindValue(1, Pagination::PER_PAGE, PDO::PARAM_INT);
        $query->bindValue(2, $this->pagination->offset, PDO::PARAM_INT);
        $query->execute();
        $this->visits = $query->fetchAll();
    }
}
