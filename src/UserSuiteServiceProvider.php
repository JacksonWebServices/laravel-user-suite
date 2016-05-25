<?php

namespace JWS\UserSuite;

use Illuminate\Support\ServiceProvider;

class UserSuiteServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->handleConfigs();
        $this->handleMigrations();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // Bind any implementations.
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    private function handleConfigs()
    {
        $configPath = __DIR__.'/../config/usersuite.php';

        $this->publishes([$configPath => config_path('usersuite.php')]);

        $this->mergeConfigFrom($configPath, 'usersuite');
    }
    
    private function handleMigrations()
    {
        $this->publishes([
            realpath(__DIR__ . '/../database') => $this->app->databasePath() . '/migrations',
        ]);
    }
}
