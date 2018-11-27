<?php

use App\Models\Topic;

return [
    'title'   => '话题',
    'single'  => '话题',
    'model'   => Topic::class,

    'columns' => [

        'id' => [
            'title' => 'ID',
        ],
        'title' => [
            'title'    => '话题',
            'sortable' => false,
            'output'   => function ($value, $model) {
                return '<div style="max-width:260px">' . model_link($value, $model) . '</div>';
            },
        ],
        'sender' => [
            'title'    => '作者',
            'sortable' => false,
            'output'   => function ($value, $model) {
                $avatar = $model->sender->avatar;
                $value = empty($avatar) ? 'N/A' : '<img src="'.$avatar.'" style="height:22px;width:22px"> ' . $model->sender->name;
                return model_link($value, $model->sender);
            },
        ],
        'classes' => [
            'title'    => '班级',
            'sortable' => false,
            'output'   => function ($value, $model) {
                $avatar = $model->classes->avatar;
                $value = empty($avatar) ? 'N/A' : '<img src="'.$avatar.'" style="height:22px;width:22px"> ' . $model->classes->name;
                return model_link($value, $model->classes);
            },
        ],
        'type' => [
            'title'    => '分类',
            'sortable' => false,
            'output'   => function ($value, $model) {
                return model_admin_link($model->type->name, $model->type);
            },
        ],

        'content'=> [
            'title'    => '内容',
            'sortable' => false,
        ],

        'can_reply'=>[
            'title'    => '能否回复',
            'output'   => function ($value, $model) {
                return $value==0? "是" :"否" ;
            },
        ],

        'operation' => [
            'title'  => '管理',
            'sortable' => false,
        ],
    ],
    'edit_fields' => [
        'title' => [
            'title'    => '标题',
        ],
        'sender' => [
            'title'              => '用户',
            'type'               => 'relationship',
            'name_field'         => 'name',
            'autocomplete'       => true,
            'search_fields'      => ["CONCAT(id, ' ', name)"],

            // 自动补全排序
            'options_sort_field' => 'id',
        ],

        'content'=>[
            'title'    => '内容',
        ],
        'can_reply'=>[
            'title'    => '能否回复',
        ],

    ],
    'filters' => [
        'id' => [
            'title' => '内容 ID',
        ],
        'sender' => [
            'title'              => '用户',
            'type'               => 'relationship',
            'name_field'         => 'name',
            'autocomplete'       => true,
            'search_fields'      => array("CONCAT(id, ' ', name)"),
            'options_sort_field' => 'id',
        ],
        'type' => [
            'title'              => '分类',
            'type'               => 'relationship',
            'name_field'         => 'category',
            'autocomplete'       => true,
            'search_fields'      => array("CONCAT(id, ' ', name)"),
            'options_sort_field' => 'id',
        ],
    ],
    'rules'   => [
        'title' => 'required'
    ],
    'messages' => [
        'title.required' => '请填写标题',
    ],
];