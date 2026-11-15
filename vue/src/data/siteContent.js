export const navigationLinks = [
  { label: 'Рабочий стол', to: '/', short: 'desktop' },
  { label: 'Обо мне', to: '/about', short: 'about' },
  { label: 'Учёба', to: '/study', short: 'study' },
  { label: 'Интересы', to: '/interests', short: 'interests' },
  { label: 'Фотоархив', to: '/gallery', short: 'gallery' },
  { label: 'Контакты', to: '/contacts', short: 'contacts' },
  { label: 'Тест', to: '/test', short: 'test' },
];

export const profile = {
  name: 'Владимир Бунцев',
  alias: 'DamnWear.exe',
  role: 'Студент, начинающий front-end разработчик',
  group: 'ПИ/б-22-1-о',
  lab: 'Лабораторная работа №1: персональный сайт',
  intro:
    'Привет! Я студент-программист, увлеченный веб-разработкой и новыми технологиями. Добро пожаловать на мой персональный сайт!',
  summary: '',
  email: 'demo@example.com',
  telegram: '@sweet_b3kki',
  github: 'SweetB3kki',
  city: 'Севастополь, Россия',
  avatar: '/photo_me.jpg',
  logo: '/branding/damnwear-logo.png',
  mark: '/branding/damnwear-mark.svg',
};

export const desktopShortcuts = [
  { title: 'Профиль', caption: 'Краткая сводка, стек и цель сайта', to: '/about' },
  { title: 'Фотоархив', caption: 'Личный альбом с подписями и сюжетами', to: '/gallery' },
  { title: 'Учёба', caption: 'Дисциплины, часы и учебный трек', to: '/study' },
];

export const aboutParagraphs = [
  'Меня зовут Владимир, и я студент третьего курса Севастопольского Государственного Университета, Института Информационных Технологий. Моя страсть к программированию началась ещё в школьные годы, и с тех пор я активно изучаю различные аспекты информационных технологий.',
  'Я увлечен front-end разработкой и стремлюсь развиваться в этой сфере. Мой образовательный путь позволил мне уверенно владеть языками программирования, такими как C и C++, а также глубоко погрузиться в изучение основ языков Java, JavaScript и front-end разработки.',
  'Для меня программирование - это не просто работа, это способ воплощения своих идей в жизнь, создания инноваций, которые могут улучшить жизнь людей. Я верю, что в мире, где технологии играют все более важную роль, программисты являются настоящими архитекторами будущего.',
];

export const education = [
  { period: '2011–2022', title: 'Полное общее образование', details: 'ГБОУ СОШ №18' },
  {
    period: '2022–2026',
    title: 'Бакалавриат, 09.03.03',
    details: 'Севастопольский государственный университет, Институт информационных технологий',
  },
];

export const softSkills = ['Ответственность', 'Честность', 'Адаптивность', 'Усидчивость', 'Командная работа'];

export const hardSkills = [
  'C / C++',
  'Java / JavaScript',
  'Базовая front-end разработка',
  'Динамические структуры данных',
  'MS Office',
  'Английский язык B1',
  'Adobe Photoshop / Premiere / After Effects',
  'Blender / Unity / Android Studio (база)',
];

export const interests = [
  { title: 'Программирование', description: 'Мне нравится писать код и решать сложные задачи, изучая новые технологии.' },
  { title: 'Искусственный интеллект', description: 'Я увлечён исследованием ИИ и машинного обучения.' },
  { title: 'Музыка', description: 'Я люблю слушать и создавать музыку, это помогает мне расслабиться и вдохновляет на новые идеи.' },
  { title: 'Фотография', description: 'Мне нравится фотографировать и редактировать снимки, передавая через них свои эмоции.' },
  { title: 'Путешествия', description: 'Я люблю исследовать новые места, открывать для себя разные культуры и архитектуру.' },
];

