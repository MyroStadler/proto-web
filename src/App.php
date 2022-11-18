<?php

declare(strict_types=1);

namespace MyroStadler\ProtoWeb;

use MyroStadler\ProtoWeb\Transaction\GuzzleTransactionFactoryInterface;
use Symfony\Component\Dotenv\Dotenv;

class App
{
    protected GuzzleTransactionFactoryInterface $transactionFactory;

    public function __construct(
        bool $showErrors = true,
        string $envFile = __DIR__ . '/../.env'
    ) {
        if ($showErrors) {
            ini_set(
                'display_errors',
                '1'
            );
            ini_set(
                'display_startup_errors',
                '1'
            );
            error_reporting(E_ALL);
        }
        if (!file_exists($envFile)) {
            throw new \Exception('.env file does not exist: ' . $envFile);
        }
        (new Dotenv())
            ->load($envFile)
        ;
    }

    public function setTransactionFactory(GuzzleTransactionFactoryInterface $transactionFactory): static
    {
        $this->transactionFactory = $transactionFactory;
        return $this;
    }
//
//    public function test(): void
//    {
//        $this->transactionFactory->create()
//            ->setBaseUrl('https://www.google.com?q=foobar')
//            ->send()
//            ->render()
//        ;
//    }
}
