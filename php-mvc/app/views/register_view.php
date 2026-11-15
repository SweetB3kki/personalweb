<section class="window-frame window-surface">
    <header class="window-frame__titlebar pixel-text">Регистрация пользователя</header>
    <div class="window-frame__body">
        <?= $model->validator->ShowErrors() ?>
        <?php if ($model->successMessage): ?><p class="message-box"><?= e($model->successMessage) ?></p><?php endif; ?>
        <form method="post" class="site-form" id="registration-form">
            <input type="hidden" name="csrf" value="<?= e(Csrf::token()) ?>">
            <?php foreach (['fio' => 'ФИО', 'email' => 'E-mail', 'login' => 'Логин', 'password' => 'Пароль'] as $name => $label): ?>
                <label class="site-form__field"><?= e($label) ?><input name="<?= e($name) ?>" type="<?= $name === 'password' ? 'password' : ($name === 'email' ? 'email' : 'text') ?>" value="<?= $name === 'password' ? '' : e($model->formData[$name] ?? '') ?>" required></label>
            <?php endforeach; ?>
            <p id="login-status" role="status"></p>
            <button class="retro-button" id="check-login" type="button">Проверить занятость</button>
            <button class="retro-button" type="submit">Зарегистрироваться</button>
        </form>
    </div>
</section>
