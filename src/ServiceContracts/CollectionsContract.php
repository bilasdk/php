<?php

declare(strict_types=1);

namespace Bila\ServiceContracts;

use Bila\Collections\CollectionGetResponse;
use Bila\Collections\CollectionGetStatusByReferenceResponse;
use Bila\Collections\CollectionInitiateMobileMoneyCollectionParams\Bearer;
use Bila\Collections\CollectionInitiateMobileMoneyCollectionParams\Country;
use Bila\Collections\CollectionInitiateMobileMoneyCollectionParams\Operator;
use Bila\Collections\CollectionInitiateMobileMoneyCollectionResponse;
use Bila\Collections\CollectionListParams\Status;
use Bila\Collections\CollectionListResponse;
use Bila\Core\Exceptions\APIException;
use Bila\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Bila\RequestOptions
 */
interface CollectionsContract
{
    /**
     * @api
     *
     * @param string $id Collection UUID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): CollectionGetResponse;

    /**
     * @api
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
    ): CollectionListResponse;

    /**
     * @api
     *
     * @param string $reference Client reference
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getStatusByReference(
        string $reference,
        RequestOptions|array|null $requestOptions = null
    ): CollectionGetStatusByReferenceResponse;

    /**
     * @api
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
    ): CollectionInitiateMobileMoneyCollectionResponse;
}
