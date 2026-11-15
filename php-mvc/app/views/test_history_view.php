<section class="window-frame window-surface">
    <header class="window-frame__titlebar pixel-text">Результаты тестирования</header>
    <div class="window-frame__body table-wrap">
        <table class="data-table"><thead><tr><th>Дата</th><th>ФИО / группа</th><th>Ответы</th><th>Проверка</th></tr></thead><tbody>
        <?php foreach ($model->history as $record): ?>
            <tr><td><?= e($record->created_at) ?></td><td><?= e($record->fio) ?><br><?= e($record->group_name) ?></td>
                <td><?php foreach (json_decode($record->answers, true) as $key => $answer): ?><?php if (str_starts_with($key, 'question')): ?><p><?= e(is_array($answer) ? implode('; ', $answer) : $answer) ?></p><?php endif; ?><?php endforeach; ?></td>
                <td><?php foreach (json_decode($record->results, true) as $result): ?><p><?= e($result['question']) ?>: <?= $result['status'] ? 'Верно' : 'Неверно' ?></p><?php endforeach; ?><?= $record->score ?> из 3</td>
            </tr>
        <?php endforeach; ?>
        </tbody></table>
    </div>
</section>
