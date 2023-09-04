<?php

declare(strict_types=1);

namespace Graywings\Http;

/**
 * Defines constants for common HTTP status code.
 *
 * @see https://tools.ietf.org/html/rfc2295#section-8.1
 * @see https://tools.ietf.org/html/rfc2324#section-2.3
 * @see https://tools.ietf.org/html/rfc2518#section-9.7
 * @see https://tools.ietf.org/html/rfc2774#section-7
 * @see https://tools.ietf.org/html/rfc3229#section-10.4
 * @see https://tools.ietf.org/html/rfc4918#section-11
 * @see https://tools.ietf.org/html/rfc5842#section-7.1
 * @see https://tools.ietf.org/html/rfc5842#section-7.2
 * @see https://tools.ietf.org/html/rfc6585#section-3
 * @see https://tools.ietf.org/html/rfc6585#section-4
 * @see https://tools.ietf.org/html/rfc6585#section-5
 * @see https://tools.ietf.org/html/rfc6585#section-6
 * @see https://tools.ietf.org/html/rfc7231#section-6
 * @see https://tools.ietf.org/html/rfc7238#section-3
 * @see https://tools.ietf.org/html/rfc7725#section-3
 * @see https://tools.ietf.org/html/rfc7540#section-9.1.2
 * @see https://tools.ietf.org/html/rfc8297#section-2
 * @see https://tools.ietf.org/html/rfc8470#section-7
 */
enum StatusCode: int
{
    // Informational 1xx
    case CONTINUE = 100;
    case SWITCHING_PROTOCOLS = 101;
    case PROCESSING = 102;
    case EARLY_HINTS = 103;
    // Successful 2xx
    case OK = 200;
    case CREATED = 201;
    case ACCEPTED = 202;
    case NON_AUTHORITATIVE_INFORMATION = 203;
    case NO_CONTENT = 204;
    case RESET_CONTENT = 205;
    case PARTIAL_CONTENT = 206;
    case MULTI_STATUS = 207;
    case ALREADY_REPORTED = 208;
    case IM_USED = 226;
    // Redirection 3xx
    case MULTIPLE_CHOICES = 300;
    case MOVED_PERMANENTLY = 301;
    case FOUND = 302;
    case SEE_OTHER = 303;
    case NOT_MODIFIED = 304;
    case USE_PROXY = 305;
    case RESERVED = 306;
    case TEMPORARY_REDIRECT = 307;
    case PERMANENT_REDIRECT = 308;
    // Client Errors 4xx
    case BAD_REQUEST = 400;
    case UNAUTHORIZED = 401;
    case PAYMENT_REQUIRED = 402;
    case FORBIDDEN = 403;
    case NOT_FOUND = 404;
    case METHOD_NOT_ALLOWED = 405;
    case NOT_ACCEPTABLE = 406;
    case PROXY_AUTHENTICATION_REQUIRED = 407;
    case REQUEST_TIMEOUT = 408;
    case CONFLICT = 409;
    case GONE = 410;
    case LENGTH_REQUIRED = 411;
    case PRECONDITION_FAILED = 412;
    case PAYLOAD_TOO_LARGE = 413;
    case URI_TOO_LONG = 414;
    case UNSUPPORTED_MEDIA_TYPE = 415;
    case RANGE_NOT_SATISFIABLE = 416;
    case EXPECTATION_FAILED = 417;
    case IM_A_TEAPOT = 418;
    case MISDIRECTED_REQUEST = 421;
    case UNPROCESSABLE_ENTITY = 422;
    case LOCKED = 423;
    case FAILED_DEPENDENCY = 424;
    case TOO_EARLY = 425;
    case UPGRADE_REQUIRED = 426;
    case PRECONDITION_REQUIRED = 428;
    case TOO_MANY_REQUESTS = 429;
    case REQUEST_HEADER_FIELDS_TOO_LARGE = 431;
    case UNAVAILABLE_FOR_LEGAL_REASONS = 451;
    // Server Errors 5xx
    case INTERNAL_SERVER_ERROR = 500;
    case NOT_IMPLEMENTED = 501;
    case BAD_GATEWAY = 502;
    case SERVICE_UNAVAILABLE = 503;
    case GATEWAY_TIMEOUT = 504;
    case VERSION_NOT_SUPPORTED = 505;
    case VARIANT_ALSO_NEGOTIATES = 506;
    case INSUFFICIENT_STORAGE = 507;
    case LOOP_DETECTED = 508;
    case NOT_EXTENDED = 510;
    case NETWORK_AUTHENTICATION_REQUIRED = 511;
}
