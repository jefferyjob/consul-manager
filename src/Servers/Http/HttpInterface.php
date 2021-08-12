<?php
namespace Jefferyjob\ConsulManager\Servers\Http;

/**
 * --------------------------------------------------------------------------
 * HTTP 请求接口定义
 * --------------------------------------------------------------------------
 *
 * 定义接口的基本规范
 * 用于服务不同类型的服务，例如：guzzlehttp、swoolehttp
 */
interface HttpInterface {

    /**
     * get请求
     * @return mixed
     */
    public function get();

    /**
     * post请求
     * @return mixed
     */
    public function post();

    /**
     * put请求
     * @return mixed
     */
    public function put();

    /**
     * delete请求
     * @return mixed
     */
    public function delete();

}