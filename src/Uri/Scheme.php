<?php

declare(strict_types=1);

namespace Graywings\Http\Uri;

readonly final class Scheme
{
    /**
     * @var string lowercase scheme name
     */
    private string $value;

    /**
     * @param string $value scheme name
     */
    public function __construct(string $value = 'https')
    {
        $this->value = strtolower($value);
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }
}
