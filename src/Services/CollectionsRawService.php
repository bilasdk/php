<?php

declare(strict_types=1);

namespace Bila\Services;

use Bila\Client;
use Bila\Collections\CollectionGetResponse;
use Bila\Collections\CollectionGetStatusByReferenceResponse;
use Bila\Collections\CollectionInitiateMobileMoneyCollectionParams;
use Bila\Collections\CollectionInitiateMobileMoneyCollectionParams\Bearer;
use Bila\Collections\CollectionInitiateMobileMoneyCollectionParams\Country;
use Bila\Collections\CollectionInitiateMobileMoneyCollectionParams\Operator;
use Bila\Collections\CollectionInitiateMobileMoneyCollectionResponse;
use Bila\Collections\CollectionListParams;
use Bila\Collections\CollectionListParams\Status;
use Bila\Collections\CollectionListResponse;
use Bila\Core\Contracts\BaseResponse;
use Bila\Core\Exceptions\APIException;
use Bila\Core\Util;
use Bila\RequestOptions;
use Bila\ServiceContracts\CollectionsRawContract;

/**
 * Payment collection operation endpoints.
 *
 * @phpstan-import-type RequestOpts from \Bila\RequestOptions
 */
final class CollectionsRawService implements CollectionsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieve a single collection by its UUID
     *
     * @param string $id Collection UUID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CollectionGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['api/v1/bila/collections/%1$s', $id],
            options: $requestOptions,
            convert: CollectionGetResponse::class,
        );
    }

    /**
     * @api
     *
     * Retrieve a paginated list of payment collections for the authenticated merchant
     *
     * @param array{
     *   accountID?: string,
     *   endDate?: string,
     *   page?: float,
     *   perPage?: float,
     *   startDate?: string,
     *   status?: Status|value-of<Status>,
     * }|CollectionListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CollectionListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|CollectionListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CollectionListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'api/v1/bila/collections',
            query: Util::array_transform_keys($parsed, ['accountID' => 'accountId']),
            options: $options,
            convert: CollectionListResponse::class,
        );
    }

    /**
     * @api
     *
     * Retrieve collection status by client reference
     *
     * @param string $reference Client reference
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CollectionGetStatusByReferenceResponse>
     *
     * @throws APIException
     */
    public function getStatusByReference(
        string $reference,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['api/v1/bila/collections/status/%1$s', $reference],
            options: $requestOptions,
            convert: CollectionGetStatusByReferenceResponse::class,
        );
    }

    /**
     * @api
     *
     * Initiate a payment collection from a mobile money account. Creates a transaction record in your dashboard.
     *
     * @param array{
     *   amount: float,
     *   country: Country|value-of<Country>,
     *   operator: Operator|value-of<Operator>,
     *   phone: string,
     *   reference: string,
     *   walletID: string,
     *   bearer?: Bearer|value-of<Bearer>,
     *   customerName?: string,
     *   narration?: string,
     * }|CollectionInitiateMobileMoneyCollectionParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CollectionInitiateMobileMoneyCollectionResponse>
     *
     * @throws APIException
     */
    public function initiateMobileMoneyCollection(
        array|CollectionInitiateMobileMoneyCollectionParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CollectionInitiateMobileMoneyCollectionParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'api/v1/bila/collections/mobile-money',
            body: (object) $parsed,
            options: $options,
            convert: CollectionInitiateMobileMoneyCollectionResponse::class,
        );
    }
}
