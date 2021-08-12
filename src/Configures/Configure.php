<?php
namespace ConsulManager\Configures;

use ConsulManager\Exceptions\ResourceException;

/**
 * --------------------------------------------------------------------------
 * 配置文件读取
 * --------------------------------------------------------------------------
 *
 * 读取类库中的配置文件
 */
class Configure
{
    /**
     * @var string 配置文件目录
     */
    private $config_dir;

    /**
     * @var array 配置文件
     */
    private $config;

    public function __construct() {
        $this->config_dir = __DIR__ . '/../config/';
        if(! realpath($this->config_dir)) {
            throw new ResourceException("Not Found Dir ({$this->config_dir})", 500);
        }
        $this->loadConfigure();
    }

    /**
     * 加载所有的配置文件
     */
    private function loadConfigure()
    {
        // 读取目录下文件
        $files = scandir($this->config_dir);

        $data = array();
        foreach ($files as $file)
        {
            if ($file === '.' || $file === '..') {
                continue;
            }

            // 获取文件名
            $filename = stristr($file, ".php", true);

            // 读取文件内容信息
            $data[$filename] = require_once $this->config_dir.$file;
        }

        $this->config = $data;
    }

    /**
     * 读取配置
     *
     * @param $key string demo:key1.key2.key3
     * @return array|mixed|null
     */
    public function get($key)
    {
        $data = $this->config;
        foreach (explode('.', $key) as $value) {
            if(!isset($data[$value])) {
                return null;
            }
            $data = $data[$value];
        }
        return $data;
    }

}