<?php

namespace Tests\Services;

use Bila\Client;
use Bila\Collections\CollectionGetResponse;
use Bila\Collections\CollectionGetStatusByReferenceResponse;
use Bila\Collections\CollectionInitiateMobileMoneyCollectionResponse;
use Bila\Collections\CollectionListResponse;
use Bila\Core\Util;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class CollectionsTest extends TestCase
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

        $result = $this->client->collections->retrieve(
            '68f11209-451f-4a15-bfcd-d916eb8b09f4'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CollectionGetResponse::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->collections->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CollectionListResponse::class, $result);
    }

    #[Test]
    public function testGetStatusByReference(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->collections->getStatusByReference(
            'collection-001'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(
            CollectionGetStatusByReferenceResponse::class,
            $result
        );
    }

    #[Test]
    public function testInitiateMobileMoneyCollection(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->collections->initiateMobileMoneyCollection(
            amount: 100.5,
            country: 'zm',
            operator: 'airtel',
            phone: '0977433571',
            reference: 'collection-001',
            walletID: '68f11209-451f-4a15-bfcd-d916eb8b09f4',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(
            CollectionInitiateMobileMoneyCollectionResponse::class,
            $result
        );
    }

    #[Test]
    public function testInitiateMobileMoneyCollectionWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->collections->initiateMobileMoneyCollection(
            amount: 100.5,
            country: 'zm',
            operator: 'airtel',
            phone: '0977433571',
            reference: 'collection-001',
            walletID: '68f11209-451f-4a15-bfcd-d916eb8b09f4',
            bearer: 'merchant',
            customerName: 'John Doe',
            narration: 'Payment for subscription',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(
            CollectionInitiateMobileMoneyCollectionResponse::class,
            $result
        );
    }
}
