<?php

declare(strict_types=1);

namespace Graywings\Http\Tests\Units\Uri;

use Graywings\Http\Uri\Path;
use Graywings\Http\Uri\QueryString;
use Graywings\Http\Uri\Scheme;
use Graywings\Http\Uri\Uri;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Graywings\Http\Uri\Uri
 * @covers \Graywings\Http\Uri\Path
 * @covers \Graywings\Http\Uri\Scheme
 * @covers \Graywings\Http\Uri\QueryString
 */
class UriTest extends TestCase
{
    public function testConstructor(): void
    {
        $uri = new Uri(
            new Scheme('https'),
            'user',
            'example.co.jp',
            443,
            new Path(['foo', 'bar']),
            new QueryString([
                'hello' => 'world'
            ]),
            'fragment'
        );

        $this->assertInstanceOf(Uri::class, $uri);
        $this->assertSame('https', $uri->getScheme());
        $this->assertSame('user', $uri->getUserInfo());
        $this->assertSame('example.co.jp', $uri->getHost());
        $this->assertSame(443, $uri->getPort());
        $this->assertSame('user@example.co.jp:443', $uri->getAuthority());
        $this->assertSame('/foo/bar', $uri->getPath());
        $this->assertSame('hello=world', $uri->getQuery());
        $this->assertSame('fragment', $uri->getFragment());
        $this->assertSame('https://user@example.co.jp:443/foo/bar?hello=world#fragment', $uri->__toString());
    }

    /**
     * @return void
     */
    public function testParse(): void
    {
        $uri = Uri::parse('https://example.co.jp/foo/bar?hello=world#fragment');

        $this->assertInstanceOf(Uri::class, $uri);
        $this->assertSame('https', $uri->getScheme());
        $this->assertSame('', $uri->getUserInfo());
        $this->assertSame('example.co.jp', $uri->getHost());
        $this->assertSame(null, $uri->getPort());
        $this->assertSame('example.co.jp', $uri->getAuthority());
        $this->assertSame('/foo/bar', $uri->getPath());
        $this->assertSame('hello=world', $uri->getQuery());
        $this->assertSame('fragment', $uri->getFragment());
        $this->assertSame('https://example.co.jp/foo/bar?hello=world#fragment', $uri->__toString());
    }

    public function testParseRootPath(): void
    {
        $uri = Uri::parse('https://example.co.jp/');

        $this->assertInstanceOf(Uri::class, $uri);
        $this->assertSame('https', $uri->getScheme());
        $this->assertSame('', $uri->getUserInfo());
        $this->assertSame('example.co.jp', $uri->getHost());
        $this->assertSame(null, $uri->getPort());
        $this->assertSame('example.co.jp', $uri->getAuthority());
        $this->assertSame('/', $uri->getPath());
        $this->assertSame('', $uri->getQuery());
        $this->assertSame('', $uri->getFragment());
        $this->assertSame('https://example.co.jp/', $uri->__toString());
    }

    public function testGetAuthority(): void
    {
        $uri = new Uri(
            new Scheme('https'),
            '',
            'example.co.jp',
            443,
            new Path(['foo', 'bar']),
            new QueryString([
                'hello' => 'world'
            ]),
            'fragment'
        );

        $this->assertSame('example.co.jp:443', $uri->getAuthority());
    }

    /**
     * @return void
     */
    public function testGetAuthorityWithoutPort(): void
    {
        $uri = new Uri(
            new Scheme('https'),
            'user',
            'example.co.jp',
            null,
            new Path(['foo', 'bar']),
            new QueryString([
                'hello' => 'world'
            ]),
            'fragment'
        );

        $this->assertSame('user@example.co.jp', $uri->getAuthority());
    }

    /**
     * @return void
     */
    public function testGetAuthorityWithoutUserInfo(): void
    {
        $uri = new Uri(
            new Scheme('https'),
            '',
            'example.co.jp',
            null,
            new Path(['foo', 'bar']),
            new QueryString([
                'hello' => 'world'
            ]),
            'fragment'
        );

        $this->assertSame('example.co.jp', $uri->getAuthority());
    }

    /**
     * @return void
     */
    public function testGetAuthorityWithoutHost(): void
    {
        $uri = new Uri(
            new Scheme('https'),
            '',
            '',
            null,
            new Path(['foo', 'bar']),
            new QueryString([
                'hello' => 'world'
            ]),
            'fragment'
        );

        $this->assertSame('', $uri->getAuthority());
    }

    /**
     * @return void
     */
    public function testWithScheme(): void
    {
        $uri = new Uri(
            new Scheme('https'),
            '',
            '',
            null,
            new Path(['foo', 'bar']),
            new QueryString([
                'hello' => 'world'
            ]),
            'fragment'
        );
        $uri = $uri->withScheme('http');

        $this->assertSame('http', $uri->getScheme());
    }

    /**
     * @return void
     */
    public function testWithUserInfo(): void
    {
        $uri = new Uri(
            new Scheme('https'),
            '',
            '',
            null,
            new Path(['foo', 'bar']),
            new QueryString([
                'hello' => 'world'
            ]),
            'fragment'
        );
        $uri = $uri->withUserInfo('user');

        $this->assertSame('user', $uri->getUserInfo());
    }

    /**
     * @return void
     */
    public function testWithHost(): void
    {
        $uri = new Uri(
            new Scheme('https'),
            '',
            '',
            null,
            new Path(['foo', 'bar']),
            new QueryString([
                'hello' => 'world'
            ]),
            'fragment'
        );
        $uri = $uri->withHost('example.co.jp');

        $this->assertSame('example.co.jp', $uri->getHost());
    }

    /**
     * @return void
     */
    public function testWithPort(): void
    {
        $uri = new Uri(
            new Scheme('https'),
            '',
            '',
            null,
            new Path(['foo', 'bar']),
            new QueryString([
                'hello' => 'world'
            ]),
            'fragment'
        );
        $uri = $uri->withPort(443);

        $this->assertSame(443, $uri->getPort());
    }

    /**
     * @return void
     */
    public function testWithPath(): void
    {
        $uri = new Uri(
            new Scheme('https'),
            '',
            '',
            null,
            new Path([]),
            new QueryString([
                'hello' => 'world'
            ]),
            'fragment'
        );
        $uri = $uri->withPath('/foo/bar');

        $this->assertSame('/foo/bar', $uri->getPath());
    }

    /**
     * @return void
     */
    public function testWithQuery(): void
    {
        $uri = new Uri(
            new Scheme('https'),
            '',
            '',
            null,
            new Path([]),
            new QueryString([
                'hello' => 'world'
            ]),
            'fragment'
        );
        $uri = $uri->withQuery('hello=world');

        $this->assertSame('hello=world', $uri->getQuery());
    }

    /**
     * @return void
     */
    public function testWithFragment(): void
    {
        $uri = new Uri(
            new Scheme('https'),
            '',
            '',
            null,
            new Path([]),
            new QueryString([
                'hello' => 'world'
            ]),
            'fragment'
        );
        $uri = $uri->withFragment('fragment2');

        $this->assertSame('fragment2', $uri->getFragment());
    }
}
