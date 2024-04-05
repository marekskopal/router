<?php

declare(strict_types=1);

namespace MarekSkopal\Router\Attribute;

use Attribute;
use MarekSkopal\Router\Enum\HttpMethodEnum;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD)]
class RouteGet extends Route
{
    public function __construct(string $path)
    {
        parent::__construct($path, HttpMethodEnum::GET);
    }
}
