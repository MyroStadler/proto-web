<?php

declare(strict_types=1);


namespace MyroStadler\ProtoWeb\Transaction;


use GuzzleHttp\Client;

interface ProtoWebGuzzleTransactionInterface
{
    public const OUTPUT_NONE = 'none'; // the default if not set
    public const OUTPUT_TEXT = 'text';
    public const OUTPUT_JSON = 'json';
    public const OUTPUT_HTML_BODY = 'body';
    public const OUTPUT_HTML_BODY_PRE = 'pre';

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

    public function render(): void;

}
