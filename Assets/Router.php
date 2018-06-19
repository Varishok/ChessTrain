<?php

class Router {

    private $routes;

    public function __construct() {
        $routes_path = ROOT.'/Assets/config/routes.php';
        $this->routes = include($routes_path);
    }

    private function getURI() {
        if (!empty($_SERVER['REQUEST_URI']))
            return trim($_SERVER['REQUEST_URI'], '/');
    }

    public function run() {
        $uri = $this->getURI();

        // Проверяем наличие такого запроса в routes.php
        foreach($this->routes as $uri_pattern => $path) {

            //echo '<script>console.log("'. "~$uri_pattern~" . " + " . $uri .'")</script>';

            //echo '<script>console.log("' . (preg_match("~$uri_pattern~", $uri) ? "YES" : "NO") .'")</script>';
            // Сравниваем $uri_pattern и $uri

            if (preg_match("~$uri_pattern~", $uri)) {

                // Получаем внутренний путь из внешнего согласно правилу
                $internal_route = preg_replace("~$uri_pattern~", $path, $uri);

                // Определяем контроллер, action, параметры

                $segments = explode('/', $internal_route);

                $controller_name = array_shift($segments).'Controller';



                $controller_name = ucfirst($controller_name);

                $action_name = 'action'.ucfirst(array_shift($segments));

                $parameters = $segments;


                // Подключаем файл класса-контроллера
                $controller_file = ROOT.'/Controllers/'.$controller_name.'.php';
                if (file_exists($controller_file))
                    include_once($controller_file);

                // Создаем объект, вызываем метод (т.е. action)
                $controller_object = new $controller_name;

                json_encode(array($controller_object, $action_name));

                if ($action_name == 'action')
                    $result = $controller_object->actionIndex();
                else
                    $result = call_user_func_array(array($controller_object, $action_name), $parameters);

                if ($result != NULL) {
                    break;
                }

            }

        }
    }

}