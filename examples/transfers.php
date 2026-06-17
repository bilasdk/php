<?php

declare(strict_types=1);

/**
 * Transfers examples
 *
 * To demonstrate how to send payouts via
 * bank transfer and mobile money.
 */

require __DIR__ . '/../vendor/autoload.php';

use Bila\Client;

$client = new Client(
    apiKey: getenv('BILA_API_KEY') ?: 'sk_test_your_api_key_here',
);

$transferId = '68f11209-451f-4a15-bfcd-d916eb8b09f4';
$accountId = '68f11209-451f-4a15-bfcd-d916eb8b09f4';
$transferRecipientId = '68f11209-451f-4a15-bfcd-d916eb8b09f4';
$walletId = '68f11209-451f-4a15-bfcd-d916eb8b09f4';
$bankReference = 'transfer-001';
$mobileReference = 'mobile-transfer-001';

try {
    /********************************************
     * Retrieve transfer
     *********************************************/
    $transfer = $client->transfers->retrieve($transferId);
    echo 'retrieve: ' . json_encode($transfer, JSON_PRETTY_PRINT) . PHP_EOL;

    /********************************************
     * List transfers
     *********************************************/
    $transfers = $client->transfers->list(
        accountID: $accountId,
        startDate: '2024-01-01T00:00:00Z',
        endDate: '2024-12-31T23:59:59Z',
        page: 1,
        perPage: 50,
        status: 'pending',
        type: 'bank-account',
    );
    echo 'list: ' . json_encode($transfers, JSON_PRETTY_PRINT) . PHP_EOL;

    /********************************************
     * Get transfer status by reference
     *********************************************/
    $status = $client->transfers->getStatusByReference($bankReference);
    echo 'getStatusByReference: ' . json_encode($status, JSON_PRETTY_PRINT) . PHP_EOL;

    /********************************************
     * Initiate bank transfer
     *********************************************/
    $bankTransfer = $client->transfers->initiateBankTransfer(
        accountID: $accountId,
        amount: 1000,
        reference: $bankReference,
        accountNumber: '1234567890',
        bankID: 'bank-001',
        country: 'zm',
        narration: 'Payment for services',
        recipientName: 'Jane Doe',
        transferRecipientID: $transferRecipientId,
        walletID: $walletId,
    );
    echo 'initiateBankTransfer: ' . json_encode($bankTransfer, JSON_PRETTY_PRINT) . PHP_EOL;

    /********************************************
     * Initiate mobile money transfer
     *********************************************/
    $mobileTransfer = $client->transfers->initiateMobileMoneyTransfer(
        amount: 250,
        country: 'zm',
        operator: 'airtel',
        phone: '0977433571',
        reference: $mobileReference,
        narration: 'Mobile money payout',
        recipientName: 'Jane Doe',
        walletID: $walletId,
    );
    echo 'initiateMobileMoneyTransfer: ' . json_encode($mobileTransfer, JSON_PRETTY_PRINT) . PHP_EOL;
} catch (Throwable $e) {
    fwrite(STDERR, (string) $e . PHP_EOL);
    exit(1);
}
