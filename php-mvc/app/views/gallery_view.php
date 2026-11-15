<?php
declare(strict_types=1);

$profile = $model->getProfile();
$photos = $model->getPhotos();
$photoRows = array_chunk($photos, 3, true);
?>
<section class="window-frame window-surface">
    <header class="window-frame__titlebar pixel-text">
        <div class="window-frame__title">
            <img src="<?= e($profile['mark']) ?>" alt="Фотоархив" class="window-frame__icon">
            <span>Фотоархив</span>
        </div>
        <div class="window-frame__controls" aria-hidden="true"><span></span><span></span><span class="window-frame__control-close"></span></div>
    </header>
    <div class="window-frame__body">
        <div class="photo-table-wrap">
            <table class="photo-grid-table" aria-label="Фотоархив">
                <tbody>
                    <?php foreach ($photoRows as $row): ?>
                        <tr>
                            <?php foreach ($row as $index => $photo): ?>
                                <td>
                                    <article class="photo-card">
                                        <div class="photo-card__content">
                                            <img src="<?= e($photo['src']) ?>" alt="<?= e($photo['title']) ?>" class="photo-card__image">
                                            <span class="photo-card__index pixel-text">Кадр <?= $index + 1 ?></span>
                                            <h2 class="photo-card__title pixel-text"><?= e($photo['title']) ?></h2>
                                            <p class="photo-card__description"><?= e($photo['description']) ?></p>
                                        </div>
                                    </article>
                                </td>
                            <?php endforeach; ?>
                            <?php for ($emptyCell = count($row); $emptyCell < 3; $emptyCell++): ?>
                                <td class="photo-grid-table__empty" aria-hidden="true"></td>
                            <?php endfor; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
