<?php
declare(strict_types=1);

session_name('PersonalWebLab11');
session_start();
date_default_timezone_set('Europe/Moscow');

require_once __DIR__ . '/app/core/model.php';
require_once __DIR__ . '/app/core/view.php';
require_once __DIR__ . '/app/core/controller.php';
require_once __DIR__ . '/app/core/router.php';
require_once __DIR__ . '/app/core/auth.php';
require_once __DIR__ . '/app/core/csrf.php';
require_once __DIR__ . '/app/core/admin_controller.php';
require_once __DIR__ . '/app/core/request.php';
Request::validate();
Csrf::verify();
if (!str_starts_with(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/admin/')) {
    require_once __DIR__ . '/app/models/visitor_model.php';
    VisitorModel::track();
}

Router::bootstrapRequest();
Router::route();
