<?php

declare(strict_types=1);

namespace Bila\Transactions\TransactionResponseDto;

/**
 * Transaction type.
 */
enum Type: string
{
    case CREDIT = 'credit';

    case DEBIT = 'debit';
}
