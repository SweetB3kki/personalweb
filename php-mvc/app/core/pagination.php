<?php
declare(strict_types=1);

class Pagination
{
    public const PER_PAGE = 5;
    public int $page;
    public int $pages;
    public int $offset;

    public function __construct(int $total, int $requested)
    {
        $this->pages = max(1, (int) ceil($total / self::PER_PAGE));
        $this->page = max(1, min($requested, $this->pages));
        $this->offset = ($this->page - 1) * self::PER_PAGE;
    }
}
