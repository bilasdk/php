<?php

namespace Bila\Core\Exceptions;

class PermissionDeniedException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Bila Permission Denied Exception';
}
