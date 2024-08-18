<?php

namespace app\models;

class AlbumComment extends AppModel
{
    public $attributes = [
        'albumimg_id' => '',
        'user_id' => '',
        'text' => '',
        'status' => '',
        'created_at' => '',
        'updated_at' => '',
    ];

    public $rules = [
        'required' => [
            ['text']
        ],
        'integer' => [
            'albumimg_id' => '',
            'user_id' => '',
            'status' => ''
        ],
    ];
}