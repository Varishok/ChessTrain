<?php
// Общие настройки
define('ROOT', dirname(__FILE__));
ini_set('log_errors', 1);
ini_set('error_log', ROOT.'/Assets/logs/error.log');
ini_set('display_errors', 1);
// Подключение файлов системы
require_once(ROOT.'/Assets/Router.php');
// Соединение с БД
require_once(ROOT.'/Assets/Database.php');
// Запуск системы
$router = new Router();
$router->run();