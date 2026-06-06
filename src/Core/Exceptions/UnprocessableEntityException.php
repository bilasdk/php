<?php

namespace Bila\Core\Exceptions;

class UnprocessableEntityException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Bila Unprocessable Entity Exception';
}
