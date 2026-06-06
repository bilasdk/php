<?php

declare(strict_types=1);

namespace Bila\Services;

use Bila\Client;
use Bila\Collections\CollectionGetResponse;
use Bila\Collections\CollectionGetStatusByReferenceResponse;
use Bila\Collections\CollectionInitiateMobileMoneyCollectionParams\Bearer;
use Bila\Collections\CollectionInitiateMobileMoneyCollectionParams\Country;
use Bila\Collections\CollectionInitiateMobileMoneyCollectionParams\Operator;
use Bila\Collections\CollectionInitiateMobileMoneyCollectionResponse;
use Bila\Collections\CollectionListParams\Status;
use Bila\Collections\CollectionListResponse;
use Bila\Core\Exceptions\APIException;
use Bila\Core\Util;
use Bila\RequestOptions;
use Bila\ServiceContracts\CollectionsContract;

/**
 * Payment collection operation endpoints.
 *
 * @phpstan-import-type RequestOpts from \Bila\RequestOptions
 */
final class CollectionsService implements CollectionsContract
{
    /**
     * @api
     */
    public CollectionsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new CollectionsRawService($client);
    }

    /**
     * @api
     *
     * Retrieve a single collection by its UUID
     *
     * @param string $id Collection UUID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): CollectionGetResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a paginated list of payment collections for the authenticated merchant
     *
     * @param string $accountID Filter by account ID
     * @param string $endDate Filter by end date (ISO 8601)
     * @param float $page Page number (default: 1)
     * @param float $perPage Items per page (default: 50)
     * @param string $startDate Filter by start date (ISO 8601)
     * @param Status|value-of<Status> $status Filter by collection status
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?string $accountID = null,
        ?string $endDate = null,
        ?float $page = null,
        ?float $perPage = null,
        ?string $startDate = null,
        Status|string|null $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): CollectionListResponse {
        $params = Util::removeNulls(
            [
                'accountID' => $accountID,
                'endDate' => $endDate,
                'page' => $page,
                'perPage' => $perPage,
                'startDate' => $startDate,
                'status' => $status,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve collection status by client reference
     *
     * @param string $reference Client reference
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getStatusByReference(
        string $reference,
        RequestOptions|array|null $requestOptions = null
    ): CollectionGetStatusByReferenceResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->getStatusByReference($reference, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Initiate a payment collection from a mobile money account. Creates a transaction record in your dashboard.
     *
     * @param float $amount Collection amount
     * @param Country|value-of<Country> $country Country code
     * @param Operator|value-of<Operator> $operator Mobile money operator
     * @param string $phone Customer phone number
     * @param string $reference Unique client reference
     * @param string $walletID Target wallet ID to credit
     * @param Bearer|value-of<Bearer> $bearer Who bears the transaction fee
     * @param string $customerName Customer name for the transaction record
     * @param string $narration Collection narration
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function initiateMobileMoneyCollection(
        float $amount,
        Country|string $country,
        Operator|string $operator,
        string $phone,
        string $reference,
        string $walletID,
        Bearer|string|null $bearer = null,
        ?string $customerName = null,
        ?string $narration = null,
        RequestOptions|array|null $requestOptions = null,
    ): CollectionInitiateMobileMoneyCollectionResponse {
        $params = Util::removeNulls(
            [
                'amount' => $amount,
                'country' => $country,
                'operator' => $operator,
                'phone' => $phone,
                'reference' => $reference,
                'walletID' => $walletID,
                'bearer' => $bearer,
                'customerName' => $customerName,
                'narration' => $narration,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->initiateMobileMoneyCollection(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
