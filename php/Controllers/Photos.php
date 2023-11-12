<?php

namespace Controllers;

use \Controllers\Helper;

class Photos
{

    private $action;

    public function __construct()
    {
        $photo = json_decode(filter_input(INPUT_POST, 'photo'), true);
        Helper::action('\Controllers\Photos',$photo['action']);
        $this->action = $photo['action'];
    }

    public function index(){
        $metod = $this->action;
       $this->$metod();
    }


    public function getphotos(){
        $data = json_decode(file_get_contents( GPATH . '\assets\001.json'));
        Helper::message(true,"Данные получены",$data);
    }

}
