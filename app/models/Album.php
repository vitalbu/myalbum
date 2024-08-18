<?php

namespace app\models;

class Album extends AppModel
{
    public $attributes = [
        'title' => '',
        'alias' => '',
        'keywords' => '',
        'description' => '',
        'text' => '',
        'user_id' => '',
        'created_at' => '',
        'updated_at' => '',
    ];

    public $rules = [
        'required' => [
            ['title'],
            ['description'],
        ],
        'integer' => [
            ['user_id'],
            ['created_at'],
            ['updated_at'],
        ],
    ];
}