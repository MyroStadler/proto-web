<?php

declare(strict_types=1);


namespace MyroStadler\ProtoWeb;


class Env
{
    public static function get($key): ?string
    {
        return $_ENV[$key] ?? null;
    }
}
