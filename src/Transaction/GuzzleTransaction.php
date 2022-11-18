<?php

declare(strict_types=1);

namespace MyroStadler\ProtoWeb\Transaction;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class GuzzleTransaction implements GuzzleTransactionInterface
{
    protected Client $client;
    protected string $method = 'GET';
    protected string $baseUrl = '';
    protected string $endpoint = '';
    protected array $guzzleOptions = [];
    protected string $outputMode = self::OUTPUT_NONE;
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

    /**
     * @return string
     */
    public function getOutputMode(): string
    {
        return $this->outputMode;
    }

    /**
     * @param string $outputMode
     * @return static
     */
    public function setOutputMode(string $outputMode): static
    {
        $this->outputMode = $outputMode;
        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->response?->getStatusCode();
    }


    public function render(): void
    {
        if (!$this->response) {
            throw new \Exception(
                'You need to call send() before you call render().'
            );
        }
        http_response_code($this->getStatus());
        $bodyContents = $this->response->getBody()->getContents();
        switch ($this->getOutputMode()) {
            default:
            case self::OUTPUT_NONE:
                break;
            case self::OUTPUT_TEXT:
                $this->print($bodyContents);
                break;
            case self::OUTPUT_JSON:
                $this->printAsJson($bodyContents);
                break;
            case self::OUTPUT_HTML_BODY:
                $this->printAsHtmlBody($bodyContents);
                break;
            case self::OUTPUT_HTML_BODY_PRE:
                $this->printAsHtmlBodyPre($bodyContents);
                break;
        }
    }



    protected function printAsJson(string $jsonString): void
    {
        header('Content-Type:application/json');
        echo $jsonString;
    }

    protected function print(string $text): void
    {
        echo $text;
    }

    protected function printAsHtmlBody(string $bodyContents): void
    {
        echo <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FleetPortal</title>
</head>
<body>
{$bodyContents}
</body>
</html>
HTML;

    }

    protected function printAsHtmlBodyPre(string $preContents): void
    {
        $this->printAsHtmlBody(
            "<pre>{$preContents}</pre>"
        );
    }


}
