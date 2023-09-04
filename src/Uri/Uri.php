<?php

declare(strict_types=1);

namespace Graywings\Http\Uri;

use Psr\Http\Message\UriInterface;

/**
 * @inheritDoc
 */
readonly final class Uri implements UriInterface
{
    /**
     * @param Scheme $scheme
     * @param string $userInfo
     * @param string $host
     * @param int|null $port
     * @param Path $path
     * @param QueryString $query
     * @param string $fragment
     */
    public function __construct(
        private Scheme      $scheme,
        private string      $userInfo = '',
        private string      $host = '',
        private ?int        $port = null,
        private Path        $path = new Path([]),
        private QueryString $query = new QueryString([]),
        private string      $fragment = '',
    )
    {
    }

    /**
     * @param string $uri
     * @return self
     */
    public static function parse(string $uri): self
    {
        $parts = parse_url($uri);
        return new self(
            new Scheme($parts['scheme'] ?? ''),
            $parts['user'] ?? '',
            $parts['host'] ?? '',
            $parts['port'] ?? null,
            Path::parse($parts['path'] ?? ''),
            QueryString::parse($parts['query'] ?? ''),
            $parts['fragment'] ?? '',
        );
    }
    /**
     * @return string
     */
    public function getScheme(): string
    {
        return $this->scheme->value();
    }

    /**
     * @return string
     */
    public function getAuthority(): string
    {
        if ($this->userInfo === '' && $this->host === '' && $this->port === null) {
            return '';
        } else if ($this->userInfo === '' && $this->port === null) {
            return $this->host;
        } else if ($this->userInfo === '') {
            return $this->host . ':' . $this->port;
        } else if ($this->port === null) {
            return $this->userInfo . '@' . $this->host;
        }
        return $this->userInfo . '@' . $this->host . ':' . $this->port;
    }

    /**
     * @return string
     */
    public function getUserInfo(): string
    {
        return $this->userInfo;
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @return int|null
     */
    public function getPort(): ?int
    {
        return $this->port;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path->__toString();
    }

    /**
     * @return string
     */
    public function getQuery(): string
    {
        return $this->query->__toString();
    }

    /**
     * @return string
     */
    public function getFragment(): string
    {
        return $this->fragment;
    }

    /**
     * @inheritDoc
     * @return self
     */
    public function withScheme(string $scheme): self
    {
        return new self(
            new Scheme($scheme),
            $this->userInfo,
            $this->host,
            $this->port,
            $this->path,
            $this->query,
            $this->fragment,
        );
    }

    /**
     * @inheritDoc
     * @return self
     */
    public function withUserInfo(string $user, ?string $password = null): self
    {
        return new self(
            $this->scheme,
            $password ? $user . ':' . $password : $user,
            $this->host,
            $this->port,
            $this->path,
            $this->query,
            $this->fragment,
        );
    }

    /**
     * @inheritDoc
     * @return self
     */
    public function withHost(string $host): self
    {
        return new self(
            $this->scheme,
            $this->userInfo,
            $host,
            $this->port,
            $this->path,
            $this->query,
            $this->fragment,
        );
    }

    /**
     * @inheritDoc
     * @return self
     */
    public function withPort(?int $port): self
    {
        return new self(
            $this->scheme,
            $this->userInfo,
            $this->host,
            $port,
            $this->path,
            $this->query,
            $this->fragment,
        );
    }

    /**
     * @inheritDoc
     * @return self
     */
    public function withPath(string $path): self
    {
        return new self(
            $this->scheme,
            $this->userInfo,
            $this->host,
            $this->port,
            Path::parse($path),
            $this->query,
            $this->fragment,
        );
    }

    /**
     * @inheritDoc
     * @return self
     */
    public function withQuery(string $query): self
    {
        return new self(
            $this->scheme,
            $this->userInfo,
            $this->host,
            $this->port,
            $this->path,
            QueryString::parse($query),
            $this->fragment,
        );
    }

    /**
     * @inheritDoc
     * @return self
     */
    public function withFragment(string $fragment): self
    {
        return new self(
            $this->scheme,
            $this->userInfo,
            $this->host,
            $this->port,
            $this->path,
            $this->query,
            $fragment,
        );
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        $queryString = $this->getQuery() ? '?' . $this->getQuery() : '';
        $fragment = $this->getFragment() ? '#' . $this->getFragment() : '';
        return $this->getScheme() . '://' . $this->getAuthority() . $this->getPath() . $queryString . $fragment;
    }
}
