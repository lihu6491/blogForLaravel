<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Hasher\PasswordHasher;
class PasswordServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //关键处，注册容器名称为 password
        $this->app->singleton('password', function () {
            return new PasswordHasher;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['password'];
    }

}