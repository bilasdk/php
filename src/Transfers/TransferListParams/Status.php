<?php

declare(strict_types=1);

namespace Bila\Transfers\TransferListParams;

/**
 * Filter by transfer status.
 */
enum Status: string
{
    case PENDING = 'pending';

    case SUCCESSFUL = 'successful';

    case FAILED = 'failed';
}
