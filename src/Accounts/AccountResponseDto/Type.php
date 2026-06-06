<?php

declare(strict_types=1);

namespace Bila\Accounts\AccountResponseDto;

/**
 * Account type.
 */
enum Type: string
{
    case MAIN = 'main';

    case SUB = 'sub';

    case VIRTUAL = 'virtual';
}
