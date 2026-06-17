<?php

declare(strict_types=1);

/**
 * Collections examples
 *
 * To demonstrate how to make collects
 * via mobile money.
 */

require __DIR__ . '/../vendor/autoload.php';

use Bila\Client;

$client = new Client(
    apiKey: getenv('BILA_API_KEY') ?: 'sk_test_your_api_key_here',
);

$collectionId = '68f11209-451f-4a15-bfcd-d916eb8b09f4';
$walletId = '68f11209-451f-4a15-bfcd-d916eb8b09f4';
$reference = 'collection-001';

try {
    /********************************************
     * Retrieve collection
     *********************************************/
    $collection = $client->collections->retrieve($collectionId);
    echo 'retrieve: ' . json_encode($collection, JSON_PRETTY_PRINT) . PHP_EOL;

    /********************************************
     * List collections
     *********************************************/
    $collections = $client->collections->list(
        accountID: $walletId,
        startDate: '2024-01-01T00:00:00Z',
        endDate: '2024-12-31T23:59:59Z',
        page: 1,
        perPage: 50,
        status: 'pending',
    );
    echo 'list: ' . json_encode($collections, JSON_PRETTY_PRINT) . PHP_EOL;

    /********************************************
     * Get collection status by reference
     *********************************************/
    $status = $client->collections->getStatusByReference($reference);
    echo 'getStatusByReference: ' . json_encode($status, JSON_PRETTY_PRINT) . PHP_EOL;

    /********************************************
     * Initiate mobile money collection
     *********************************************/
    $initiated = $client->collections->initiateMobileMoneyCollection(
        amount: 100.5,
        country: 'zm',
        operator: 'airtel',
        phone: '0977433571',
        reference: $reference,
        walletID: $walletId,
        bearer: 'customer',
        customerName: 'John Doe',
        narration: 'Payment for subscription',
    );
    echo 'initiateMobileMoneyCollection: ' . json_encode($initiated, JSON_PRETTY_PRINT) . PHP_EOL;
} catch (Throwable $e) {
    fwrite(STDERR, (string) $e . PHP_EOL);
    exit(1);
}
