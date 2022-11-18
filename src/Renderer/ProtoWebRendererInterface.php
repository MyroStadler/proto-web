<?php

declare(strict_types=1);

namespace MyroStadler\ProtoWeb\Renderer;

use Psr\Http\Message\ResponseInterface;

interface ProtoWebRendererInterface
{
    public function render(ResponseInterface $response): ResponseInterface;
}
