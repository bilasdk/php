<?php

declare(strict_types=1);

namespace Bila\Transactions\TransactionListParams;

/**
 * Filter by transaction type.
 */
enum Type: string
{
    case CREDIT = 'credit';

    case DEBIT = 'debit';
}
