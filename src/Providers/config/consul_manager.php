<?php

return [

    /*
    |--------------------------------------------------------------------------
    | IP地址
    |--------------------------------------------------------------------------
    */
    'host' => env('CONSUL_HOST', '127.0.0.1'),

    /*
    |--------------------------------------------------------------------------
    | 端口
    |--------------------------------------------------------------------------
    */
    'port' => env('CONSUL_PORT', 8500),

    /*
    |--------------------------------------------------------------------------
    | consul token
    |--------------------------------------------------------------------------
    */
    'token' => env('CONSUL_TOKEN', null),

    /*
    |--------------------------------------------------------------------------
    | consul token
    |--------------------------------------------------------------------------
    |
    | 此处用于定义是否启用 swoole http 服务和 consul 进行通信
    | 如果为 `false` 则使用 curl http 协议和 consul 进行通信
    | 如果为 `true` 则使用 swoole 的协程和 consol 进行通讯
    */
    'swoole_http' => env('CONSUL_SWOOLE_HTTP', false),
];