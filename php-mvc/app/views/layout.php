<?php
declare(strict_types=1);

require_once __DIR__ . '/../models/page_model.php';

$profile = PageModel::profile();
$navigation = PageModel::navigation();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="/public/assets/img/branding/damnwear-mark.svg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($title) ?> | <?= e($profile['alias']) ?></title>
    <link rel="stylesheet" href="/public/assets/css/style.css">
    <link rel="stylesheet" href="/public/assets/css/labs.css">
</head>
<body>
    <div class="site-shell">
        <header class="site-chrome window-surface">
            <div class="site-chrome__brand pixel-text">
                <img src="<?= e($profile['mark']) ?>" alt="<?= e($profile['alias']) ?>">
                <span><?= e($profile['alias']) ?></span>
            </div>
            <div class="site-chrome__controls" aria-hidden="true">
                <span></span>
                <span></span>
                <span class="site-chrome__control-close"></span>
            </div>
        </header>

        <nav class="site-nav window-surface">
            <?php foreach ($navigation as $item): ?>
                <a class="site-nav__link pixel-text<?= isActiveUrl($item['url']) ? ' site-nav__link--active' : '' ?>" href="<?= e($item['url']) ?>">
                    <?= e($item['label']) ?>
                </a>
            <?php endforeach; ?>
            <?php foreach (['/guestbook/index' => 'Гостевая книга', '/blog/index' => 'Мой блог', '/test/history' => 'Результаты тестов'] as $url => $label): ?>
                <a class="site-nav__link pixel-text" href="<?= e($url) ?>"><?= e($label) ?></a>
            <?php endforeach; ?>
        </nav>
        <div class="account-bar window-surface">
            <?php if (Auth::user()): ?>
                <span>Пользователь: <?= e(Auth::user()['fio']) ?></span>
                <form action="/auth/logout" method="post"><input type="hidden" name="csrf" value="<?= e(Csrf::token()) ?>"><button class="retro-button">Выйти</button></form>
            <?php elseif (!Auth::admin()): ?><a href="/auth/index">Войти</a><a href="/auth/register">Регистрация</a><?php endif; ?>
            <?php if (Auth::admin()): ?>
                <span>Администратор: <?= e(Auth::ADMIN_LOGIN) ?></span>
                <a href="/admin/blog/edit">Редактор блога</a><a href="/admin/blog/upload">Загрузка CSV</a><a href="/admin/guestbook/upload">Загрузка отзывов</a><a href="/admin/visitor/index">Статистика посещений</a>
                <form method="post" action="/admin/auth/logout"><input type="hidden" name="csrf" value="<?= e(Csrf::token()) ?>"><button class="retro-button">Выход администратора</button></form>
            <?php else: ?><a href="/admin/auth/index">Администратор</a><?php endif; ?>
        </div>

        <main class="site-main">
            <?php include __DIR__ . '/' . $contentView; ?>
        </main>

        <footer class="site-footer window-surface">
            <span>Лабораторная работа №11. Персональный сайт.</span>
            <span><?= e($profile['city']) ?></span>
        </footer>
    </div>
</body>
<script src="/public/assets/js/ajax.js" defer></script>
</html>
