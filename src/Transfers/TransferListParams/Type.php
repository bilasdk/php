<?php

declare(strict_types=1);

namespace Bila\Transfers\TransferListParams;

/**
 * Filter by transfer type.
 */
enum Type: string
{
    case BANK_ACCOUNT = 'bank-account';

    case MOBILE_MONEY = 'mobile-money';
}
