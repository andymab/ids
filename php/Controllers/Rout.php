<?php

namespace Controllers;

class Routs
{

    public function rout()
    {
        $url = isset($_GET['action']) ? $_GET['action'] : null;

        if ($url) {
            $url = rtrim($url, '/');
            $url = explode('/', $url);
        }


        // if (!$url || empty($url[0])) {
        //     $controller = new index;
        //     return false;
        //     exit;
        // }

        $file = 'Controllers/' . $url[0] . '.php';

        if (file_exists($file)) {
            $class = "\Controllers\\" . $url[0];
            $controller = new $class;
        } else {
            self::error("error/404", "Не найден контроллер -> " . $url[0]);
            return false;
        }
    }



    public function error($page, $message)
    {
echo $page, $message;
    //   $controller = new error;
    //   $controller->View->set_model(
    //     [
    //       'page' => $page,
    //       'message' => $message
    //     ]
    //   );
    //   $controller->index();
    }





}
