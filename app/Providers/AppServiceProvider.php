<?php

namespace App\Providers;

use App\Repositories\Todo\TodoInterface;
use App\Repositories\Todo\TodoRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(TodoRepository::class, TodoInterface::class)
    }
}
