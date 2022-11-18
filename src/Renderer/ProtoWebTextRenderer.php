<?php

declare(strict_types=1);


namespace MyroStadler\ProtoWeb\Renderer;


use Psr\Http\Message\ResponseInterface;

class ProtoWebTextRenderer implements ProtoWebRendererInterface
{

    public function render(ResponseInterface $response): ResponseInterface
    {
        echo $response->getBody()->getContents();
        return $response;
    }
}
