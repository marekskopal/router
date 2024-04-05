<?php

declare(strict_types=1);

namespace MarekSkopal\Router\Enum;

enum HttpMethodEnum: string
{
    case GET = 'GET';
    case POST = 'POST';
    case PUT = 'PUT';
    case DELETE = 'DELETE';
    case PATCH = 'PATCH';
    case HEAD = 'HEAD';
    case OPTIONS = 'OPTIONS';
}
