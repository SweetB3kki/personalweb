<?php
declare(strict_types=1);

$profile = $model->getProfile();
$categories = $model->getCategories();
$currentCategory = $model->getCurrentCategory();
$interests = $model->getInterests();
?>
<div class="page-grid page-grid--interests">
    <section class="window-frame window-surface">
        <header class="window-frame__titlebar pixel-text">
            <div class="window-frame__title">
                <img src="<?= e($profile['mark']) ?>" alt="Категории" class="window-frame__icon">
                <span>Категории</span>
            </div>
            <div class="window-frame__controls" aria-hidden="true"><span></span><span></span><span class="window-frame__control-close"></span></div>
        </header>
        <div class="window-frame__body">
            <div class="category-menu">
                <?php foreach ($categories as $slug => $label): ?>
                    <a class="category-menu__link<?= $slug === $currentCategory ? ' category-menu__link--active' : '' ?>" href="/interest/index?category=<?= e($slug) ?>">
                        <?= e($label) ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="window-frame window-surface">
        <header class="window-frame__titlebar pixel-text">
            <div class="window-frame__title">
                <img src="<?= e($profile['mark']) ?>" alt="Интересы" class="window-frame__icon">
                <span>Интересы</span>
            </div>
            <div class="window-frame__controls" aria-hidden="true"><span></span><span></span><span class="window-frame__control-close"></span></div>
        </header>
        <div class="window-frame__body">
            <div class="interest-grid">
                <?php foreach ($interests as $interest): ?>
                    <article class="interest-card">
                        <h2 class="pixel-text"><?= e($interest['title']) ?></h2>
                        <p><?= e($interest['description']) ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</div>
