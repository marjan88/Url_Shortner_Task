<?php

namespace App\Providers;

use App\Helpers\MathBasePattern;
use App\Helpers\UrlPatternInterface;
use App\Repositories\Contracts\LinkRepository;
use App\Repositories\Contracts\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {

    protected $repositories = [
        UserRepository::class => \App\Repositories\UserRepository::class,
        LinkRepository::class => \App\Repositories\LinkRepository::class
    ];

    protected $services = [
        UrlPatternInterface::class => MathBasePattern::class
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {

        $this->registerRepositories();
        $this->registerServices();
    }

    protected function registerRepositories() {
        if (empty($this->repositories)) {
            return;
        }

        foreach ($this->repositories as $key => $value) {
            $this->app->bind($key, $value);
        }
    }

    protected function registerServices() {
        if (empty($this->services)) {
            return;
        }

        foreach ($this->services as $key => $value) {
            $this->app->bind($key, $value);
        }
    }
}
