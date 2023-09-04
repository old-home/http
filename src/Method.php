<?php

declare(strict_types=1);

namespace Graywings\Http;

enum Method: string
{
    case HEAD = 'HEAD';
    case GET = 'GET';
    case POST = 'POST';
    case PUT = 'PUT';
    case PATCH = 'PATCH';
    case DELETE = 'DELETE';
    case PURGE = 'PURGE';
    case OPTIONS = 'OPTIONS';
    case TRACE = 'TRACE';
    case CONNECT = 'CONNECT';
    case PRI = 'PRI';
    case PROPFIND = 'PROPFIND';
    case REPORT = 'REPORT';
    case SEARCH = 'SEARCH';
}
