<?php

declare(strict_types=1);

/**
 * Transactions examples
 *
 * To demonstrate how to retrieve and list
 * transaction history.
 */

require __DIR__ . '/../vendor/autoload.php';

use Bila\Client;

$client = new Client(
    apiKey: getenv('BILA_API_KEY') ?: 'sk_test_your_api_key_here',
);

$transactionId = '68f11209-451f-4a15-bfcd-d916eb8b09f4';
$accountId = '68f11209-451f-4a15-bfcd-d916eb8b09f4';

try {
    /********************************************
     * Retrieve transaction
     *********************************************/
    $transaction = $client->transactions->retrieve($transactionId);
    echo 'retrieve: ' . json_encode($transaction, JSON_PRETTY_PRINT) . PHP_EOL;

    /********************************************
     * List transactions
     *********************************************/
    $transactions = $client->transactions->list(
        accountID: $accountId,
        startDate: '2024-01-01T00:00:00Z',
        endDate: '2024-12-31T23:59:59Z',
        page: 1,
        perPage: 50,
        type: 'credit',
    );
    echo 'list: ' . json_encode($transactions, JSON_PRETTY_PRINT) . PHP_EOL;
} catch (Throwable $e) {
    fwrite(STDERR, (string) $e . PHP_EOL);
    exit(1);
}
