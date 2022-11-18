<?php

declare(strict_types=1);


namespace MyroStadler\ProtoWeb;


class ProtoWebEnv
{
    public static function get($key): ?string
    {
        return $_ENV[$key] ?? null;
    }
}
