<?php

declare(strict_types=1);

namespace Bila\Collections\CollectionInitiateMobileMoneyCollectionParams;

/**
 * Who bears the transaction fee.
 */
enum Bearer: string
{
    case MERCHANT = 'merchant';

    case CUSTOMER = 'customer';
}
