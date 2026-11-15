<section class="window-frame window-surface">
    <header class="window-frame__titlebar pixel-text">Статистика посещений</header>
    <div class="window-frame__body table-wrap">
        <table class="data-table"><thead><tr><th>Дата и время</th><th>Страница</th><th>IP</th><th>Хост</th><th>Браузер</th></tr></thead><tbody>
        <?php foreach ($model->visits as $visit): ?><tr><?php foreach (['visited_at', 'page', 'ip', 'hostname', 'browser'] as $field): ?><td><?= e($visit[$field]) ?></td><?php endforeach; ?></tr><?php endforeach; ?>
        </tbody></table>
        <?php $pagination = $model->pagination; include __DIR__ . '/partials/pagination.php'; ?>
    </div>
</section>
