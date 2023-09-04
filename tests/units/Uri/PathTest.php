<?php

declare(strict_types=1);

namespace Graywings\Http\Tests\Units\Uri;

use Graywings\Http\Uri\Path;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Graywings\Http\Uri\Path
 */
class PathTest extends TestCase
{
    /**
     * @return void
     */
    public function testConstructor(): void
    {
        $path = new Path(['foo', 'bar']);
        $this->assertInstanceOf(Path::class, $path);
        $this->assertSame(['foo', 'bar'], $path->path);
    }

    /**
     * @return void
     */
    public function testParse(): void
    {
        $path = Path::parse('/foo/bar');
        $this->assertInstanceOf(Path::class, $path);
        $this->assertSame(['foo', 'bar'], $path->path);
    }

    /**
     * @return void
     */
    public function testParseRootPath(): void
    {
        $path = Path::parse('/');
        $this->assertInstanceOf(Path::class, $path);
        $this->assertSame([''], $path->path);
    }
}
