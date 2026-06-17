<?php

declare(strict_types=1);

/**
 * Banks examples
 *
 * To demonstrate how to list supported banks
 * and financial institutions.
 */

require __DIR__ . '/../vendor/autoload.php';

use Bila\Client;

$client = new Client(
    apiKey: getenv('BILA_API_KEY') ?: 'sk_test_your_api_key_here',
);

try {
    $banks = $client->banks->list(country: 'zm');
    echo 'list: ' . json_encode($banks, JSON_PRETTY_PRINT) . PHP_EOL;
} catch (Throwable $e) {
    fwrite(STDERR, (string) $e . PHP_EOL);
    exit(1);
}
