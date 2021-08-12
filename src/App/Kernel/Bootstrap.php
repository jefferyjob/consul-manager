<?php
namespace Jefferyjob\ConsulManager\App\Kernel;

use Jefferyjob\ConsulManager\App\Application;
use Jefferyjob\ConsulManager\Configures\ConfigureServerPriovder;

class Bootstrap
{
    public function run(Application $application)
    {
        // 配置文件服务容器载入
        // 只有载入配置文件服务才可以读取到配置文件中要加载的其他服务信息
        (new ConfigureServerPriovder($application))->register();
        (new ConfigureServerPriovder($application))->boot();

        // 载入其他核心服务
        $providers = $application->make('config')->get('app.providers');
        foreach ($providers as $provider) {
            (new $provider($application))->register();
            (new $provider($application))->boot();
        }
    }
}