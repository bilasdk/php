<?php

declare(strict_types=1);

namespace Bila\ServiceContracts;

use Bila\Core\Contracts\BaseResponse;
use Bila\Core\Exceptions\APIException;
use Bila\RequestOptions;
use Bila\Transactions\TransactionGetResponse;
use Bila\Transactions\TransactionListParams;
use Bila\Transactions\TransactionListResponse;

/**
 * @phpstan-import-type RequestOpts from \Bila\RequestOptions
 */
interface TransactionsRawContract
{
    /**
     * @api
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|TransactionListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<TransactionListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|TransactionListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
