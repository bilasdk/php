<?php

declare(strict_types=1);

namespace Bila\TransferRecipients\TransferRecipientCreateMobileMoneyParams;

/**
 * Mobile money operator.
 */
enum Operator: string
{
    case AIRTEL = 'airtel';

    case MTN = 'mtn';

    case ZAMTEL = 'zamtel';
}
