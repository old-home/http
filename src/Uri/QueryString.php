<?php

declare(strict_types=1);

namespace Graywings\Http\Uri;

readonly final class QueryString
{
    /**
     * @var array<string, string>
     */
    private array $query;
    /**
     * @param array<string, string> $query
     */
    public function __construct(
        array $query
    )
    {
        if (empty($query)) {
            $this->query = [];
        } else {
            $this->query = $query;
        }
    }

    /**
     * @param string $query
     * @return self
     */
    public static function parse(string $query): self
    {
        $keyValueSets = explode('&', $query);
        $query = [];
        foreach ($keyValueSets as $keyValueSet) {
            $exploded = explode('=', $keyValueSet);
            if (array_key_exists(1, $exploded)) {
                $query[$exploded[0]] = $exploded[1];
            }
        }
        return new self($query);
    }

    /**
     * @param string $key
     * @return string
     */
    public function get(string $key): string
    {
        return $this->query[$key];
    }

    /**
     * @param string $key
     * @param string $value
     * @return self
     */
    public function add(string $key, string $value): self
    {
        $query = $this->query;
        $query[$key] = $value;
        return new self($query);
    }

    /**
     * @param array<string, string> $query
     * @return self
     */
    public function addBulk(array $query): self
    {
        return new self(array_merge($this->query, $query));
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return http_build_query($this->query);
    }
}
