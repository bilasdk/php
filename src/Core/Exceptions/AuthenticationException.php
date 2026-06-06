<?php

namespace Bila\Core\Exceptions;

class AuthenticationException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Bila Authentication Exception';
}
