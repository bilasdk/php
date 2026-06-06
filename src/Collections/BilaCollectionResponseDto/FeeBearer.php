<?php

declare(strict_types=1);

namespace Bila\Collections\BilaCollectionResponseDto;

/**
 * Who bears the transaction fee.
 */
enum FeeBearer: string
{
    case MERCHANT = 'merchant';

    case CUSTOMER = 'customer';
}
