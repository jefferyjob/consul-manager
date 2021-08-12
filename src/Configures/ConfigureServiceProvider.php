<?php
namespace ConsulManager\Configures;

use ConsulManager\App\Kernel\ServiceProvider;

class ConfigureServiceProvider extends ServiceProvider
{
    public function boot()
    {
    }

    public function register()
    {
        $this->application->bind('config', function() {
            return new Configure();
        });
    }
}