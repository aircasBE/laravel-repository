<?php
namespace Czim\Repository;

use Czim\Repository\Console\Commands\MakeRepositoryCommand;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * The base package path.
     */
    public static ?string $packagePath = null;

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        self::$packagePath = dirname(__DIR__);

        $this->publishes(
            [self::$packagePath . '/config/repository.php' => config_path('repository.php')],
            'repository'
        );
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->commands([MakeRepositoryCommand::class]);
    }

}
