<?php

declare(strict_types=1);

/**
 * Webhooks examples
 *
 * To demonstrate how to configure webhooks
 * and manage delivery history.
 */

require __DIR__ . '/../vendor/autoload.php';

use Bila\Client;

$client = new Client(
    apiKey: getenv('BILA_API_KEY') ?: 'sk_test_your_api_key_here',
);

$webhookId = '68f11209-451f-4a15-bfcd-d916eb8b09f4';

try {
    /********************************************
     * Create webhook
     *********************************************/
    $created = $client->webhooks->create(
        events: ['payment.completed', 'withdrawal.completed', 'transfer.completed'],
        url: 'https://example.com/webhooks',
    );
    echo 'create: ' . json_encode($created, JSON_PRETTY_PRINT) . PHP_EOL;

    /********************************************
     * Update webhook
     *********************************************/
    $updated = $client->webhooks->update(
        $webhookId,
        events: ['payment.completed', 'collection.completed', 'transfer.failed'],
        url: 'https://example.com/webhooks/v2',
        isActive: true,
    );
    echo 'update: ' . json_encode($updated, JSON_PRETTY_PRINT) . PHP_EOL;

    /********************************************
     * List webhooks
     *********************************************/
    $webhooks = $client->webhooks->list();
    echo 'list: ' . json_encode($webhooks, JSON_PRETTY_PRINT) . PHP_EOL;

    /********************************************
     * Get webhook deliveries
     *********************************************/
    $deliveries = $client->webhooks->getDeliveries(
        $webhookId,
        startDate: '2026-04-01T00:00:00.000Z',
        endDate: '2026-04-30T23:59:59.999Z',
        eventType: 'payment.completed',
        page: 1,
        perPage: 20,
        status: 'DELIVERED',
    );
    echo 'getDeliveries: ' . json_encode($deliveries, JSON_PRETTY_PRINT) . PHP_EOL;

    /********************************************
     * List webhook events
     *********************************************/
    $events = $client->webhooks->listEvents();
    echo 'listEvents: ' . json_encode($events, JSON_PRETTY_PRINT) . PHP_EOL;

    /********************************************
     * Rotate webhook secret
     *********************************************/
    $rotated = $client->webhooks->rotateSecret($webhookId);
    echo 'rotateSecret: ' . json_encode($rotated, JSON_PRETTY_PRINT) . PHP_EOL;

    /********************************************
     * Deactivate webhook
     *********************************************/
    $deactivated = $client->webhooks->deactivate($webhookId);
    echo 'deactivate: ' . json_encode($deactivated, JSON_PRETTY_PRINT) . PHP_EOL;
} catch (Throwable $e) {
    fwrite(STDERR, (string) $e . PHP_EOL);
    exit(1);
}
