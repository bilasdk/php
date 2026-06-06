<?php

namespace Bila\Core\Exceptions;

class ConflictException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Bila Conflict Exception';
}
