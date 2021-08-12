<?php
namespace Jefferyjob\ConsulManager\Providers;

use Illuminate\Support\ServiceProvider;
use Jefferyjob\ConsulManager\App\Application;
use Jefferyjob\ConsulManager\Exceptions\Exception;

/*
|--------------------------------------------------------------------------
| 服务提供器
|--------------------------------------------------------------------------
|
| 为 laravel 提供配置
*/
class ConsulManagerServiceProvider extends ServiceProvider
{
    /**
     * 标记着提供器是延迟加载的
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * --------------------------------------------------------------------------
     * 引导发布应用程序
     * --------------------------------------------------------------------------
     */
    public function boot()
    {
        // 获取文件路径
        $config_path = realpath(__DIR__.'/config/consul_manager.php');
        if(!$config_path) {
            throw new Exception("Error:ConsulManagerServiceProvider", 500);
        }

        $this->publishes([

            // 发布配置文件到 laravel 的config 下
            $config_path => config_path('consul_manager.php'),

        ]);
    }

    /**
     * 注册服务
     *
     * @return void
     */
    public function register()
    {
        // 服务注册
        $this->app->singleton(Application::class, function ($app) {
            // 获取配置文件
            $config = config('consul_manager');

            // 服务
            return new Application($config);
        });

        // 给服务一个别名
        $this->app->alias(Application::class, 'consul_manager');
    }

    /**
     * 取得服务
     *
     * @return array
     */
    public function provides()
    {
        return [Application::class, 'consul_manager'];
    }
}