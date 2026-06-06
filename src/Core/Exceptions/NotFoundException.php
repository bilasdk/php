<?php

namespace Bila\Core\Exceptions;

class NotFoundException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Bila Not Found Exception';
}
