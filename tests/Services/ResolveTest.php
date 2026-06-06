<?php

namespace Tests\Services;

use Bila\Client;
use Bila\Core\Util;
use Bila\Resolve\ResolveBankAccountResponse;
use Bila\Resolve\ResolveMobileMoneyResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class ResolveTest extends TestCase
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
    public function testBankAccount(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->resolve->bankAccount(
            accountNumber: '1234567890',
            bankID: 'bank-001'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ResolveBankAccountResponse::class, $result);
    }

    #[Test]
    public function testBankAccountWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->resolve->bankAccount(
            accountNumber: '1234567890',
            bankID: 'bank-001',
            country: 'zm'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ResolveBankAccountResponse::class, $result);
    }

    #[Test]
    public function testMobileMoney(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->resolve->mobileMoney(
            country: 'zm',
            operator: 'airtel',
            phone: '0977433571'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ResolveMobileMoneyResponse::class, $result);
    }

    #[Test]
    public function testMobileMoneyWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->resolve->mobileMoney(
            country: 'zm',
            operator: 'airtel',
            phone: '0977433571'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ResolveMobileMoneyResponse::class, $result);
    }
}
