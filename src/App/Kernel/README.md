# package应用核心

## Container容器

该容器服务的实现，思路上采用的 Laravel 底层源码的时候，但是做了一定程度的简化。

### 使用方法

**容器的几种注册方式：**

参数说明：  

- abstract：抽象接口类，也可以是字符串名称
- concrete：具体抽象方法的实现

```php
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
```

**容器的几种解析方式：**

```php
// 调用 Configure 类中的 get 方法
$config = $container1->make('config')->get('app');
```