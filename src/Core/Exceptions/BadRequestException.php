<?php

namespace Bila\Core\Exceptions;

class BadRequestException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Bila Bad Request Exception';
}
