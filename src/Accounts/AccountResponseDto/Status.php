<?php

declare(strict_types=1);

namespace Bila\Accounts\AccountResponseDto;

/**
 * Account status.
 */
enum Status: string
{
    case ACTIVE = 'active';

    case INACTIVE = 'inactive';

    case SUSPENDED = 'suspended';
}
