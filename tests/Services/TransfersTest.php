<?php

namespace Tests\Services;

use Bila\Client;
use Bila\Core\Util;
use Bila\Transfers\TransferGetResponse;
use Bila\Transfers\TransferGetStatusByReferenceResponse;
use Bila\Transfers\TransferInitiateBankTransferResponse;
use Bila\Transfers\TransferInitiateMobileMoneyTransferResponse;
use Bila\Transfers\TransferListResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class TransfersTest extends TestCase
{
    protected Client $client;

    protected function setUp(): void
    {
        parent::setUp();

        $testUrl = Util::getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
        $client = new Client(apiKey: 'My API Key', baseUrl: $testUrl);

        $this->client = $client;
    }

    #[Test]
    public function testRetrieve(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->transfers->retrieve(
            '68f11209-451f-4a15-bfcd-d916eb8b09f4'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(TransferGetResponse::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->transfers->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(TransferListResponse::class, $result);
    }

    #[Test]
    public function testGetStatusByReference(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->transfers->getStatusByReference('transfer-001');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(
            TransferGetStatusByReferenceResponse::class,
            $result
        );
    }

    #[Test]
    public function testInitiateBankTransfer(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->transfers->initiateBankTransfer(
            accountID: '68f11209-451f-4a15-bfcd-d916eb8b09f4',
            amount: 1000,
            reference: 'transfer-001',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(
            TransferInitiateBankTransferResponse::class,
            $result
        );
    }

    #[Test]
    public function testInitiateBankTransferWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->transfers->initiateBankTransfer(
            accountID: '68f11209-451f-4a15-bfcd-d916eb8b09f4',
            amount: 1000,
            reference: 'transfer-001',
            accountNumber: '1234567890',
            bankID: 'bank-001',
            country: 'zm',
            narration: 'Payment for services',
            recipientName: 'Jane Doe',
            transferRecipientID: '68f11209-451f-4a15-bfcd-d916eb8b09f4',
            walletID: '68f11209-451f-4a15-bfcd-d916eb8b09f4',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(
            TransferInitiateBankTransferResponse::class,
            $result
        );
    }

    #[Test]
    public function testInitiateMobileMoneyTransfer(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->transfers->initiateMobileMoneyTransfer(
            amount: 250,
            country: 'zm',
            operator: 'airtel',
            phone: '0977433571',
            reference: 'mobile-transfer-001',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(
            TransferInitiateMobileMoneyTransferResponse::class,
            $result
        );
    }

    #[Test]
    public function testInitiateMobileMoneyTransferWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->transfers->initiateMobileMoneyTransfer(
            amount: 250,
            country: 'zm',
            operator: 'airtel',
            phone: '0977433571',
            reference: 'mobile-transfer-001',
            narration: 'Mobile money payout',
            recipientName: 'Jane Doe',
            walletID: '68f11209-451f-4a15-bfcd-d916eb8b09f4',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(
            TransferInitiateMobileMoneyTransferResponse::class,
            $result
        );
    }
}
