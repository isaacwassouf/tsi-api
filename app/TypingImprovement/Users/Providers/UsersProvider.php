<?php

namespace App\TypingImprovement\Users\Providers;

use App\TypingImprovement\Users\Actions\ChangePassword;
use App\TypingImprovement\Users\Actions\UpdateGeneralInformation;
use Illuminate\Support\ServiceProvider;

class UsersProvider extends ServiceProvider
{
    protected bool $defer = false;

    public function boot(): void
    {
        $this->bindSingletons();
        $this->bootRoutes();
    }

    private function bootRoutes(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../Http/routes.php');
    }

    private function bindSingletons(): void
    {
        app()->singleton(ChangePassword::class);
        app()->singleton(UpdateGeneralInformation::class);
    }
}
