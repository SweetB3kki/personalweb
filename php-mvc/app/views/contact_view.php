<?php
declare(strict_types=1);

$profile = $model->getProfile();
$contacts = $model->getContacts();
$formData = $model->formData;
?>
<div class="page-grid page-grid--equal">
    <section class="window-frame window-surface">
        <header class="window-frame__titlebar pixel-text">
            <div class="window-frame__title">
                <img src="<?= e($profile['mark']) ?>" alt="Связь" class="window-frame__icon">
                <span>Связь</span>
            </div>
            <div class="window-frame__controls" aria-hidden="true"><span></span><span></span><span class="window-frame__control-close"></span></div>
        </header>
        <div class="window-frame__body">
            <div class="contact-list">
                <?php foreach ($contacts as $item): ?>
                    <article class="contact-card">
                        <span class="pixel-text"><?= e($item['label']) ?></span>
                        <?php if ($item['href'] !== ''): ?>
                            <a href="<?= e($item['href']) ?>" target="_blank" rel="noreferrer"><?= e($item['value']) ?></a>
                        <?php else: ?>
                            <strong><?= e($item['value']) ?></strong>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="window-frame window-surface">
        <header class="window-frame__titlebar pixel-text">
            <div class="window-frame__title">
                <img src="<?= e($profile['mark']) ?>" alt="Контакт" class="window-frame__icon">
                <span>Контакт</span>
            </div>
            <div class="window-frame__controls" aria-hidden="true"><span></span><span></span><span class="window-frame__control-close"></span></div>
        </header>
        <div class="window-frame__body">
            <?= $model->validator->ShowErrors() ?>
            <?php if ($model->successMessage !== ''): ?>
                <div class="message-box message-box--success">
                    <h3 class="pixel-text">Успех</h3>
                    <p><?= e($model->successMessage) ?></p>
                </div>
            <?php endif; ?>

            <form action="/contact/submit" method="post" class="site-form">
                <input type="hidden" name="csrf" value="<?= e(Csrf::token()) ?>">
                <label class="site-form__field">
                    <span class="pixel-text">ФИО</span>
                    <input type="text" name="fio" value="<?= e((string) $formData['fio']) ?>">
                </label>
                <label class="site-form__field">
                    <span class="pixel-text">Email</span>
                    <input type="email" name="email" value="<?= e((string) $formData['email']) ?>">
                </label>
                <label class="site-form__field">
                    <span class="pixel-text">Тема</span>
                    <input type="text" name="subject" value="<?= e((string) $formData['subject']) ?>">
                </label>
                <label class="site-form__field">
                    <span class="pixel-text">Сообщение</span>
                    <textarea name="message" rows="6"><?= e((string) $formData['message']) ?></textarea>
                </label>
                <div class="site-form__actions">
                    <button type="submit" class="retro-button pixel-text">Отправить</button>
                    <a href="/contact/index" class="retro-button pixel-text">Очистить</a>
                </div>
            </form>
        </div>
    </section>
</div>
