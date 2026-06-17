<?php

declare(strict_types=1);

/**
 * Transfer recipients examples
 *
 * To demonstrate how to manage payout recipients
 * for bank accounts and mobile money.
 */

require __DIR__ . '/../vendor/autoload.php';

use Bila\Client;

$client = new Client(
    apiKey: getenv('BILA_API_KEY') ?: 'sk_test_your_api_key_here',
);

$recipientId = '68f11209-451f-4a15-bfcd-d916eb8b09f4';

try {
    /********************************************
     * Retrieve transfer recipient
     *********************************************/
    $recipient = $client->transferRecipients->retrieve($recipientId);
    echo 'retrieve: ' . json_encode($recipient, JSON_PRETTY_PRINT) . PHP_EOL;

    /********************************************
     * List transfer recipients
     *********************************************/
    $recipients = $client->transferRecipients->list(
        page: 1,
        perPage: 50,
        type: 'bank-account',
    );
    echo 'list: ' . json_encode($recipients, JSON_PRETTY_PRINT) . PHP_EOL;

    /********************************************
     * Create bank account recipient
     *********************************************/
    $bankRecipient = $client->transferRecipients->createBankAccount(
        accountNumber: '1234567890',
        bankID: 'bank-001',
        accountName: 'John Doe',
        country: 'zm',
    );
    echo 'createBankAccount: ' . json_encode($bankRecipient, JSON_PRETTY_PRINT) . PHP_EOL;

    /********************************************
     * Create mobile money recipient
     *********************************************/
    $mobileRecipient = $client->transferRecipients->createMobileMoney(
        country: 'zm',
        operator: 'airtel',
        phone: '0977433571',
        accountName: 'John Doe',
    );
    echo 'createMobileMoney: ' . json_encode($mobileRecipient, JSON_PRETTY_PRINT) . PHP_EOL;
} catch (Throwable $e) {
    fwrite(STDERR, (string) $e . PHP_EOL);
    exit(1);
}
