<?php
require __DIR__ . '/../vendor/autoload.php';

use ConsulManager\App\Kernel\Container;
use ConsulManager\Configures\Configure;

/**
 * --------------------------------------------------------------------------
 * 容器的几种注册方式
 * --------------------------------------------------------------------------
 *
 * 绑定参数2个，第一个为抽象接口类，第二个为实现类，第一个参数也可以用字符串定义代替
 */
// 闭包方式
$container1 = new Container();
$container1->bind('config', function() {
    return new Configure();
});

// 类定义方式
$container2 = new Container();
$container2->bind('config', Configure::class);

// 类决定路径方式
$container3 = new Container();
$container3->bind('config', 'ConsulManager\Configures\Configure');

// 名称用抽象类定义
$container4 = new Container();
$container4->bind(ConfigureInterface::class, Configure::class);

/**
 * --------------------------------------------------------------------------
 * 容器的几种解析方式
 * --------------------------------------------------------------------------
 *
 * 此文件为类库的核心入口执行文件
 * 此处预先执行或加载相关的服务类
 */
$config = $container1->make('config')->get('app');

