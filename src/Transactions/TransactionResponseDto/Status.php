<?php

declare(strict_types=1);

namespace Bila\Transactions\TransactionResponseDto;

/**
 * Transaction status.
 */
enum Status: string
{
    case PENDING = 'pending';

    case SUCCESSFUL = 'successful';

    case FAILED = 'failed';

    case CANCELLED = 'cancelled';
}
