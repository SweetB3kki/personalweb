<?php
declare(strict_types=1);

require_once __DIR__ . '/page_model.php';

class PhotoModel extends Model
{
    public const PHOTOS = [
        ['file' => 'photo_me_9.jpg', 'title' => 'Новый Херсонес', 'description' => 'Фото на фоне обворожительного музея'],
        ['file' => 'photo_me_8.jpg', 'title' => 'Питер', 'description' => 'Чиловый парень на фоне Питера'],
        ['file' => 'photo_me_3.png', 'title' => 'Памятник Казарскому', 'description' => 'Зимний вечер в центре города'],
        ['file' => 'photo_me_4.jpeg', 'title' => 'Фотоссесия', 'description' => 'Фотограф топ'],
        ['file' => 'photo_me_6.jpg', 'title' => 'Концерт DK', 'description' => 'Фото с концерта DK в Питере'],
        ['file' => 'photo_me_5.jpeg', 'title' => 'Фотоссесия', 'description' => 'Фотограф нереальный'],
        ['file' => 'photo_me10.jpg', 'title' => 'Питер', 'description' => '52'],
        ['file' => 'photo_me_1.jpg', 'title' => 'Running to 90s', 'description' => 'Вайб девяностых'],
        ['file' => 'photo_me11.jpg', 'title' => 'Школа искусств', 'description' => 'Красивое здание в центре города'],
        ['file' => 'photo_me16.jpg', 'title' => 'Цветы', 'description' => 'Для прекрасной девушки'],
        ['file' => 'photo_me_7.jpg', 'title' => 'День рождения', 'description' => 'Текст'],
        ['file' => 'photo_me17.jpg', 'title' => 'Пикми', 'description' => 'Пикми'],
        ['file' => 'photo_me12.jpg', 'title' => 'Красное озеро', 'description' => 'Кепка с рогами'],
        ['file' => 'photo_me14.jpg', 'title' => 'Река', 'description' => 'Черная речка'],
        ['file' => 'photo_me13.jpg', 'title' => 'День рождения', 'description' => 'Вставьте ваш текст, пожалуйста'],
    ];

    private int $currentPhoto = 0;

    public function getProfile(): array
    {
        return PageModel::profile();
    }

    public function getPhotos(): array
    {
        return array_map(static function (array $photo): array {
            $webPath = '/public/assets/img/' . $photo['file'];
            $absolutePath = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . $photo['file'];
            $photo['src'] = is_file($absolutePath)
                ? $webPath . '?v=' . filemtime($absolutePath)
                : $webPath;
            return $photo;
        }, self::PHOTOS);
    }

    public function setCurrentPhoto(int $index): void
    {
        $maxIndex = count(self::PHOTOS) - 1;
        $this->currentPhoto = max(0, min($index, $maxIndex));
    }

    public function getCurrentPhotoIndex(): int
    {
        return $this->currentPhoto;
    }

    public function getCurrentPhoto(): array
    {
        $photos = $this->getPhotos();
        return $photos[$this->currentPhoto] ?? $photos[0];
    }
}
