<section class="window-frame window-surface">
    <header class="window-frame__titlebar pixel-text"><?= e($title) ?></header>
    <div class="window-frame__body">
        <?= $model->validator->ShowErrors() ?>
        <form method="post" class="site-form">
            <input type="hidden" name="csrf" value="<?= e(Csrf::token()) ?>">
            <label class="site-form__field">Логин<input name="login" autocomplete="username" required></label>
            <label class="site-form__field">Пароль<input name="password" type="password" autocomplete="current-password" required></label>
            <button class="retro-button" type="submit">Войти</button>
        </form>
        <?php if (!str_starts_with($_SERVER['REQUEST_URI'], '/admin/')): ?><a href="/auth/register">Регистрация</a><?php endif; ?>
    </div>
</section>
