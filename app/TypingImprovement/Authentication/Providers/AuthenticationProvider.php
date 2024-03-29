<?php

declare(strict_types=1);

namespace App\TypingImprovement\Authentication\Providers;

use App\TypingImprovement\Authentication\Actions\LoginUser;
use App\TypingImprovement\Authentication\Actions\LogOutUser;
use App\TypingImprovement\Authentication\Actions\RegisterUser;
use App\TypingImprovement\Authentication\Authentications;
use Illuminate\Support\ServiceProvider;

class AuthenticationProvider extends ServiceProvider
{
    protected bool $defer = false;

    public function boot(): void
    {
        $this->bindSingletons();
        $this->bootRoutes();
        $this->bootMigrations();
    }

    public function bindSingletons(): void
    {
        Authentications::registersUserUsing(RegisterUser::class);
        Authentications::loginsUserUsing(LoginUser::class);
        Authentications::logsOutUserUsing(LogOutUser::class);
    }

    /**
     * Register the service provider.
     */
    protected function bootRoutes(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../Http/routes_v1.php');
    }

    /**
     * Register the migrations
     */
    protected function bootMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
    }
}