export const studySubjects = [
  { name: 'Экология', department: 'БЖ', totalHours: 54, aud: 27, lecture: 18, lab: 0, practice: 9, srs: 27 },
  { name: 'Высшая математика', department: 'ВМ', totalHours: 540, aud: 282, lecture: 141, lab: 0, practice: 141, srs: 258 },
  { name: 'Русский язык и культура речи', department: 'НГиГ', totalHours: 108, aud: 54, lecture: 18, lab: 0, practice: 36, srs: 54 },
  { name: 'Основы дискретной математики', department: 'ИС', totalHours: 216, aud: 139, lecture: 87, lab: 0, practice: 52, srs: 77 },
  { name: 'Основы программирования и алгоритмические языки', department: 'ИС', totalHours: 405, aud: 210, lecture: 105, lab: 87, practice: 18, srs: 195 },
  { name: 'Основы экологии', department: 'ПЭОП', totalHours: 54, aud: 27, lecture: 18, lab: 0, practice: 9, srs: 27 },
  { name: 'Теория вероятностей и математическая статистика', department: 'ИС', totalHours: 162, aud: 72, lecture: 54, lab: 0, practice: 18, srs: 90 },
  { name: 'Физика', department: 'Физики', totalHours: 324, aud: 194, lecture: 106, lab: 88, practice: 0, srs: 130 },
  { name: 'Основы электротехники и электроники', department: 'ИС', totalHours: 108, aud: 72, lecture: 36, lab: 18, practice: 18, srs: 36 },
  { name: 'Численные методы в информатике', department: 'ИС', totalHours: 189, aud: 89, lecture: 36, lab: 36, practice: 17, srs: 100 },
  { name: 'Методы исследования операций', department: 'ИС', totalHours: 216, aud: 104, lecture: 52, lab: 35, practice: 17, srs: 112 },
];

export const contacts = [
  { label: 'Email', value: profile.email, href: `mailto:${profile.email}` },
  { label: 'Телефон', value: '+7 000 000 00 00' },
  { label: 'Telegram', value: profile.telegram, href: 'https://example.com/' },
  { label: 'ВКонтакте', value: '@sweet_b3kki', href: 'https://example.com/' },
  { label: 'GitHub', value: `github.com/${profile.github}`, href: `https://github.com/${profile.github}` },
];

export const galleryItems = [
  { src: '/photo_me_9.jpg', title: 'Новый Херсонес', description: 'Фото на фоне обворожительного музея' },
  { src: '/photo_me_8.jpg', title: 'Новый Херсонес', description: 'Нереально красивые фонтаны' },
  { src: '/photo_me_3.png', title: 'Памятник Казарскому', description: 'Зимний вечер в центре города' },
  { src: '/photo_me_4.jpeg', title: 'Фотоссесия', description: 'Фотограф топ' },
  { src: '/photo_me_6.jpeg', title: 'Фотосессия', description: 'Фотограф реально супер' },
  { src: '/photo_me_5.jpeg', title: 'Фотоссесия', description: 'Фотограф нереальный' },
  { src: '/photo_me10.jpg', title: 'Школа Искусств', description: 'SWAG' },
  { src: '/photo_me_1.jpg', title: 'Running to 90s', description: 'Вайб девяностых' },
  { src: '/photo_me11.jpg', title: 'Школа Искусств', description: 'Красота' },
  { src: '/photo_me16.jpg', title: 'Фары слепят', description: 'Пикми' },
  { src: '/photo_me_7.jpg', title: 'Фары слепят', description: 'Пикми' },
  { src: '/photo_me17.jpg', title: 'Фары слепят', description: 'Пикми' },
  { src: '/photo_me12.jpg', title: 'Фары слепят', description: 'Пикми' },
  { src: '/photo_me14.jpg', title: 'Фары слепят', description: 'Пикми' },
  { src: '/photo_me13.jpg', title: 'Фары слепят', description: 'Пикми' },
];

export const testMeta = {
  subject: 'Тест по дисциплине Физика',
  questions: [
    'Напишите формулу второго закона Ньютона.',
    'Что из перечисленного является единицей измерения силы?',
    'Какие из следующих утверждений верны?',
  ],
  groups: {
    '1 курс': ['ПИ/б-21-1-о', 'ПИ/б-21-2-о'],
    '2 курс': ['ПИ/б-22-1-о', 'ПИ/б-22-2-о'],
  },
};
