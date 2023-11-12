<?php

namespace Controllers;

use JsonException;
use stdClass;

class Helper
{


    public static function must_be($mustbe, $array)
    {
        foreach ($mustbe as $keymustbe) {
            if (!array_key_exists($keymustbe, $array) && $array[$keymustbe]) {
                self::message(false, 'Поле ' . $keymustbe . ' Должно быть заполнено');
            }
        }
        return true;
    }

    public static function set_be($setbe, $array)
    {
        foreach ($setbe as $keymustbe) {
            if (!array_key_exists($keymustbe, $array)) {
                self::message(false, 'Поле ' . $keymustbe . ' Должно существовать');
            }
        }
        return true;
    }

    public static function message($status, $message = "Данные", $data = [])
    {
        $httpCode = "200";
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json; charset=utf-8');
        header('Access-Control-Allow-Methods: POST');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
        // if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS')
        // exit('ok');
        

        http_response_code($httpCode);
        echo json_encode(['status'=>$status ? 'success' : 'error','message'=>$message ,'data'=>$data]);
        exit;
    }

    public static function action($stdClass, $metod)
    {

        if (!method_exists($stdClass, $metod)) {
            self::message(false, "Отсутствует метод $metod");
        }
        return true;
    }
}
