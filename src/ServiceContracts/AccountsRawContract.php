<?php

declare(strict_types=1);

namespace Bila\ServiceContracts;

use Bila\Accounts\AccountGetBalanceResponse;
use Bila\Accounts\AccountGetResponse;
use Bila\Accounts\AccountListParams;
use Bila\Accounts\AccountListResponse;
use Bila\Core\Contracts\BaseResponse;
use Bila\Core\Exceptions\APIException;
use Bila\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Bila\RequestOptions
 */
interface AccountsRawContract
{
    /**
     * @api
     *
     * @param string $id Account UUID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AccountGetResponse>
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
     * @param array<string,mixed>|AccountListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AccountListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|AccountListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Account UUID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AccountGetBalanceResponse>
     *
     * @throws APIException
     */
    public function getBalance(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
