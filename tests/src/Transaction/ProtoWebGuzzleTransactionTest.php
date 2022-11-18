<?php

declare(strict_types=1);

namespace Test\MyroStadler\ProtoWeb\Transaction;

use GuzzleHttp\Client;
use MyroStadler\ProtoWeb\Transaction\ProtoWebGuzzleTransaction;
use PHPUnit\Framework\TestCase;
use Test\MyroStadler\ProtoWeb\SpyCall;

class ProtoWebGuzzleTransactionTest extends TestCase
{
    public const BASE_URL = 'foo';
    public const ENDPOINT = 'bar';
    public const METHOD = 'TEG';
    public const OPTIONS = [
        'boo' => 'eek',
    ];

    public function testSendCallsClientRequest(): void
    {
        /**
         * @var GuzzleClientSpy $clientSpy
         */
        $o = $this->createObjectUnderTest($clientSpy);
        $spyCall = new SpyCall('request');
        $this->assertCount(
            0,
            $clientSpy->spy->findCallsMatching($spyCall)
        );
        $o->send();
        $this->assertCount(
            1,
            $clientSpy->spy->findCallsMatching($spyCall)
        );
    }

    public function testSendCallsClientRequestWithCorrectArguments(): void
    {
        /**
         * @var GuzzleClientSpy $clientSpy
         */
        $o = $this->createObjectUnderTest($clientSpy)
            ->setBaseUrl(self::BASE_URL)
            ->setEndpoint(self::ENDPOINT)
            ->setMethod(self::METHOD)
            ->setGuzzleOptions(self::OPTIONS)
        ;
        $spyCall = new SpyCall(
            'request',
            [self::METHOD, self::BASE_URL . '/' . self::ENDPOINT, self::OPTIONS]
        );
        $this->assertCount(
            0,
            $clientSpy->spy->findCallsMatching($spyCall)
        );
        $o->send();
        $this->assertCount(
            1,
            $clientSpy->spy->findCallsMatching($spyCall)
        );
    }

    protected function createObjectUnderTest(?Client &$client = null): ProtoWebGuzzleTransaction
    {
        if (is_null($client)) {
            $client = new GuzzleClientSpy();
        }
        return (new ProtoWebGuzzleTransaction())
            ->setClient(
                $client
            )
        ;
    }
}
