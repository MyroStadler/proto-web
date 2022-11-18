<?php

declare(strict_types=1);


namespace MyroStadler\ProtoWeb;


use MyroStadler\ProtoWeb\Transaction\ProtoWebGuzzleTransactionFactory;

class ProtoWebAppFactory
{
    public function create(): ProtoWebApp {
        return (new ProtoWebApp())
            ->setTransactionFactory(new ProtoWebGuzzleTransactionFactory())
        ;
    }
}
