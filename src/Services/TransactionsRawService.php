<?php

declare(strict_types=1);

namespace Bila\Services;

use Bila\Client;
use Bila\Core\Contracts\BaseResponse;
use Bila\Core\Exceptions\APIException;
use Bila\Core\Util;
use Bila\RequestOptions;
use Bila\ServiceContracts\TransactionsRawContract;
use Bila\Transactions\TransactionGetResponse;
use Bila\Transactions\TransactionListParams;
use Bila\Transactions\TransactionListParams\Type;
use Bila\Transactions\TransactionListResponse;

/**
 * Transaction history endpoints.
 *
 * @phpstan-import-type RequestOpts from \Bila\RequestOptions
 */
final class TransactionsRawService implements TransactionsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieve a single transaction by its UUID
     *
     * @param string $id Transaction UUID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<TransactionGetResponse>
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
            path: ['api/v1/bila/transactions/%1$s', $id],
            options: $requestOptions,
            convert: TransactionGetResponse::class,
        );
    }

    /**
     * @api
     *
     * Retrieve a paginated list of transactions
     *
     * @param array{
     *   accountID?: string,
     *   endDate?: string,
     *   page?: float,
     *   perPage?: float,
     *   startDate?: string,
     *   type?: Type|value-of<Type>,
     * }|TransactionListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<TransactionListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|TransactionListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TransactionListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'api/v1/bila/transactions',
            query: Util::array_transform_keys($parsed, ['accountID' => 'accountId']),
            options: $options,
            convert: TransactionListResponse::class,
        );
    }
}
