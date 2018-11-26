<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/25
 * Time: 18:37
 */

namespace App\Http\ViewComposers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use \Illuminate\View\View;

class StuComposer
{
    public function compose(View $view) {

        $user = Cache::remember('user'.Auth::id(), 10, function() {
            return Auth::user();
        });
        $view->with(compact('user'));//填充数据
    }

}