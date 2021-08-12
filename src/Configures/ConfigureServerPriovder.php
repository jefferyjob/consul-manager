<?php
namespace Jefferyjob\ConsulManager\Configures;

use Jefferyjob\ConsulManager\App\Kernel\ServerPriovderInterface;

class ConfigureServerPriovder extends ServerPriovderInterface
{
    public function boot()
    {
    }

    public function register()
    {
        $this->application->bind('config', new Configure());
    }
}