<?php

declare(strict_types=1);

namespace Bila\Transfers\TransferResponseDto;

/**
 * Transfer status.
 */
enum Status: string
{
    case PENDING = 'pending';

    case SUCCESSFUL = 'successful';

    case FAILED = 'failed';
}
