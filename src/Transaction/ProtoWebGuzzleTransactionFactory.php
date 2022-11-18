<?php

declare(strict_types=1);

namespace MyroStadler\ProtoWeb\Transaction;

use GuzzleHttp\Client;

class ProtoWebGuzzleTransactionFactory implements ProtoWebGuzzleTransactionFactoryInterface
{
    public function create(): ProtoWebGuzzleTransactionInterface
    {
        return (new ProtoWebGuzzleTransaction())
            ->setClient(new Client())
        ;
    }
}
