<?php

declare(strict_types=1);

namespace Bila\Collections\CollectionInitiateMobileMoneyCollectionParams;

/**
 * Mobile money operator.
 */
enum Operator: string
{
    case AIRTEL = 'airtel';

    case MTN = 'mtn';

    case ZAMTEL = 'zamtel';
}
