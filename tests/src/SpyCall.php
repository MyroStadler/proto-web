<?php

declare(strict_types=1);


namespace Test\MyroStadler\ProtoWeb;


class SpyCall
{
    /** @var null|string  */
    private $method = null;

    /** @var array|string  */
    private $arguments = null;

    public function __construct(
        ?string $method = null,
        ?array $arguments = null
    ) {
        $this->setMethod($method);
        $this->setArguments($arguments);
    }

    /**
     * @return string|null
     */
    public function getMethod(): ?string
    {
        return $this->method;
    }

    /**
     * @param string|null $method
     * @return SpyCall
     */
    public function setMethod(?string $method): SpyCall
    {
        $methodPaamayimNekudotayimPieces = explode('::', $method);
        $this->method = end($methodPaamayimNekudotayimPieces);
        return $this;
    }

    /**
     * @return array|null
     */
    public function getArguments(): ?array
    {
        return $this->arguments;
    }

    /**
     * @param array|null $arguments
     * @return SpyCall
     */
    public function setArguments(?array $arguments): SpyCall
    {
        $this->arguments = $arguments;
        return $this;
    }
}
