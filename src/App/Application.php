<?php
namespace ConsulManager\App;

use ConsulManager\App\Kernel\Container;
use ConsulManager\App\Kernel\Bootstrap;

/**
 * --------------------------------------------------------------------------
 * 类库核心入口文件
 * --------------------------------------------------------------------------
 *
 * 此文件为类库的核心入口执行文件
 * 此处预先执行或加载相关的服务类
 */
class Application extends Container {

    /**
     * @var string 服务ip
     */
    public $host;

    /**
     * @var int 服务端口
     */
    public $port;

    /**
     * @var string consul token
     */
    public $token;

    /**
     * @var bool 是否用swoole-http进行通信
     */
    public $swoole_http;

    public function __construct($config) {
        // 配置定义
        $this->host = $config['host'];
        $this->host = $config['port'];
        $this->token = $config['token'];
        $this->swoole_http = $config['swoole_http'];

        // 加载核心
        $this->bootstrap();

        // 为当前类创建单例
        self::setInstance($this);
    }

    /**
     * 加载框架核心驱动
     */
    private function bootstrap() {
        (new Bootstrap())->run($this);
    }

}