<?php
declare(strict_types=1);

class PageModel extends Model
{
    public const NAVIGATION = [
        ['label' => 'Рабочий стол', 'url' => '/page/index'],
        ['label' => 'Обо мне', 'url' => '/page/about'],
        ['label' => 'Учёба', 'url' => '/page/study'],
        ['label' => 'Интересы', 'url' => '/interest/index'],
        ['label' => 'Фотоальбом', 'url' => '/photo/index'],
        ['label' => 'Контакты', 'url' => '/contact/index'],
        ['label' => 'Тест', 'url' => '/test/index'],
    ];

    public const PROFILE = [
        'name' => 'Владимир Бунцев',
        'alias' => 'DamnWear.exe',
        'role' => 'Студент, начинающий разработчик',
        'group' => 'ПИ/б-22-1-о',
        'lab' => 'Лабораторная работа №8: PHP MVC приложение',
        'intro' => 'Привет! Я студент-программист, увлеченный гейм-девом. Добро пожаловать на мой персональный сайт!',
        'email' => 'demo@example.com',
        'telegram' => '@sweet_b3kki',
        'github' => 'SweetB3kki',
        'city' => 'Севастополь, Россия',
        'avatar' => '/public/assets/img/photo_me.jpg',
        'logo' => '/public/assets/img/branding/damnwear-logo.png',
        'mark' => '/public/assets/img/branding/damnwear-mark.svg',
    ];

    public const SHORTCUTS = [
        ['title' => 'Профиль', 'caption' => 'Краткая сводка, биография и навыки', 'url' => '/page/about'],
        ['title' => 'Фотоархив', 'caption' => 'Фотографии из моей жизни', 'url' => '/photo/index'],
        ['title' => 'Интересы', 'caption' => 'Категории интересов и описания', 'url' => '/interest/index'],
        ['title' => 'Тест', 'caption' => 'HTML-форма и серверная проверка ответов', 'url' => '/test/index'],
    ];

    public const ABOUT_PARAGRAPHS = [
        'Меня зовут Владимир, я студент третьего курса Севастопольского государственного университета, Факультета информационных технологий. Моя страсть к программированию началась ещё в школьные годы, и с тех пор я активно изучаю различные аспекты информационных технологий.',
        'Я увлечен разработкой игр и стремлюсь развиваться в этой сфере. Мой образовательный путь позволил мне уверенно овладеть языками программирования, такими как C / C++, C#, Java, JavaScript, а также глубоко погрузиться в изучение основ front-end и back-end разработки.',
        'Для меня программирование - это не просто работа, это способ воплощения своих идей в жизнь, создания инноваций, которые могут улучшить жизнь людей. Я верю, что в мире, где технологии играют все более важную роль, программисты являются настоящими архитекторами будущего.',
    ];

    public const EDUCATION = [
        ['period' => '2011-2022', 'title' => 'Полное общее образование', 'details' => 'ГБОУ СОШ №18'],
        ['period' => '2022-2027', 'title' => 'Бакалавриат, 09.03.03', 'details' => 'Севастопольский государственный университет, Факультет информационных технологий'],
    ];

    public const SOFT_SKILLS = [
        'Ответственность',
        'Честность',
        'Адаптивность',
        'Усидчивость',
        'Командная работа',
    ];

    public const HARD_SKILLS = [
        'C / C++',
        'Java / JavaScript',
        'C#',
        'HTML / CSS',
        'Базы данных (SQL)',
        'Python',
        'Git',
        'MS Office',
        'Английский язык B1',
        'Adobe Photoshop / Premiere / After Effects',
        'Blender / Unity',
    ];

    public const STUDY_SUBJECTS = [
        ['name' => 'Экология', 'department' => 'БЖ', 'totalHours' => 54, 'aud' => 27, 'lecture' => 18, 'lab' => 0, 'practice' => 9, 'srs' => 27],
        ['name' => 'Высшая математика', 'department' => 'ВМ', 'totalHours' => 540, 'aud' => 282, 'lecture' => 141, 'lab' => 0, 'practice' => 141, 'srs' => 258],
        ['name' => 'Русский язык и культура речи', 'department' => 'НГиГ', 'totalHours' => 108, 'aud' => 54, 'lecture' => 18, 'lab' => 0, 'practice' => 36, 'srs' => 54],
        ['name' => 'Основы дискретной математики', 'department' => 'ИС', 'totalHours' => 216, 'aud' => 139, 'lecture' => 87, 'lab' => 0, 'practice' => 52, 'srs' => 77],
        ['name' => 'Основы программирования и алгоритмические языки', 'department' => 'ИС', 'totalHours' => 405, 'aud' => 210, 'lecture' => 105, 'lab' => 87, 'practice' => 18, 'srs' => 195],
        ['name' => 'Основы экологии', 'department' => 'ПЭОП', 'totalHours' => 54, 'aud' => 27, 'lecture' => 18, 'lab' => 0, 'practice' => 9, 'srs' => 27],
        ['name' => 'Теория вероятностей и математическая статистика', 'department' => 'ИС', 'totalHours' => 162, 'aud' => 72, 'lecture' => 54, 'lab' => 0, 'practice' => 18, 'srs' => 90],
        ['name' => 'Физика', 'department' => 'Физики', 'totalHours' => 324, 'aud' => 194, 'lecture' => 106, 'lab' => 88, 'practice' => 0, 'srs' => 130],
        ['name' => 'Основы электротехники и электроники', 'department' => 'ИС', 'totalHours' => 108, 'aud' => 72, 'lecture' => 36, 'lab' => 18, 'practice' => 18, 'srs' => 36],
        ['name' => 'Численные методы в информатике', 'department' => 'ИС', 'totalHours' => 189, 'aud' => 89, 'lecture' => 36, 'lab' => 36, 'practice' => 17, 'srs' => 100],
        ['name' => 'Методы исследования операций', 'department' => 'ИС', 'totalHours' => 216, 'aud' => 104, 'lecture' => 52, 'lab' => 35, 'practice' => 17, 'srs' => 112],
    ];

    public static function navigation(): array
    {
        return self::NAVIGATION;
    }

    public static function profile(): array
    {
        $profile = self::PROFILE;
        foreach (['avatar', 'logo', 'mark'] as $key) {
            if (isset($profile[$key])) {
                $profile[$key] = self::versionedAsset($profile[$key]);
            }
        }

        return $profile;
    }

    public function getProfile(): array
    {
        return self::profile();
    }

    public function getShortcuts(): array
    {
        return self::SHORTCUTS;
    }

    public function getAboutParagraphs(): array
    {
        return self::ABOUT_PARAGRAPHS;
    }

    public function getEducation(): array
    {
        return self::EDUCATION;
    }

    public function getSoftSkills(): array
    {
        return self::SOFT_SKILLS;
    }

    public function getHardSkills(): array
    {
        return self::HARD_SKILLS;
    }

    public function getStudySubjects(): array
    {
        return self::STUDY_SUBJECTS;
    }

    public function getStudySummary(): array
    {
        return [
            ['label' => 'Дисциплин', 'value' => (string) count(self::STUDY_SUBJECTS)],
            ['label' => 'Самая объёмная', 'value' => 'Высшая математика'],
            ['label' => 'Фокус', 'value' => 'Математика, программирование, физика'],
        ];
    }

    private static function versionedAsset(string $webPath): string
    {
        $absolutePath = dirname(__DIR__, 2) . str_replace('/', DIRECTORY_SEPARATOR, $webPath);
        if (!is_file($absolutePath)) {
            return $webPath;
        }

        return $webPath . '?v=' . filemtime($absolutePath);
    }
}
