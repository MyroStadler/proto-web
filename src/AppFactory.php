<?php

declare(strict_types=1);


namespace MyroStadler\ProtoWeb;


use MyroStadler\ProtoWeb\Transaction\GuzzleTransactionFactory;

class AppFactory
{
    public function create(): App {
        return (new App())
            ->setTransactionFactory(new GuzzleTransactionFactory())
        ;
    }
}
