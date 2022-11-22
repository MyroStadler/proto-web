## Prototype web library

This should make it easier to spin up quick transacting web apps for modeling client architectures etc.

## Suggested usage

### Suggested filesystem

```shell
.
├── composer.json
├── composer.lock
├── docker
│   └── app
│       ├── Dockerfile
│       └── assets
│           ├── local.conf
│           └── php.ini
├── example..env
├── public
│   └── index.php
└── src
    └── Acme
        ├── App.php
        ├── AppFactory.php
        ├── Env.php
        └── Transaction
            └── MyTransactionFactory.php

```

### Suggested code implementation

#### `index.php`

```php
<?php
    require_once __DIR__ . '/../vendor/autoload.php';
    (new Acme\AppFactory())
        ->create()
        ->test()
    ;
?>
```

#### `AppFactory.php`

```php
class AppFactory
{
    public function create(): App
    {
        $app = new App(
            true,
            __DIR__ . '/../../.env'
        );
        return $app
            ->setTransactionFactory(
                new MyTransactionFactory()
            )
        ;
    }
}
```

#### `App.php`

```php
class App extends ProtoWebApp
{
    public function test(): void
    {
        $this->transactionFactory->create()
            ->setEndpoint('index.php')
            ->send()
            ->render(new ProtoWebJsonRenderer())
        ;
    }
}
```

#### `MyTransactionFactory.php`

```php
class MyTransactionFactory implements ProtoWebGuzzleTransactionFactoryInterface
{
    public function create(): ProtoWebGuzzleTransactionInterface
    {
        return (new ProtoWebGuzzleTransaction())
            ->setClient(new Client())
            ->setBaseUrl(Env::get(Env::MICROSERVICE_URL))
        ;
    }
}
```

#### `Env.php`

```php
class Env extends ProtoWebEnv
{
    public const MICROSERVICE_URL = 'MICROSERVICE_URL';
}
```
