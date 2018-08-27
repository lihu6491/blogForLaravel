<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();


        //关键行
        Auth::provider('admin', function ($app,array $config) {
            //传入password容器及用户模型类
            return new EloquentUserProvider($app['password'], $config['model']);
        });

        /*
        Auth::provider('admin', function () {
            $config = $this->app['config']['auth.providers.admin'];
            //传入password容器及用户模型类
            return new EloquentUserProvider($this->app['password'], $config['model']);
        });
        */

    }
}
