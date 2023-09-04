<?php

declare(strict_types=1);

namespace Graywings\Http\Tests\Units\Uri;

use Graywings\Http\Uri\QueryString;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Graywings\Http\Uri\QueryString
 */
class QueryStringTest extends TestCase
{
    /**
     * @return void
     */
    public function testConstructor(): void
    {
        $queryString = new QueryString([
            'hello' => 'world'
        ]);

        $this->assertInstanceOf(QueryString::class, $queryString);
        $this->assertSame('world', $queryString->get('hello'));
    }

    /**
     * @return void
     */
    public function testAdd(): void
    {
        $queryString = new QueryString([
            'hello' => 'world'
        ]);
        $queryString = $queryString->add('foo', 'bar');

        $this->assertSame('bar', $queryString->get('foo'));
    }

    /**
     * @return void
     */
    public function testAddBulk(): void
    {
        $queryString = new QueryString([
            'hello' => 'world'
        ]);
        $queryString = $queryString->addBulk([
            'foo' => 'bar',
            'baz' => 'qux'
        ]);

        $this->assertSame('bar', $queryString->get('foo'));
        $this->assertSame('qux', $queryString->get('baz'));
    }

    /**
     * @return void
     */
    public function testToString(): void
    {
        $queryString = new QueryString([
            'hello' => 'world'
        ]);

        $this->assertSame('hello=world', (string)$queryString);
    }

    /**
     * @return void
     */
    public function testToStringMultiple(): void {
        $queryString = new QueryString([
            'hello' => 'world',
            'foo' => 'bar',
            'baz' => 'qux'
        ]);

        $this->assertSame('hello=world&foo=bar&baz=qux', (string)$queryString);
    }

    /**
     * @return void
     */
    public function testParse(): void
    {
        $queryString = QueryString::parse('hello=world');

        $this->assertSame('world', $queryString->get('hello'));
    }

    /**
     * @return void
     */
    public function testParseMultiple(): void {
        $queryString = QueryString::parse('hello=world&foo=bar&baz=qux');

        $this->assertSame('world', $queryString->get('hello'));
        $this->assertSame('bar', $queryString->get('foo'));
        $this->assertSame('qux', $queryString->get('baz'));
    }
}
