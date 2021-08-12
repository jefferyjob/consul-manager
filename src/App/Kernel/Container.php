<?php
namespace Jefferyjob\ConsulManager\App\Kernel;

use Closure;
use ReflectionClass;
use ReflectionParameter;
use Exception;

/**
 * --------------------------------------------------------------------------
 * 容器服务
 * --------------------------------------------------------------------------
 *
 * 容器类装实例或提供实例的回调函数
 * 为整个类库提供容器服务的支持
 * 实现容器的绑定和调用
 * 实现php的反射机制
 *
 * 文档：
 * php反射：https://www.php.net/manual/zh/book.reflection.php
 * ReflectionClass（获取类的有关信息）：https://www.php.net/manual/zh/class.reflectionclass.php
 * ReflectionParameter（取回函数或方法参数的相关信息）：https://www.php.net/manual/zh/class.reflectionparameter.php
 */
interface ContainerInterface {

    // 服务注册
    public function bind($abstract, $concrete = null, $shared = false);

    // 服务解析
    public function resolve($abstract, $parameters = []);

    // 服务解析
    public function make($abstract, $parameters = []);

}
class Container implements ContainerInterface {

    /**
     * 当前类的实例
     */
    protected static $instance;

    /**
     * @var array 容器服务绑定的变量
     */
    private $bindings = [];

    /**
     * 构造方法
     */
    public function __construct(){}

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
    static public function setInstance($container = null)
    {
        return static::$instance = $container;
    }

    /**
     * 容器注册服务
     *
     * @param string $abstract 服务名称
     * @param Closure|string|null $concrete 类的对象
     * @param bool $shared
     */
    public function bind($abstract, $concrete = null, $shared = false)
    {
        // 删除容器中的该服务
        $this->dropBind($abstract);

        // 如果提供的参数不是回调函数，则产生默认的回调函数
        if(!$concrete instanceof Closure) {
            $concrete = $this->getClosure($abstract, $concrete);
        }

        // 容器绑定
        $this->bindings[$abstract] = compact('concrete', 'shared');
    }

    /**
     * 从容器中解析服务
     *
     * 如果你的代码处于无法访问 $app 变量的位置，则可用全局辅助函数 resolve 来解析
     * @param string $abstract 服务名
     * @param array $parameters
     */
    public function resolve($abstract, $parameters = [])
    {
        return $this->make($abstract, $parameters);
    }

    /**
     * 从容器中解析服务
     *
     * @param string $abstract 服务名
     * @param array $parameters
     */
    public function make($abstract, $parameters = [])
    {
        $concrete = $this->getConcrete($abstract);

        if($this->isBuildable($concrete, $abstract)) {
            $object = $this->build($concrete);
        } else {
            $object = $this->make($concrete);
        }

        return $object;
    }

    /**
     * 删除容器中绑定的服务
     *
     * @param string $abstract 服务名
     */
    private function dropBind($abstract)
    {
        unset($this->bindings[$abstract]);
    }

    /**
     * 默认生成实例的回调函数
     *
     * @param string $abstract 服务名
     * @param Closure|string|null $concrete 类的对象
     */
    private function getClosure($abstract, $concrete)
    {
        // 简写写法
        return function($c) use ($abstract, $concrete) {
            $method = ($abstract == $concrete) ? 'build' : 'make';
            return $c->$method($concrete);
        };

        // laravel源码写法
        /*return function ($container, $parameters = []) use ($abstract, $concrete) {
            if ($abstract == $concrete) {
                return $container->build($concrete);
            }
            return $container->make($concrete, $parameters);
        };*/
    }

    /**
     * 获取绑定的回调函数
     *
     * @param string $abstract 服务名
     * @return mixed
     */
    private function getConcrete($abstract) {
        if(!isset($this->bindings[$abstract])) {
            return $abstract;
        }
        return $this->bindings[$abstract]['concrete'];
    }

    /**
     * 判断是否可被实例化
     *
     * @param string $concrete 服务名
     * @param Closure|string|null $abstract 类的对象
     * @return bool
     */
    private function isBuildable($concrete, $abstract) {
        return $concrete === $abstract || $concrete instanceof Closure;
    }

    /**
     * 实例化后返回
     *
     * @param string $concrete 服务名
     * @return mixed
     */
    private function build($concrete) {
        if($concrete instanceof Closure) {
            return $concrete($this);
        }

        // 获得类的反射
        $reflector = new ReflectionClass($concrete);

        // 判断类是否可被实例化
        if(!$reflector->isInstantiable()) {
            $message = "Target [$concrete] is not instantiable";
            throw new Exception($message, 500);
        }

        // 获取类的构造函数
        $constructor = $reflector->getConstructor();
        if(is_null($constructor)) {
            return new $concrete; // 如果没有构造方法直接 new 后返回
        }

        // 获取该类的构造函数相关信息
        $dependencies = $constructor->getParameters(); // 获取依赖参数
        $instances = $this->getDependencies($dependencies); // 获得依赖数组

        // 从给出的参数创建一个新的类实例
        return $reflector->newInstanceArgs($instances);
    }

    /**
     * 解决通过反射机制实例化对象时的依赖
     *
     * @param $parameters array 方法中的参数
     * @return array
     */
    private function getDependencies($parameters) {
        $dependencies = [];
        foreach($parameters as $parameter) {
            $dependency = $parameter->getClass();
            if(is_null($dependency)) {
                $dependencies[] = NULL;
            } else {
                $dependencies[] = $this->resolveClass($parameter);
            }
        }
        return (array)$dependencies;
    }

    /**
     * 从容器中获取类的反射解析
     *
     * @param ReflectionParameter $parameter 取回函数或方法参数的相关信息
     * @return mixed
     */
    private function resolveClass(ReflectionParameter $parameter) {
        return $this->make($parameter->getClass()->name);
    }
}