<?php
namespace Jefferyjob\ConsulManager\Servers\Http;

use Jefferyjob\ConsulManager\App\Application;

class HttpSwoole implements HttpInterface
{
    /**
     * @var string consul token
     */
    public $token;

    public function __construct(Application $application) {
        $this->token = $application->token;
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