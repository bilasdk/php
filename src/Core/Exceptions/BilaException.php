<?php

namespace Bila\Core\Exceptions;

class BilaException extends \Exception
{
    /** @var string */
    protected const DESC = 'Bila Error';

    public function __construct(string $message, int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct($this::DESC.PHP_EOL.$message, $code, $previous);
    }
}
