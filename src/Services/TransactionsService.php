<?php

declare(strict_types=1);

namespace Bila\Services;

use Bila\Client;
use Bila\Core\Exceptions\APIException;
use Bila\Core\Util;
use Bila\RequestOptions;
use Bila\ServiceContracts\TransactionsContract;
use Bila\Transactions\TransactionGetResponse;
use Bila\Transactions\TransactionListParams\Type;
use Bila\Transactions\TransactionListResponse;

/**
 * Transaction history endpoints.
 *
 * @phpstan-import-type RequestOpts from \Bila\RequestOptions
 */
final class TransactionsService implements TransactionsContract
{
    /**
     * @api
     */
    public TransactionsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new TransactionsRawService($client);
    }

    /**
     * @api
     *
     * Retrieve a single transaction by its UUID
     *
     * @param string $id Transaction UUID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): TransactionGetResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a paginated list of transactions
     *
     * @param string $accountID Filter by account ID
     * @param string $endDate Filter by end date (ISO 8601)
     * @param float $page Page number (default: 1)
     * @param float $perPage Items per page (default: 50)
     * @param string $startDate Filter by start date (ISO 8601)
     * @param Type|value-of<Type> $type Filter by transaction type
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
        Type|string|null $type = null,
        RequestOptions|array|null $requestOptions = null,
    ): TransactionListResponse {
        $params = Util::removeNulls(
            [
                'accountID' => $accountID,
                'endDate' => $endDate,
                'page' => $page,
                'perPage' => $perPage,
                'startDate' => $startDate,
                'type' => $type,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
