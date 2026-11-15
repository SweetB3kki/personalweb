# Лабораторная работа №11

Вариант 4. Сайт сохраняет дизайн и контент исходного PHP MVC проекта.

## Запуск

Из корня PersonalWeb:

```powershell
powershell -ExecutionPolicy Bypass -File .\Start-Lab.ps1 -Lab 11
```

Адрес: http://127.0.0.1:8011/

Для ручного запуска используется PHP 8.2 из C:\OSPanel\modules\PHP-8.2\php.exe.
Схема БД: php database/setup.php. Сервер: php -S 127.0.0.1:8011 router.php. Корень Apache — папка проекта, mod_rewrite включён.

База: personal_lab11, MySQL 127.0.0.1:3310. Учебный root без пароля, доступ только локальный.
Параметры подключения: config/database.php.
Вход администратора: admin / qwerty. Обычного пользователя создайте через /auth/register.

## Состав

- reports: отчёт DOCX по образцу №8.
- CHECKLIST.md: проверка требований методички.
- database/schema.sql: DDL; examples: файлы для импорта.
- app/core: собственная MVC и ActiveRecord.

Подробная общая инструкция: ../README-LABS.md.

Администратор может открывать результаты теста после входа через административную или общую форму.
После обновления войдите заново: cookie сессии теперь называется PersonalWebLab11 и не смешивается с №10.
Результаты расширенной проверки: reports/TEST-RESULTS.md.

