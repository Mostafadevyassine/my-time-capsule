<?php

namespace App\Providers;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
{
    Factory::guessFactoryNamesUsing(function (string $modelName) {
        return 'Database\\Factories\\' . class_basename($modelName) . 'Factory';
    });

    // Force Faker to use English locale globally
    app()->singleton(\Faker\Generator::class, function () {
        return FakerFactory::create('en_US');
    });
}
}
