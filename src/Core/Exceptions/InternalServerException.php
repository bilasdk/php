<?php

namespace Bila\Core\Exceptions;

class InternalServerException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Bila Internal Server Exception';
}
