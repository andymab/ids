<?php

namespace Controllers;

class Routs
{

    public function rout()
    {
        $url = filter_input(INPUT_GET,'action');

        if ($url) {
            $url = rtrim($url, '/');
            $url = explode('/', $url);
        }
        $class = ucfirst($url[0]);
        $file =  __DIR__ . '/' . $class . '.php';
        if (file_exists($file)) {
            $class =   '\\Controllers\\' . $class;
            $controller = new $class;
            $controller->index();

        } else {
            self::error("error/404", "Не найден контроллер -> " . $class);
            return false;
        }
    }



    public function error($page, $message)
    {
        echo $page, $message;
    }
}
