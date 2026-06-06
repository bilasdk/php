<?php

declare(strict_types=1);

namespace Bila\Webhooks\WebhookUpdateParams;

enum Event: string
{
    case ORDER_CREATED = 'order.created';

    case ORDER_PAID = 'order.paid';

    case ORDER_CANCELLED = 'order.cancelled';

    case STOCK_LOW = 'stock.low';

    case PAYMENT_CREATED = 'payment.created';

    case PAYMENT_COMPLETED = 'payment.completed';

    case PAYMENT_FAILED = 'payment.failed';

    case COLLECTION_PENDING = 'collection.pending';

    case COLLECTION_COMPLETED = 'collection.completed';

    case COLLECTION_FAILED = 'collection.failed';

    case WITHDRAWAL_CREATED = 'withdrawal.created';

    case WITHDRAWAL_COMPLETED = 'withdrawal.completed';

    case WITHDRAWAL_FAILED = 'withdrawal.failed';

    case TRANSACTION_UPDATED = 'transaction.updated';

    case TRANSFER_PENDING = 'transfer.pending';

    case TRANSFER_COMPLETED = 'transfer.completed';

    case TRANSFER_FAILED = 'transfer.failed';

    case SETTLEMENT_COMPLETED = 'settlement.completed';
}
