<section class="window-frame window-surface">
    <header class="window-frame__titlebar pixel-text"><?= e($title) ?></header>
    <div class="window-frame__body">
        <?= $model->validator->ShowErrors() ?>
        <?php if ($model->successMessage): ?><p class="message-box"><?= e($model->successMessage) ?></p><?php endif; ?>
        <?php if ($model->editor): ?>
            <form action="/admin/blog/save" method="post" enctype="multipart/form-data" class="site-form">
                <input type="hidden" name="csrf" value="<?= e(Csrf::token()) ?>">
                <label class="site-form__field">Тема сообщения<input name="title" maxlength="255" value="<?= e($model->formData['title'] ?? '') ?>" required></label>
                <label class="site-form__field">Изображение<input type="file" name="image" accept="image/jpeg,image/png,image/webp"></label>
                <label class="site-form__field">Текст сообщения<textarea name="message" rows="5"><?= e($model->formData['message'] ?? '') ?></textarea></label>
                <button class="retro-button" type="submit">Добавить запись</button>
            </form>
        <?php endif; ?>
        <div class="blog-list">
            <?php foreach ($model->posts as $post): ?>
                <article class="interest-card blog-post" data-post-id="<?= $post->id ?>">
                    <h2 class="pixel-text post-title"><?= e($post->title) ?></h2>
                    <p><?= e($post->created_at) ?> · <?= e($post->author) ?></p>
                    <?php if ($post->image): ?><img class="blog-image" src="<?= e($post->image) ?>" alt="<?= e($post->title) ?>" loading="lazy"><?php endif; ?>
                    <p class="post-message"><?= nl2br(e($post->message)) ?></p>
                    <?php if ($model->editor): ?>
                        <button class="retro-button edit-post" type="button">Изменить</button>
                    <?php else: ?>
                        <div class="comments">
                            <?php require_once __DIR__ . '/../models/comment_model.php'; ?>
                            <?php foreach (CommentModel::forPost($post->id) as $comment): ?><?php include __DIR__ . '/partials/comment.php'; ?><?php endforeach; ?>
                        </div>
                        <?php if (Auth::user()): ?><button class="retro-button add-comment" type="button">Добавить комментарий</button><?php endif; ?>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
            <?php if (!$model->posts): ?><p>Пока нет записей.</p><?php endif; ?>
        </div>
        <?php $pagination = $model->pagination; include __DIR__ . '/partials/pagination.php'; ?>
    </div>
</section>
<dialog id="comment-modal" class="modal">
    <header class="window-frame__titlebar pixel-text">Добавить комментарий</header>
    <form class="site-form" id="comment-form">
        <input type="hidden" name="csrf" value="<?= e(Csrf::token()) ?>"><input name="post_id" type="hidden">
        <label class="site-form__field">Комментарий<textarea name="message" rows="5" required></textarea></label>
        <p class="form-error" role="alert"></p><button class="retro-button">Отправить</button><button type="button" class="retro-button close-modal">Отмена</button>
    </form>
</dialog>
<dialog id="edit-modal" class="modal">
    <header class="window-frame__titlebar pixel-text">Изменить запись</header>
    <form class="site-form" id="edit-form">
        <input type="hidden" name="csrf" value="<?= e(Csrf::token()) ?>"><input name="id" type="hidden">
        <label class="site-form__field">Тема<input name="title" maxlength="255" required></label>
        <label class="site-form__field">Текст<textarea name="message" rows="6"></textarea></label>
        <p class="form-error" role="alert"></p><button class="retro-button">Сохранить изменения</button><button type="button" class="retro-button close-modal">Отмена</button>
    </form>
</dialog>
