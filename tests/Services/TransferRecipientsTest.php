<?php

namespace Tests\Services;

use Bila\Client;
use Bila\Core\Util;
use Bila\TransferRecipients\TransferRecipientGetResponse;
use Bila\TransferRecipients\TransferRecipientListResponse;
use Bila\TransferRecipients\TransferRecipientNewBankAccountResponse;
use Bila\TransferRecipients\TransferRecipientNewMobileMoneyResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class TransferRecipientsTest extends TestCase
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

        $result = $this->client->transferRecipients->retrieve(
            '68f11209-451f-4a15-bfcd-d916eb8b09f4'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(TransferRecipientGetResponse::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->transferRecipients->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(TransferRecipientListResponse::class, $result);
    }

    #[Test]
    public function testCreateBankAccount(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->transferRecipients->createBankAccount(
            accountNumber: '1234567890',
            bankID: 'bank-001'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(
            TransferRecipientNewBankAccountResponse::class,
            $result
        );
    }

    #[Test]
    public function testCreateBankAccountWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->transferRecipients->createBankAccount(
            accountNumber: '1234567890',
            bankID: 'bank-001',
            accountName: 'John Doe',
            country: 'zm',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(
            TransferRecipientNewBankAccountResponse::class,
            $result
        );
    }

    #[Test]
    public function testCreateMobileMoney(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->transferRecipients->createMobileMoney(
            country: 'zm',
            operator: 'airtel',
            phone: '0977433571'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(
            TransferRecipientNewMobileMoneyResponse::class,
            $result
        );
    }

    #[Test]
    public function testCreateMobileMoneyWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->transferRecipients->createMobileMoney(
            country: 'zm',
            operator: 'airtel',
            phone: '0977433571',
            accountName: 'John Doe',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(
            TransferRecipientNewMobileMoneyResponse::class,
            $result
        );
    }
}
