<?php

use \App\Models\TopicType;

return [
    'title'   => '话题分类',
    'single'  => '分类',
    'model'   => TopicType::class,

    'columns' => [

        'id' => [
            'title' => 'ID',
        ],
        'name' => [
            'title'    => '话题',
            'sortable' => false,
            'output'   => function ($value, $model) {
                return '<div style="max-width:260px">' . model_link($value, $model) . '</div>';
            },
        ],


        'operation' => [
            'title'  => '管理',
            'sortable' => false,
        ],
    ],
    'edit_fields' => [
        'name' => [
            'name'    => '分类名',
        ],
    ],
    'rules'   => [
        'title' => 'required'
    ],
    'messages' => [
        'name.required' => '请填写分类',
    ],

    'filters' => [
        'id' => [

            'title' => ' ID',
        ],
        'name' => [
            'title' => '标题名',
        ],

    ],
];