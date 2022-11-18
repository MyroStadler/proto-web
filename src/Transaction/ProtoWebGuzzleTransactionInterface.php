<?php

declare(strict_types=1);


namespace MyroStadler\ProtoWeb\Transaction;


use GuzzleHttp\Client;
use MyroStadler\ProtoWeb\Renderer\ProtoWebRendererInterface;
use Psr\Http\Message\ResponseInterface;

interface ProtoWebGuzzleTransactionInterface
{

    public function setClient(Client $client): static;

    public function send(): static;

    public function getBaseUrl(): string;

    public function setBaseUrl(string $baseUrl): static;

    public function getEndpoint(): string;

    public function setEndpoint(string $endpoint): static;

    public function getGuzzleOptions(): array;

    public function setGuzzleOptions(array $guzzleOptions): static;

    public function getMethod(): string;

    public function setMethod(string $method): static;

    public function getOutputMode(): string;

    public function setOutputMode(string $outputMode): static;

    public function getStatus(): ?int;

    public function render(?ProtoWebRendererInterface $renderer = null): ResponseInterface;

}
