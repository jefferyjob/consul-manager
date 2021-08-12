<?php
namespace Jefferyjob\ConsulManager\Servers\Http;

use Jefferyjob\ConsulManager\App\Kernel\ServerPriovderInterface;

class HttpServerPriovder extends ServerPriovderInterface
{
    public function boot()
    {
    }

    public function register()
    {
        if($this->application->swoole_http) {
            $this->application->bind('http', new HttpSwoole($this->application));
        } else {
            $this->application->bind('http', new HttpCurl($this->application));
        }
    }
}