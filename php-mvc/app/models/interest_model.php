<?php
declare(strict_types=1);

require_once __DIR__ . '/page_model.php';

class InterestModel extends Model
{
    public const CATEGORIES = [
        'all' => 'Все категории',
        'development' => 'Разработка',
        'creative' => 'Творчество',
        'lifestyle' => 'Стиль жизни',
    ];

    public const INTERESTS = [
        ['category' => 'development', 'title' => 'Программирование', 'description' => 'Мне нравится писать код и решать сложные задачи, изучая новые технологии.'],
        ['category' => 'development', 'title' => 'Гейм-дизайн', 'description' => 'Я увлечен созданием собственной игры, разрабатывая интересные механики и визуальные решения.'],
        ['category' => 'creative', 'title' => 'Музыка', 'description' => 'Я люблю слушать и создавать музыку, это помогает мне расслабиться и вдохновляет на новые проекты.'],
        ['category' => 'creative', 'title' => 'Фотография', 'description' => 'Мне нравится фотографировать и редактировать снимки.'],
        ['category' => 'creative', 'title' => 'Видеомонтаж', 'description' => 'Я люблю создавать нарезки из игр с друзьями.'],
        ['category' => 'lifestyle', 'title' => 'Концерты', 'description' => 'Мне нравится посещать концерты и фестивали, наслаждаясь живой музыкой и атмосферой.'],
    ];

    private string $currentCategory = 'all';

    public function getProfile(): array
    {
        return PageModel::profile();
    }

    public function setCurrentCategory(string $category): void
    {
        $this->currentCategory = array_key_exists($category, self::CATEGORIES) ? $category : 'all';
    }

    public function getCurrentCategory(): string
    {
        return $this->currentCategory;
    }

    public function getCategories(): array
    {
        return self::CATEGORIES;
    }

    public function getInterests(): array
    {
        if ($this->currentCategory === 'all') {
            return self::INTERESTS;
        }

        return array_values(array_filter(self::INTERESTS, function (array $interest): bool {
            return $interest['category'] === $this->currentCategory;
        }));
    }
}
