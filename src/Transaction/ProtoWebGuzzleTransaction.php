<?php

declare(strict_types=1);

namespace MyroStadler\ProtoWeb\Transaction;

use GuzzleHttp\Client;
use MyroStadler\ProtoWeb\Renderer\ProtoWebRendererInterface;
use Psr\Http\Message\ResponseInterface;

class ProtoWebGuzzleTransaction implements ProtoWebGuzzleTransactionInterface
{
    protected Client $client;
    protected string $method = 'GET';
    protected string $baseUrl = '';
    protected string $endpoint = '';
    protected array $guzzleOptions = [];
    protected ResponseInterface $response;

    public function setClient(Client $client): static
    {
        $this->client = $client;
        return $this;
    }

    public function send(): static
    {
        $uri =
            rtrim(
                $this->getBaseUrl(),
                '/'
            )
            . '/'
            . ltrim($this->getEndpoint(), '/')
        ;
        $this->response = $this->client->request(
            $this->getMethod(),
            $uri,
            $this->getGuzzleOptions()
        );
        return $this;
    }

    /**
     * @return string
     */
    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    /**
     * @param string $baseUrl
     * @return static
     */
    public function setBaseUrl(string $baseUrl): static
    {
        $this->baseUrl = $baseUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    /**
     * @param string $endpoint
     * @return static
     */
    public function setEndpoint(string $endpoint): static
    {
        $this->endpoint = $endpoint;
        return $this;
    }

    /**
     * @return array
     */
    public function getGuzzleOptions(): array
    {
        return $this->guzzleOptions;
    }

    /**
     * @param array $guzzleOptions
     * @return static
     */
    public function setGuzzleOptions(array $guzzleOptions): static
    {
        $this->guzzleOptions = $guzzleOptions;
        return $this;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param string $method
     * @return static
     */
    public function setMethod(string $method): static
    {
        $this->method = $method;
        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->response?->getStatusCode();
    }


    public function render(?ProtoWebRendererInterface $renderer = null): ResponseInterface
    {
        if (!$this->response) {
            throw new \Exception(
                'You need to call send() before you call render().'
            );
        }
        http_response_code($this->getStatus());
        if (!$renderer) {
            return $this->response;
        }
        return $renderer->render($this->response);
    }
}
