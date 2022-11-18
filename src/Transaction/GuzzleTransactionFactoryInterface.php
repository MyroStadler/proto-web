<?php

declare(strict_types=1);


namespace MyroStadler\ProtoWeb\Transaction;



interface GuzzleTransactionFactoryInterface
{
    public function create(): GuzzleTransactionInterface;
}
