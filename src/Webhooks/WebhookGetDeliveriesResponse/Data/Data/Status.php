<?php

declare(strict_types=1);

namespace Bila\Webhooks\WebhookGetDeliveriesResponse\Data\Data;

/**
 * Delivery status.
 */
enum Status: string
{
    case QUEUED = 'QUEUED';

    case DELIVERED = 'DELIVERED';

    case FAILED = 'FAILED';

    case RETRYING = 'RETRYING';
}
