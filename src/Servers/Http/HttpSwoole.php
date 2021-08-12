<?php
namespace Jefferyjob\ConsulManager\Servers\Http;

use Jefferyjob\ConsulManager\App\Application;
use Swoole\Coroutine\Http\Client;
/**
 * --------------------------------------------------------------------------
 * swoole实现http服务
 * --------------------------------------------------------------------------
 *
 * wiki：https://wiki.swoole.com/#/coroutine_client/http_client
 */
class HttpSwoole implements HttpInterface
{
    /**
     * @var string consul token
     */
    public $token;

    /**
     * @var object swoole-http客户端
     */
    private $client;

    public function __construct(Application $application) {
        $this->token = $application->token;
        $this->init($application->host, $application->port);
    }

    public function init($host, $port)
    {
        $client = new Client($host, $port);
        if($this->token) {
            $client->setHeaders([
                'X-Consul-Token' => $this->token
            ]);
        }
        $this->client = $client;
    }

    public function get() {

    }

    public function post() {

    }

    public function put() {

    }

    public function delete() {

    }
}