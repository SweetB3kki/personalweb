<?php
declare(strict_types=1);

class View
{
    public function render(string $contentView, string $title, $model = null, string $layout = 'layout.php'): void
    {
        require_once __DIR__ . '/../views/partials/helpers.php';
        include __DIR__ . '/../views/' . $layout;
    }
}
