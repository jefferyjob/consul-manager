<?php
namespace Jefferyjob\ConsulManager\App\Kernel;

use Closure;
use Jefferyjob\ConsulManager\Exceptions\ResourceException;

/*
|--------------------------------------------------------------------------
| 容器服务
|--------------------------------------------------------------------------
|
| 为整个类库提供容器服务的支持
| 实现容器的绑定和调用
| 实现php的反射机制
*/
class Container {

    /**
     * 当前类的实例
     */
    protected static $instance;

    /**
     * @var array 容器服务绑定的变量
     */
    private $bindings = [];

    /**
     * 禁止new
     */
    private function __construct(){}

    /**
     * 禁止clone
     */
    private function __clone(){}

    /**
     * 获取当前类的实例
     *
     * @return static
     */
    static public function getInstance() {
        if(empty(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    /**
     * 创建单例模式
     *
     * @param null $container
     * @return mixed|null
     */
    public static function setInstance($container = null)
    {
        return static::$instance = $container;
    }

    /**
     * 容器注册服务
     *
     * @param string $abstract
     * @param \Closure|string|null $concrete
     * @param bool $shared
     */
    public function bind($abstract, $concrete = null, $shared = false)
    {
        // 删除容器中的该服务
        $this->dropBind($abstract);

        if(is_null($abstract)) {
            $concrete = $abstract;
        }

        // 如果不是闭包 则处理成闭包
//        if (! $concrete instanceof Closure) {
//            $concrete = $this->getClosure($abstract, $concrete);
//        }

        // 容器绑定
        $this->bindings[$abstract] = compact('concrete', 'shared');

    }

    /**
     * 从容器中解析服务
     *
     * @param $abstract
     * @param array $parameters
     */
    public function make($abstract, $parameters = [])
    {
        if (!isset($this->bindings[$abstract])) {
            throw new ResourceException("Not Found Container Object ({$abstract})", 500);
        }

        return $this->bindings[$abstract]['concrete'];
    }

    /**
     * 删除容器中绑定的服务
     *
     * @param string $abstract
     */
    protected function dropBind($abstract)
    {
        unset($this->bindings[$abstract]);
    }

    /**
     * 处理成闭包
     *
     * @param $abstract
     * @param $concrete
     */
    protected function getClosure($abstract, $concrete)
    {
        return function ($container, $parameters = []) use ($abstract, $concrete) {
            if ($abstract == $concrete) {
                return $container->build($concrete);
            }
            return $container->make($concrete, $parameters);
        };
    }

}