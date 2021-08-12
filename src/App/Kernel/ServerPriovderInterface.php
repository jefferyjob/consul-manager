<?php
namespace Jefferyjob\ConsulManager\App\Kernel;

use Jefferyjob\ConsulManager\App\Application;

/**
 * --------------------------------------------------------------------------
 * 服务提供者抽象类
 * --------------------------------------------------------------------------
 *
 * 定义抽象接口
 * 用户其他服务提供者继承
 */
abstract class ServerPriovderInterface
{
    /**
     * @var Application
     */
    protected $application;

    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    /**
     * 服务注册
     *
     * 绑定事物到指定的容器中
     * @return mixed
     */
    abstract public function register();

    /**
     * 启动服务
     *
     * 启动响应的服务，例如事件监听，视图等
     * @return mixed
     */
    abstract public function boot();


}