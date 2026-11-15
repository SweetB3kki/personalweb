<?php
declare(strict_types=1);

$profile = $model->getProfile();
$paragraphs = $model->getAboutParagraphs();
$education = $model->getEducation();
$softSkills = $model->getSoftSkills();
$hardSkills = $model->getHardSkills();
?>
<section class="window-frame window-surface">
    <header class="window-frame__titlebar pixel-text">
        <div class="window-frame__title">
            <img src="<?= e($profile['mark']) ?>" alt="Досье" class="window-frame__icon">
            <span>Досье</span>
        </div>
        <div class="window-frame__controls" aria-hidden="true"><span></span><span></span><span class="window-frame__control-close"></span></div>
    </header>
    <div class="window-frame__body">
        <div class="profile-sheet">
            <img src="<?= e($profile['avatar']) ?>" alt="<?= e($profile['name']) ?>" class="profile-sheet__photo">
            <div class="profile-sheet__content">
                <h1 class="pixel-text"><?= e($profile['name']) ?></h1>
                <p class="profile-sheet__lead"><?= e($profile['role']) ?></p>
                <?php foreach ($paragraphs as $paragraph): ?>
                    <p class="profile-sheet__paragraph"><?= e($paragraph) ?></p>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<div class="page-grid page-grid--equal">
    <section class="window-frame window-surface">
        <header class="window-frame__titlebar pixel-text">
            <div class="window-frame__title">
                <img src="<?= e($profile['mark']) ?>" alt="Образование" class="window-frame__icon">
                <span>Образование</span>
            </div>
            <div class="window-frame__controls" aria-hidden="true"><span></span><span></span><span class="window-frame__control-close"></span></div>
        </header>
        <div class="window-frame__body">
            <div class="timeline">
                <?php foreach ($education as $item): ?>
                    <article class="timeline__item">
                        <p class="pixel-text timeline__period"><?= e($item['period']) ?></p>
                        <h2><?= e($item['title']) ?></h2>
                        <p><?= e($item['details']) ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="window-frame window-surface">
        <header class="window-frame__titlebar pixel-text">
            <div class="window-frame__title">
                <img src="<?= e($profile['mark']) ?>" alt="Навыки" class="window-frame__icon">
                <span>Навыки</span>
            </div>
            <div class="window-frame__controls" aria-hidden="true"><span></span><span></span><span class="window-frame__control-close"></span></div>
        </header>
        <div class="window-frame__body">
            <div class="skills-block">
                <section>
                    <h2 class="pixel-text skills-block__title">Soft Skills</h2>
                    <ul class="skill-list">
                        <?php foreach ($softSkills as $skill): ?>
                            <li><?= e($skill) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </section>
                <section>
                    <h2 class="pixel-text skills-block__title">Hard Skills</h2>
                    <ul class="skill-list">
                        <?php foreach ($hardSkills as $skill): ?>
                            <li><?= e($skill) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </section>
            </div>
        </div>
    </section>
</div>
