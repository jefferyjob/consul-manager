<?php

return [

    /*
    |--------------------------------------------------------------------------
    | 自动加载服务提供者
    |--------------------------------------------------------------------------
    |
    | 此处列出的服务，将会被类库初始化时加载到容器中
    | 由于该类库定义的时候惰性加载，所以只有当使用的时候才会生效
    */
    'providers' => [

        /*
         * Package Service Providers...
         */
        ConsulManager\Servers\Services\ServiceServiceProvider::class,
        ConsulManager\Servers\Kvs\KvServicePriover::class,
        ConsulManager\Servers\Nodes\NodeServicePriover::class,

    ]
];