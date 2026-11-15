<?php
declare(strict_types=1);
require_once __DIR__ . '/../core/base_active_record.php';

class TestresultModel extends BaseActiveRecord
{
    protected static string $table = 'test_results';
    protected static array $fields = ['fio', 'group_name', 'answers', 'results', 'score', 'created_at'];
    public string $fio = '';
    public string $group_name = '';
    public string $answers = '';
    public string $results = '';
    public int $score = 0;
    public string $created_at = '';
}
