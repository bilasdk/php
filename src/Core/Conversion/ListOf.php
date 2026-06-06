<?php

declare(strict_types=1);

namespace Bila\Core\Conversion;

use Bila\Core\Conversion\Concerns\ArrayOf;
use Bila\Core\Conversion\Contracts\Converter;

/**
 * @internal
 */
final class ListOf implements Converter
{
    use ArrayOf;

    // @phpstan-ignore-next-line missingType.iterableValue
    private function empty(): array|object
    {
        return [];
    }
}
