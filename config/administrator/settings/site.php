<?php
/**
 * Created by PhpStorm.
 * User: 11365
 * Date: 2018/10/9
 * Time: 20:20
 */
return [
    'title' => '站点设置',

    // 访问权限判断
    'permission'=> function()
    {
        // 只允许站长管理站点配置
        return \Illuminate\Support\Facades\Auth::user()->hasRole('master');
    },

    // 站点配置的表单
    'edit_fields' => [
        'site_name' => [
            // 表单标题
            'title' => '站点名称',

            // 表单条目类型
            'type' => 'text',

            // 字数限制
            'limit' => 50,
        ],

        'school_name' => [
            'title' => '学校名',
            'type' => 'text',
        ],



        'contact_email' => [
            'title' => '联系人邮箱',
            'type' => 'text',
            'limit' => 50,
        ],
        'seo_description' => [
            'title' => 'SEO - Description',
            'type' => 'textarea',
            'limit' => 250,
        ],

        'school_logo' => [
            'title' => '学校logo',
            'type' => 'image',
            'naming' => 'random',
            'location' => public_path() . '/images/',
            'size'=>2,
            'height'=>10
        ],
        'seo_keyword' => [
            'title' => 'SEO - Keywords',
            'type' => 'textarea',
            'limit' => 250,
        ],
    ],

    // 表单验证规则
    'rules' => [
        'site_name' => 'required|max:50',
        'contact_email' => 'email',
        'school_logo'=>'required'
    ],

    'messages' => [
        'site_name.required' => '请填写站点名称。',
        'contact_email.email' => '请填写正确的联系人邮箱格式。',
    ],

    'before_save' => function(&$data)
    {
        if (strpos($data['site_name'], 'Powered by STU') === false) {
            $data['site_name'] .= ' - Powered by STU';
        }
        $data['school_logo'] = $data['school_logo'];
    },

    'actions' => [

        'clear_cache' => [
            'title' => '更新系统缓存',

            // 不同状态时页面的提醒
            'messages' => [
                'active' => '正在清空缓存...',
                'success' => '缓存已清空！',
                'error' => '清空缓存时出错！',
            ],

            // 动作执行代码，注意你可以通过修改 $data 参数更改配置信息
            'action' => function(&$data)
            {
                \Artisan::call('cache:clear');
                return true;
            }
        ],
    ],
];