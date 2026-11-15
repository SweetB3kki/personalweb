<?php
declare(strict_types=1);

$profile = $model->getProfile();
$summary = $model->getStudySummary();
$subjects = $model->getStudySubjects();
?>
<section class="window-frame window-surface">
    <header class="window-frame__titlebar pixel-text">
        <div class="window-frame__title">
            <img src="<?= e($profile['mark']) ?>" alt="Сводка" class="window-frame__icon">
            <span>Сводка по учёбе</span>
        </div>
        <div class="window-frame__controls" aria-hidden="true"><span></span><span></span><span class="window-frame__control-close"></span></div>
    </header>
    <div class="window-frame__body">
        <div class="stats-grid stats-grid--triple">
            <?php foreach ($summary as $item): ?>
                <article class="stat-card">
                    <span class="pixel-text"><?= e($item['label']) ?></span>
                    <strong><?= e($item['value']) ?></strong>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="window-frame window-surface">
    <header class="window-frame__titlebar pixel-text">
        <div class="window-frame__title">
            <img src="<?= e($profile['logo']) ?>" alt="Учебный план" class="window-frame__icon">
            <span>Учебный план</span>
        </div>
        <div class="window-frame__controls" aria-hidden="true"><span></span><span></span><span class="window-frame__control-close"></span></div>
    </header>
    <div class="window-frame__body window-frame__body--flush">
        <div class="table-wrap">
            <table class="study-table">
                <thead class="pixel-text">
                    <tr>
                        <th>№</th>
                        <th>Дисциплина</th>
                        <th>Кафедра</th>
                        <th>Всего</th>
                        <th>Ауд</th>
                        <th>Лк</th>
                        <th>Лб</th>
                        <th>Пр</th>
                        <th>СРС</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($subjects as $index => $subject): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= e($subject['name']) ?></td>
                            <td><?= e($subject['department']) ?></td>
                            <td><?= (int) $subject['totalHours'] ?></td>
                            <td><?= (int) $subject['aud'] ?></td>
                            <td><?= (int) $subject['lecture'] ?></td>
                            <td><?= (int) $subject['lab'] ?></td>
                            <td><?= (int) $subject['practice'] ?></td>
                            <td><?= (int) $subject['srs'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
