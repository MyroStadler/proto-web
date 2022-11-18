<?php

declare(strict_types=1);

namespace MyroStadler\ProtoWeb\Transaction;

use GuzzleHttp\Client;

class GuzzleTransactionFactory implements GuzzleTransactionFactoryInterface
{
    public function create(): GuzzleTransactionInterface
    {
        return (new GuzzleTransaction())
            ->setClient(new Client())
        ;
    }
}
