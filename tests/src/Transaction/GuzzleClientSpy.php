<?php

declare(strict_types=1);


namespace Test\MyroStadler\ProtoWeb\Transaction;


use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use Test\MyroStadler\ProtoWeb\Spy;

class GuzzleClientSpy extends Client
{
    public Spy $spy;
    protected GuzzleClientDummy $dummy;

    public function __construct(array $config = [])
    {
        $this->spy = new Spy();
        $this->spy->on(__METHOD__, func_get_args());
        $this->dummy = new GuzzleClientDummy();
    }

    public function request(
        string $method,
        $uri = '',
        array $options = []
    ): ResponseInterface {
        return
            $this->spy->on(
                __METHOD__,
                func_get_args()
            )
            ?? $this->dummy->request(
                $method,
                $uri,
                $options
            )
        ;
    }
}
