<?php

namespace app\models;

class AlbumImg extends AppModel
{
    public $attributes = [
        'album_id' => '',
        'img' => '',
        'name' => '',
        'text' => '',
        'user_id' => '',
        'like_' => '',
        'dislike' => '',
        'sort' => '',
        'status' => '',
        'created_at' => '',
        'updated_at' => '',
    ];

    public $rules = [
        'required' => [
            ['img']
        ],
        'integer' => [
            ['album_id'],
            ['user_id'],
            ['sort'],
            ['like_'],
            ['dislike'],
            ['status']
        ],
    ];

    public function uploadImg($name){
        $uploaddir = TMP . '/';
        $getMime = explode('.', $_FILES[$name]['name']);
        $ext = strtolower(end($getMime));
        $file_name = uniqid() . '.' . $ext;

        $types = ["image/gif", "image/png", "image/jpeg", "image/pjpeg", "image/x-png"]; // массив допустимых расширений
//        if($_FILES[$name]['size'] > 1048576){
        if($_FILES[$name]['size'] > 1048){
            $res = ["error" => "Ошибка! Максимальный вес файла - 1 Мб!"];
            return(json_encode($res));
        }
        if($_FILES[$name]['error']){
            $res = array("error" => "Ошибка! Возможно, файл слишком большой.");
            exit(json_encode($res));
        }
        if(!in_array($_FILES[$name]['type'], $types)){
            $res = array("error" => "Допустимые расширения - .gif, .jpg, .png");
            exit(json_encode($res));
        }
        $new_name = md5(time()).".$ext";
        $uploadfile = $uploaddir.$new_name;
        if(@move_uploaded_file($_FILES[$name]['tmp_name'], $uploadfile)){
            if($name == 'single'){
                $_SESSION['single'] = $new_name;
            }else{
                $_SESSION['multi'][] = $new_name;
            }
            self::resize($uploadfile, $uploadfile, $wmax, $hmax, $ext);
            $res = array("file" => $new_name);
            exit(json_encode($res));
        }
    }

}