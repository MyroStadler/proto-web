<?php

declare(strict_types=1);


namespace MyroStadler\ProtoWeb\Renderer;


use Psr\Http\Message\ResponseInterface;

class ProtoWebNullRenderer implements ProtoWebRendererInterface
{
    public function render(ResponseInterface $response): ResponseInterface
    {
        return $response;
    }
}
