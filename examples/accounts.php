<?php

declare(strict_types=1);

/**
 * Accounts examples
 *
 * To demonstrate how to retrieve accounts,
 * list accounts, and check balances.
 */

require __DIR__ . '/../vendor/autoload.php';

use Bila\Client;

$client = new Client(
    apiKey: getenv('BILA_API_KEY') ?: 'sk_test_your_api_key_here',
);

$accountId = '68f11209-451f-4a15-bfcd-d916eb8b09f4';

try {
    /********************************************
     * Retrieve account
     *********************************************/
    $account = $client->accounts->retrieve($accountId);
    echo 'retrieve: ' . json_encode($account, JSON_PRETTY_PRINT) . PHP_EOL;

    /********************************************
     * List accounts
     *********************************************/
    $accounts = $client->accounts->list(page: 1, perPage: 50);
    echo 'list: ' . json_encode($accounts, JSON_PRETTY_PRINT) . PHP_EOL;

    /********************************************
     * Get account balance
     *********************************************/
    $balance = $client->accounts->getBalance($accountId);
    echo 'getBalance: ' . json_encode($balance, JSON_PRETTY_PRINT) . PHP_EOL;
} catch (Throwable $e) {
    fwrite(STDERR, (string) $e . PHP_EOL);
    exit(1);
}
