<?php

declare(strict_types=1);

namespace Graywings\Http\Tests\Units\Uri;

use Graywings\Http\Uri\Scheme;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Graywings\Http\Uri\Scheme
 */
class SchemeTest extends TestCase
{
    public function testConstructor(): void
    {
        $scheme = new Scheme('https');
        $this->assertInstanceOf(Scheme::class, $scheme);
        $this->assertSame('https', $scheme->value());
    }

    public function testConstructorWithUpperCase(): void
    {
        $scheme = new Scheme('HTTPS');
        $this->assertInstanceOf(Scheme::class, $scheme);
        $this->assertSame('https', $scheme->value());
    }
}
