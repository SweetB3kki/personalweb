<section class="window-frame window-surface">
    <header class="window-frame__titlebar pixel-text">Гостевая книга</header>
    <div class="window-frame__body">
        <?= $model->validator->ShowErrors() ?>
        <?php if ($model->successMessage): ?><p class="message-box"><?= e($model->successMessage) ?></p><?php endif; ?>
        <form method="post" class="site-form">
            <input type="hidden" name="csrf" value="<?= e(Csrf::token()) ?>">
            <?php foreach (['surname' => 'Фамилия', 'name' => 'Имя', 'patronymic' => 'Отчество', 'email' => 'E-mail'] as $field => $label): ?>
                <label class="site-form__field"><?= e($label) ?><input type="<?= $field === 'email' ? 'email' : 'text' ?>" name="<?= e($field) ?>" value="<?= e($model->formData[$field] ?? '') ?>" required></label>
            <?php endforeach; ?>
            <label class="site-form__field">Текст отзыва<textarea name="message" rows="4" required><?= e($model->formData['message'] ?? '') ?></textarea></label>
            <button class="retro-button" type="submit">Оставить отзыв</button>
        </form>
        <div class="table-wrap"><table class="data-table">
            <thead><tr><th>Дата</th><th>ФИО</th><th>E-mail</th><th>Отзыв</th></tr></thead>
            <tbody><?php foreach ($model->messages as $row): ?><tr><?php foreach ($row as $cell): ?><td><?= nl2br(e($cell)) ?></td><?php endforeach; ?></tr><?php endforeach; ?></tbody>
        </table></div>
    </div>
</section>
