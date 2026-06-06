<?php

declare(strict_types=1);

namespace Bila\TransferRecipients\RecipientResponseDto;

/**
 * Transfer recipient type.
 */
enum Type: string
{
    case BANK_ACCOUNT = 'bank-account';

    case MOBILE_MONEY = 'mobile-money';
}
