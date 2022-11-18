<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Dotenv\Dotenv;

// this assumes we always use the same env file, not one of the
// env variations you see in .gitignore
// This should be OK since our strategy is to sed values into .env during CI.
(new Dotenv())->load(__DIR__.'/../.env');

