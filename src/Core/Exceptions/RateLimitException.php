<?php

namespace Bila\Core\Exceptions;

class RateLimitException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Bila Rate Limit Exception';
}
