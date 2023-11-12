<?php

namespace Controllers;

use \Controllers\Helper;


class Savefilepreview
{
    private $id;
    private $photo_id;
    private $title;
    private $descr;



    public function __construct()
    {
        $photo = json_decode(filter_input(INPUT_POST, 'photo'), true);
        print_r($photo);

        Helper::set_be(['id','photo_id','title', 'descr'], $photo);
        Helper::must_be(['id','title', 'descr'], $photo);

        $this->id = $photo['id'];
        $this->photo_id = $photo['photo_id'];
        $this->title = $photo['title'];
        $this->descr = $photo['descr'];
        
        $filepath = $this->uploadfile();
        
    }

    public function index()
    {

        $photo = json_decode(filter_input(INPUT_POST, 'photo'), true);
        print_r($photo);

        Helper::set_be(['id','photo_id','title', 'descr'], $photo);
        Helper::must_be(['id','title', 'descr'], $photo);

 
        if(!$photo->photo_id){
            ///новый альбом и это страница обложки альббома
        } else {
            ///добавляем новую запись
        }

        mkdir("folder1/folder2/newfolder", 0777, True);

        $photoAlbom  = $photo->id;
        $photo_id    =  $photo->photo_id;
        $photo_title = $photo->title;
        $photo_descr = $photo->descr;



    }

    public function uploadfile(){
        if ($_FILES['fname']['error'] == 0) {
            move_uploaded_file($_FILES['fname']['tmp_name'], $_FILES['fname']['name']);
            echo "File uploaded successfully !!! <br />";
            echo "Filename : " . $_FILES['fname']['name'] . "<br />";
            echo "Size : " . $_FILES['fname']['size']  . "<br />";
        } else {
            switch ($_FILES['fname']['error']) {
                case UPLOAD_ERR_NO_FILE:
                    echo "Select a file to upload.";
                    break;

                case UPLOAD_ERR_INI_SIZE:
                    echo "The file size exceeds upload_max_filesize in php.ini";
                    break;

                default:
                    echo "Upload failed";
                    break;
            }
        }

    }
}
