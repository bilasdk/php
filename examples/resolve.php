<?php

declare(strict_types=1);

/**
 * Resolve examples
 *
 * To demonstrate how to verify bank account
 * and mobile money account details.
 */

require __DIR__ . '/../vendor/autoload.php';

use Bila\Client;

$client = new Client(
    apiKey: getenv('BILA_API_KEY') ?: 'sk_test_your_api_key_here',
);

try {
    /********************************************
     * Resolve bank account
     *********************************************/
    $bankAccount = $client->resolve->bankAccount(
        accountNumber: '1234567890',
        bankID: 'bank-001',
        country: 'zm',
    );
    echo 'bankAccount: ' . json_encode($bankAccount, JSON_PRETTY_PRINT) . PHP_EOL;

    /********************************************
     * Resolve mobile money
     *********************************************/
    $mobileMoney = $client->resolve->mobileMoney(
        country: 'zm',
        operator: 'airtel',
        phone: '0977433571',
    );
    echo 'mobileMoney: ' . json_encode($mobileMoney, JSON_PRETTY_PRINT) . PHP_EOL;
} catch (Throwable $e) {
    fwrite(STDERR, (string) $e . PHP_EOL);
    exit(1);
}
