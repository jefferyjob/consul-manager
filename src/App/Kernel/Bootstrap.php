<?php
namespace ConsulManager\App\Kernel;

use ConsulManager\App\Application;
use ConsulManager\Configures\ConfigureServiceProvider;

class Bootstrap
{
    public function run(Application $application)
    {
        // 配置文件服务容器载入
        // 只有载入配置文件服务才可以读取到配置文件中要加载的其他服务信息
        (new ConfigureServiceProvider($application))->register();
        (new ConfigureServiceProvider($application))->boot();

        // 载入其他核心服务
        // 此服务用于包其他服务和容器之间的绑定
        $providers = $application->make('config')->get('app.providers');
        foreach ($providers as $provider) {
            (new $provider($application))->register();
            (new $provider($application))->boot();
        }
    }
}