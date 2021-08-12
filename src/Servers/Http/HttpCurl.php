<?php
namespace ConsulManager\Servers\Http;

use ConsulManager\App\Application;

class HttpCurl implements HttpInterface
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