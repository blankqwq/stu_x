<?php

namespace App\Providers;

use App\Models\Classes;
use App\Models\ClassUser;
use App\Models\Homework;
use App\Models\Topic;
use App\Models\User;
use App\Policies\HomeworkPolicy;
use App\Policies\TopicPolicy;
use App\Policies\UserClassPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        Topic::class=>TopicPolicy::class,
        Classes::class=>UserClassPolicy::class,
        Homework::class=>HomeworkPolicy::class,
        ClassUser::class=>ClassUser::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
