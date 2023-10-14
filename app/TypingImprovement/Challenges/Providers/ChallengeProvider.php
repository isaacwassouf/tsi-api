<?php

declare(strict_types=1);

namespace App\TypingImprovement\Challenges\Providers;

use App\TypingImprovement\Challenges\Actions\StoreChallenge;
use App\TypingImprovement\Challenges\Challenges;
use Illuminate\Support\ServiceProvider;

class ChallengeProvider extends ServiceProvider
{
    protected bool $defer = false;

    public function boot(): void
    {
        $this->bootRoutes();
        $this->bootMigrations();
        $this->bindSingletons();
    }

    /**
     * Register the singleton instances
     */
    public function bindSingletons(): void
    {
        Challenges::storesChallenge(StoreChallenge::class);
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
