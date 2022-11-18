<?php

declare(strict_types=1);


namespace MyroStadler\ProtoWeb\Renderer;


use Psr\Http\Message\ResponseInterface;

class ProtoWebJsonRenderer implements ProtoWebRendererInterface
{

    public function render(ResponseInterface $response): ResponseInterface
    {
        header('Content-Type:application/json');
        echo $response->getBody()->getContents();
        return $response;
    }
}
