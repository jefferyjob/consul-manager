<?php
namespace Jefferyjob\ConsulManager\App;

use Jefferyjob\ConsulManager\App\Kernel\Container;
use Jefferyjob\ConsulManager\App\Kernel\Bootstrap;

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

    public function __construct($config) {
        // 配置定义
        $this->host = $config['host'];
        $this->host = $config['port'];

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