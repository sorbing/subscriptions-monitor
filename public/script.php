<?php

$GLOBALS['config'] = $config = require_once __DIR__ . '/../config.php';

// @note Всё зависит от динамики регистрации новых пользователей и кол. подписок, но..
// За 2.5 млн. сек в мес. мы можем даже не успеть провалидировать 1 лям email-ов.
// Просится реализация очереди + мультипоточной валидации/отправки email.

require_once(__DIR__ . '/../src/db.php');
require_once(__DIR__ . '/../src/seed.php');
require_once(__DIR__ . '/../src/helpers.php');

$route = $_GET['route'] ?? $argv[1] ?? '';

switch ($route) {
    case 'seed': seedUsers(1000); break;
    case 'check': require_once __DIR__ . '/../src/actions/check.php'; break;
    default: require_once __DIR__ . '/../src/actions/help.php';
}

mysqli_close($GLOBALS['link']);
