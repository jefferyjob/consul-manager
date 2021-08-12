# Consul Manager

Laravel 的 consul 服务管理扩展包

## Label

[![laravel](https://img.shields.io/badge/laravel-%3E5.6-red)](https://laravel.com)
[![php](https://img.shields.io/badge/php-%3E7.0-blue)](https://www.php.net)
[![consul](https://img.shields.io/badge/consul-%3E1.9-red)](https://www.consul.io)
[![issues](https://img.shields.io/github/issues/jefferyjob/consul-manager)](https://github.com/jefferyjob/consul-manager/issues)
[![GitHub forks](https://img.shields.io/github/forks/jefferyjob/consul-manager)](https://github.com/jefferyjob/consul-manager)
[![GitHub stars](https://img.shields.io/github/stars/jefferyjob/consul-manager)](https://github.com/jefferyjob/consul-manager)
[![GitHub license](https://img.shields.io/github/license/jefferyjob/consul-manager)](https://github.com/jefferyjob/consul-manager/blob/master/LICENSE)


## 安装

首先，通过 Composer 包管理器安装 consul-manager：

```shell
composer require jefferyjob/consul-mananger
```

consul-manager 安装完成后，使用 `vendor:publish Artisan` 命令来生成 `consul-manager` 配置文件。这个命令将在你的 `config` 目录下生成一个 `consul_manager.php` 配置文件。  
此外，还会在框架文件 `framework/config/app.php` 的 `providers` 和 `aliases` 注入服务。

```shell
php artisan vendor:publish --provider="Jefferyjob\ConsulManager\Providers\ConsulManagerServiceProvider"
```



