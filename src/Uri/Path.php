<?php

declare(strict_types=1);

namespace Graywings\Http\Uri;

final class Path
{
    /**
     * @var string[] $path
     */
    public array $path;

    /**
     * @param string[] $path
     */
    public function __construct(array $path)
    {
        $this->path = $path;
    }

    /**
     * @param string $path
     * @return self
     */
    public static function parse(string $path): self
    {
        return new self(explode('/', trim($path, '/')));
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return '/' . implode('/', $this->path);
    }
}
