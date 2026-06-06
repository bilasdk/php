<?php

declare(strict_types=1);

namespace Bila\Core\Conversion\Contracts;

use Bila\Core\Conversion\CoerceState;
use Bila\Core\Conversion\DumpState;

/**
 * @internal
 */
interface Converter
{
    /**
     * @internal
     */
    public function coerce(mixed $value, CoerceState $state): mixed;

    /**
     * @internal
     */
    public function dump(mixed $value, DumpState $state): mixed;
}
