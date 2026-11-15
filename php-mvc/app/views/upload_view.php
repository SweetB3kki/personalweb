<section class="window-frame window-surface">
    <header class="window-frame__titlebar pixel-text"><?= e($title) ?></header>
    <div class="window-frame__body">
        <?= $model->validator->ShowErrors() ?>
        <?php if ($model->successMessage): ?><p class="message-box"><?= e($model->successMessage) ?></p><?php endif; ?>
        <form method="post" enctype="multipart/form-data" class="site-form">
            <input type="hidden" name="csrf" value="<?= e(Csrf::token()) ?>">
            <label class="site-form__field">Файл<input type="file" name="file" required></label>
            <button class="retro-button" type="submit">Загрузить</button>
        </form>
    </div>
</section>
