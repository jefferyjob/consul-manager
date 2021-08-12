<?php
namespace ConsulManager\Servers\Http;

use ConsulManager\App\Kernel\ServiceProvider;

class HttpServiceProvider extends ServiceProvider
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