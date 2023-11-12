<?php
namespace Controllers;

class Savefilepreview
{

    public function index()
    {

        $photo = json_decode(filter_input(INPUT_POST, 'photo'));
        print_r($photo);
    }
}
