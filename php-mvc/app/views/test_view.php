<?php
declare(strict_types=1);

$profile = $model->getProfile();
$formData = $model->formData;
$questions = $model->getQuestions();
$groups = $model->getGroups();
$question2Options = $model->getQuestion2Options();
$question3Options = $model->getQuestion3Options();
?>
<div class="page-grid page-grid--equal">
    <section class="window-frame window-surface">
        <header class="window-frame__titlebar pixel-text">
            <div class="window-frame__title">
                <img src="<?= e($profile['mark']) ?>" alt="Инструкция" class="window-frame__icon">
                <span>Инструкция</span>
            </div>
            <div class="window-frame__controls" aria-hidden="true"><span></span><span></span><span class="window-frame__control-close"></span></div>
        </header>
        <div class="window-frame__body">
            <div class="instruction-block">
                <p>Реализованы валидаторы: FormValidation, CustomFormValidation и ResultsVerification.</p>
                <ol>
                    <?php foreach ($questions as $question): ?>
                        <li><?= e($question) ?></li>
                    <?php endforeach; ?>
                </ol>
            </div>
        </div>
    </section>

    <section class="window-frame window-surface">
        <header class="window-frame__titlebar pixel-text">
            <div class="window-frame__title">
                <img src="<?= e($profile['mark']) ?>" alt="PhysicsForm.exe" class="window-frame__icon">
                <span>PhysicsForm.exe</span>
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
            <?= Auth::authenticated() && method_exists($model->validator, 'ShowResults') ? $model->validator->ShowResults() : '' ?>

            <form action="/test/validate" method="post" class="site-form">
                <input type="hidden" name="csrf" value="<?= e(Csrf::token()) ?>">
                <label class="site-form__field">
                    <span class="pixel-text">Фамилия Имя Отчество</span>
                    <input type="text" name="fio" value="<?= e((string) $formData['fio']) ?>">
                </label>

                <label class="site-form__field">
                    <span class="pixel-text">Группа</span>
                    <select name="group">
                        <option value="">Выберите группу</option>
                        <?php foreach ($groups as $label => $items): ?>
                            <optgroup label="<?= e($label) ?>">
                                <?php foreach ($items as $group): ?>
                                    <option value="<?= e($group) ?>"<?= $formData['group'] === $group ? ' selected' : '' ?>><?= e($group) ?></option>
                                <?php endforeach; ?>
                            </optgroup>
                        <?php endforeach; ?>
                    </select>
                </label>

                <label class="site-form__field">
                    <span class="pixel-text">Вопрос 1</span>
                    <input type="text" name="question1" value="<?= e((string) $formData['question1']) ?>" placeholder="Например: F = m * a">
                </label>

                <label class="site-form__field">
                    <span class="pixel-text">Вопрос 2</span>
                    <select name="question2">
                        <option value="">Выберите ответ</option>
                        <?php foreach ($question2Options as $option): ?>
                            <option value="<?= e($option) ?>"<?= $formData['question2'] === $option ? ' selected' : '' ?>><?= e($option) ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>

                <fieldset class="site-form__field">
                    <legend class="pixel-text">Вопрос 3</legend>
                    <?php foreach ($question3Options as $option): ?>
                        <label class="site-form__check">
                            <input type="checkbox" name="question3[]" value="<?= e($option) ?>"<?= in_array($option, (array) $formData['question3'], true) ? ' checked' : '' ?>>
                            <span><?= e($option) ?></span>
                        </label>
                    <?php endforeach; ?>
                </fieldset>

                <div class="site-form__actions">
                    <button type="submit" class="retro-button pixel-text">Проверить</button>
                    <a href="/test/index" class="retro-button pixel-text">Очистить</a>
                </div>
            </form>
        </div>
    </section>
</div>
