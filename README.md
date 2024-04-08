# Attributes extension for `league/route` router

## Install

```sh
composer require marekskopal/router
```

## Usage

Create `Router` instance with `RouterBuilder` and set class directories of your controllers or actions. Optionally you can set `CacheInterface` instance for caching routes.

```php
use MarekSkopal\Router\Builder\RouterBuilder;

$router = (new RouterBuilder())
    ->setClassDirectories([__DIR__ . '/../Controllers'])
    ->setCache(new Cache()) // optional
    ->build();
```    

Add `Route` (or `RouteGet`,`RoutePost`,`RoutePut`,`RouteDelete`...) attribute on Class or Method you want to route to.

```php
use MarekSkopal\Router\Attribute\Route;
use MarekSkopal\Router\Attribute\RoutePost;

class MyController
{
    #[Route('GET', '/api/my/name')]
    public function getName(): void
    {
    }
    
    #[RoutePost('/api/my/address')]
    public function postAddress(): void
    {
    }
}
```

```php
use MarekSkopal\Router\Attribute\RouteGet;

#[RouteGet('/api/my/action')]
class MyAction
{
    public function __invoke(): void
    {
    }
}
```
