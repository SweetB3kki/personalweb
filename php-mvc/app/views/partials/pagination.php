<?php $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); ?>
<nav class="pagination" aria-label="Страницы">
    <span>Всего страниц: <?= $pagination->pages ?></span>
    <?php if ($pagination->page > 1): ?><a class="retro-button" href="<?= e($path) ?>?page=<?= $pagination->page - 1 ?>">Предыдущая</a><?php endif; ?>
    <?php $start = max(1, min($pagination->page - 2, $pagination->pages - 4)); ?>
    <?php for ($page = $start; $page <= min($pagination->pages, $start + 4); $page++): ?>
        <a class="page-number" <?= $page === $pagination->page ? 'aria-current="page"' : '' ?> href="<?= e($path) ?>?page=<?= $page ?>"><?= $page ?></a>
    <?php endfor; ?>
    <?php if ($pagination->page < $pagination->pages): ?><a class="retro-button" href="<?= e($path) ?>?page=<?= $pagination->page + 1 ?>">Следующая</a><?php endif; ?>
</nav>
