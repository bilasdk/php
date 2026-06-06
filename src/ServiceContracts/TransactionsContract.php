<?php

declare(strict_types=1);

namespace Bila\ServiceContracts;

use Bila\Core\Exceptions\APIException;
use Bila\RequestOptions;
use Bila\Transactions\TransactionGetResponse;
use Bila\Transactions\TransactionListParams\Type;
use Bila\Transactions\TransactionListResponse;

/**
 * @phpstan-import-type RequestOpts from \Bila\RequestOptions
 */
interface TransactionsContract
{
    /**
     * @api
     *
     * @param string $id Transaction UUID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): TransactionGetResponse;

    /**
     * @api
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
    ): TransactionListResponse;
}
