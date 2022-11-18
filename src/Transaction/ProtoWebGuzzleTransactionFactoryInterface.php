<?php

declare(strict_types=1);


namespace MyroStadler\ProtoWeb\Transaction;



interface ProtoWebGuzzleTransactionFactoryInterface
{
    public function create(): ProtoWebGuzzleTransactionInterface;
}
