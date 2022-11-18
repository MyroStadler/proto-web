<?php

declare(strict_types=1);


namespace Test\MyroStadler\ProtoWeb\Transaction;


use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

class GuzzleClientDummy extends Client
{

    public function __construct(array $config = [])
    {
        //
    }

    public function request(
        string $method,
        $uri = '',
        array $options = []
    ): ResponseInterface {
        return new Response();
    }
}
