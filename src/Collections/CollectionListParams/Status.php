<?php

declare(strict_types=1);

namespace Bila\Collections\CollectionListParams;

/**
 * Filter by collection status.
 */
enum Status: string
{
    case PENDING = 'pending';

    case SUCCESSFUL = 'successful';

    case FAILED = 'failed';

    case OTP_REQUIRED = 'otp-required';

    case PAY_OFFLINE = 'pay-offline';
}
