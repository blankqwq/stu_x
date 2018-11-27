<?php

namespace App\Providers;

use App\Models\Classes;
use App\Models\ClassUser;
use App\Models\Homework;
use App\Models\Replies;
use App\Models\StuHomework;
use App\Models\User;
use App\Observers\ClassObserver;
use App\Observers\ClassUserObserver;
use App\Observers\HomeworkObserver;
use App\Observers\ReplyObserver;
use App\Observers\StuHomeworkObserver;
use App\Observers\UserObsevser;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //注册observer
        User::observe(UserObsevser::class);
        ClassUser::observe(ClassUserObserver::class);
        Classes::observe(ClassObserver::class);
        Homework::observe(HomeworkObserver::class);
        StuHomework::observe(StuHomeworkObserver::class);
        Replies::observe(ReplyObserver::class);

        Carbon::setLocale('zh');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
