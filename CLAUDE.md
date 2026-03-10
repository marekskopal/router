# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Commands

```sh
# Install dependencies
composer install

# Run tests
vendor/bin/phpunit

# Run a single test file
vendor/bin/phpunit tests/Builder/RouterBuilderTest.php

# Static analysis (level 10, strict)
vendor/bin/phpstan analyse

# Code style check
vendor/bin/phpcs

# Code style fix
vendor/bin/phpcbf
```

## Architecture

This is a PHP library (`marekskopal/router`) that extends `league/route` with PHP 8 attribute-based route registration. Requires PHP >=8.3.

**Data flow:** `RouterBuilder` → `RouteProvider` → `ClassScanner` + `ClassRouteProvider` → `league/route` Router

- **`RouterBuilder`** (`src/Builder/`) — Entry point. Accepts class directories and optional PSR `CacheInterface`. On `build()`, discovers routes and maps them to a `League\Route\Router` instance. Caches the route array under key `'routes'` if cache is provided.

- **`RouteProvider`** (`src/Provider/`) — Finds all `.php` files in a directory using `nette/utils` Finder, delegates per-file scanning to `ClassScanner`, then delegates per-class route extraction to `ClassRouteProvider`.

- **`ClassScanner`** (`src/Scanner/`) — Tokenizes a PHP file with `PhpToken::tokenize()` to extract fully-qualified class names without requiring autoloading or `include`.

- **`ClassRouteProvider`** (`src/Provider/`) — Uses `ReflectionClass` to inspect a class for `Route` attributes on the class itself (maps to `ClassName::__invoke`) and on individual methods (maps to `ClassName::methodName`).

- **`Route` attribute** (`src/Attribute/`) — Base attribute usable on classes and methods. Convenience subclasses: `RouteGet`, `RoutePost`, `RoutePut`, `RouteDelete`, `RoutePatch`, `RouteHead`, `RouteOptions` each hard-code the `HttpMethodEnum` value.

- **`HttpMethodEnum`** (`src/Enum/`) — Backed enum for HTTP methods used by all route attributes.

The handler strings passed to `league/route` follow the format `ClassName::methodName` (e.g. `App\Controllers\UserController::getUser`).
