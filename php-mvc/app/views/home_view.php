<?php
declare(strict_types=1);

$profile = $model->getProfile();
$shortcuts = $model->getShortcuts();
?>
<div class="page-grid">
    <section class="window-frame window-surface">
        <header class="window-frame__titlebar pixel-text">
            <div class="window-frame__title">
                <img src="<?= e($profile['mark']) ?>" alt="Профиль" class="window-frame__icon">
                <span>Профиль</span>
            </div>
            <div class="window-frame__controls" aria-hidden="true"><span></span><span></span><span class="window-frame__control-close"></span></div>
        </header>
        <div class="window-frame__body">
            <div class="hero-panel">
                <img src="<?= e($profile['avatar']) ?>" alt="<?= e($profile['name']) ?>" class="hero-panel__photo">
                <div class="hero-panel__copy">
                    <p class="hero-panel__eyebrow pixel-text"><?= e($profile['alias']) ?></p>
                    <h1 class="hero-panel__title pixel-text"><?= e($profile['name']) ?></h1>
                    <p class="hero-panel__meta"><?= e($profile['role']) ?></p>
                    <p class="hero-panel__text"><?= e($profile['intro']) ?></p>
                </div>
            </div>
        </div>
    </section>

    <section class="window-frame window-surface">
        <header class="window-frame__titlebar pixel-text">
            <div class="window-frame__title">
                <img src="<?= e($profile['mark']) ?>" alt="Ярлыки" class="window-frame__icon">
                <span>Ярлыки</span>
            </div>
            <div class="window-frame__controls" aria-hidden="true"><span></span><span></span><span class="window-frame__control-close"></span></div>
        </header>
        <div class="window-frame__body">
            <div class="shortcut-list">
                <?php foreach ($shortcuts as $shortcut): ?>
                    <a class="shortcut-list__item" href="<?= e($shortcut['url']) ?>">
                        <img src="<?= e($profile['mark']) ?>" alt="" class="shortcut-list__icon">
                        <div>
                            <strong class="pixel-text"><?= e($shortcut['title']) ?></strong>
                            <p><?= e($shortcut['caption']) ?></p>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</div>

<section class="window-frame window-surface">
    <header class="window-frame__titlebar pixel-text">
        <div class="window-frame__title">
            <img src="<?= e($profile['mark']) ?>" alt="Сводка" class="window-frame__icon">
            <span>Системная сводка</span>
        </div>
        <div class="window-frame__controls" aria-hidden="true"><span></span><span></span><span class="window-frame__control-close"></span></div>
    </header>
    <div class="window-frame__body">
        <div class="stats-grid">
            <article class="stat-card">
                <span class="pixel-text">Группа</span>
                <strong><?= e($profile['group']) ?></strong>
            </article>
            <article class="stat-card">
                <span class="pixel-text">Город</span>
                <strong><?= e($profile['city']) ?></strong>
            </article>
            <article class="stat-card">
                <span class="pixel-text">Email</span>
                <strong><?= e($profile['email']) ?></strong>
            </article>
            <article class="stat-card">
                <span class="pixel-text">Телеграм</span>
                <strong><?= e($profile['telegram']) ?></strong>
            </article>
        </div>
    </div>
</section>
