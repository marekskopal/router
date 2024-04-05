<?php

declare(strict_types=1);

namespace MarekSkopal\Router\Attribute;

use Attribute;
use MarekSkopal\Router\Enum\HttpMethodEnum;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD)]
class Route
{
    public function __construct(protected string $path, protected HttpMethodEnum $method = HttpMethodEnum::GET)
    {
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getMethod(): HttpMethodEnum
    {
        return $this->method;
    }
}
