<?php

use App\Models\Classes;

return [
    'title'   => '班级',
    'single'  => '班级',
    'model'   => Classes::class,

    'columns' => [

        'id' => [
            'title' => 'ID',
        ],
        'name' => [
            'title'    => '班级名',
            'sortable' => false,
            'output'   => function ($value, $model) {
                return '<div style="max-width:260px">' . model_link($value, $model) . '</div>';
            },
        ],
        'creator' => [
            'title'    => '创建者',
            'sortable' => false,
            'output'   => function ($value, $model) {
                $avatar = $model->creator->avatar;
                $value = empty($avatar) ? 'N/A' : '<img src="'.$avatar.'" style="height:22px;width:22px"> ' . $model->creator->name;
                return model_link($value, $model->creator);
            },
        ],
        'avatar' => [
            // 数据表格里列的名称，默认会使用『列标识』
            'title'  => '头像',

            // 默认情况下会直接输出数据，你也可以使用 output 选项来定制输出内容
            'output' => function ($avatar, $model) {
                return empty($avatar) ? 'N/A' : '<img src="'.$avatar.'" width="40">';
            },

            // 是否允许排序
            'sortable' => false,
        ],
        'type' => [
            'title'    => '分类',
            'sortable' => false,
            'output'   => function ($value, $model) {
                return model_admin_link($model->type->category, $model->type);
            },
        ],
        'numbers' => [
            'title'    => '学生数量',
            'sortable' => false,
        ],
        'verification' => [
            'title'    => '是否需要认证',
            'sortable' => false,
            'output'=> function ($value, $model) {
               if ($value==1)
                   return "是";
               else
                   return "否";
            }
        ],
        'password' => [
            'title'    => '密码',
            'sortable' => false,

        ],

        'operation' => [
            'title'  => '管理',
            'sortable' => false,
        ],
    ],
    'edit_fields' => [
        'name' => [
            'name'    => '班级名',
        ],
        'creator' => [
            'title'              => '创建者',
            'type'               => 'relationship',
            'name_field'         => 'name',
        ],
        'verification' => [
            'title'    => '是否需要认证',
        ],
        'password' => [
            'title'    => '密码',

        ],
        'type' => [
            'title'              => '分类',
            'type'               => 'relationship',
            'name_field'         => 'id',
            'search_fields'      => ["CONCAT(id, ' ', category)"],
            'options_sort_field' => 'id',
        ],
    ],
    'filters' => [
        'id' => [
            'title' => '内容 ID',
        ],
        'name' => [
            'title' => '班级名',
        ],
        'creator' => [
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
        'numbers' => [
            'title' => '人数',
        ],
    ],
    'rules'   => [
        'title' => 'required'
    ],
    'messages' => [
        'title.required' => '请填写name',
    ],
];